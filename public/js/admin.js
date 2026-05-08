/**
 * Admin Panel Module - Handles dashboard data and management
 */

import { checkAuth, logout } from './auth.js';
import { initUI } from './ui.js';

document.addEventListener('DOMContentLoaded', async () => {
    // 1. Verificar que sea admin
    const user = await checkAuth();
    if (!user || user.role !== 'admin') {
        window.location.href = 'index.html';
        return;
    }

    // 2. Inicializar componentes
    initUI();
    loadDashboardStats();
    loadProductsTable();
    loadCategories();
    loadAdminOrders();
    initTabs();

    // 3. Listener para limpiar cache
    document.getElementById('btn-clear-cache')?.addEventListener('click', async () => {
        try {
            const res = await fetch('php/index.php?action=clear_cache');
            const data = await res.json();
            if (data.success) {
                if (window.showToast) showToast('¡Cache del servidor limpiado con éxito!', 'success');
                else alert('¡Cache del servidor limpiado con éxito!');
            }
        } catch (err) {
            console.error('Error al limpiar cache:', err);
        }
    });

    // 4. Buscador en tiempo real de productos
    document.getElementById('admin-product-search')?.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#admin-products-table tr');
        rows.forEach(row => {
            const name = row.querySelector('.product-name')?.textContent.toLowerCase() || '';
            const cat = row.querySelector('.product-cat')?.textContent.toLowerCase() || '';
            row.style.display = (name.includes(term) || cat.includes(term)) ? '' : 'none';
        });
    });

    // 4. Listener para logout (disparado desde ui.js)
    document.addEventListener('app:logout', () => {
        logout();
    });

    // 5. Listener para abrir modal de nuevo producto
    document.getElementById('btn-nuevo-producto')?.addEventListener('click', () => {
        const modalElement = document.getElementById('modalProducto');
        const modal = new bootstrap.Modal(modalElement);
        loadCategories();
        modal.show();
    });

    // 6. Listener para el formulario de nuevo producto
    document.getElementById('form-nuevo-producto')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        
        try {
            const res = await fetch('php/index.php?action=add_product', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            if (data.success) {
                if (window.showToast) showToast(data.message, 'success');
                else alert(data.message);
                
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalProducto'));
                modal.hide();
                e.target.reset();
                loadProductsTable(); // Recargar tabla
                loadDashboardStats(); // Recargar stats
            } else {
                if (window.showToast) showToast('Error: ' + data.message, 'danger');
                else alert('Error: ' + data.message);
            }
        } catch (err) {
            console.error('Error al registrar producto:', err);
            if (window.showToast) showToast('Error de conexión al servidor', 'danger');
            else alert('Error de conexión al servidor');
        }
    });
});

function initTabs() {
    const tabs = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = tab.getAttribute('href').replace('#', '');
            
            // Ocultar todas las secciones
            document.querySelectorAll('section.admin-section').forEach(s => s.classList.add('d-none'));
            // Mostrar la seleccionada
            document.getElementById(targetId)?.classList.remove('d-none');
            
            // Actualizar clases active
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
}

async function loadDashboardStats() {
    try {
        const res = await fetch('php/index.php?action=get_stats');
        const data = await res.json();
        
        if (data.success) {
            // Actualizar tarjetas (Esto asume IDs en el HTML que añadiremos o buscaremos)
            // Para simplicidad, actualizamos por texto o selectores
            const stats = data;
            
            // Actualizar barras de categoría
            const container = document.querySelector('#estadisticas .card .row.g-4');
            if (container && stats.categorias) {
                container.innerHTML = stats.categorias.map(cat => `
                    <div class="col-md-6 mb-3">
                        <div class="category-label"><span>${cat.name}</span><span class="text-primary">${cat.percentage}%</span></div>
                        <div class="progress"><div class="progress-bar" style="width: ${cat.percentage}%"></div></div>
                        <small class="text-muted">${cat.units} unidades vendidas</small>
                    </div>
                `).join('');
            }
        }
    } catch (err) {
        console.error('Error al cargar estadísticas:', err);
    }
}

async function loadProductsTable() {
    const container = document.getElementById('admin-products-table');
    if (!container) return;

    try {
        const res = await fetch('php/index.php?action=get_products');
        const products = await res.json();

        container.innerHTML = products.map(p => {
            const stock = p.stock || 50;
            const stockClass = stock < 10 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success';
            return `
                <tr>
                    <td class="ps-4"><img src="${p.image}" width="45" height="45" style="object-fit:cover; border-radius:8px; border: 1px solid #eee;"></td>
                    <td>
                        <div class="fw-bold product-name" style="color: var(--trux-admin-dark);">${p.name}</div>
                        <small class="text-muted">ID: #${p.id}</small>
                    </td>
                    <td><span class="badge bg-light text-dark border product-cat">${p.category}</span></td>
                    <td class="fw-bold text-primary">S/. ${p.price}</td>
                    <td><span class="badge ${stockClass} rounded-pill px-3">${stock} disp.</span></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" checked onchange="toggleStatus('${p.id}')">
                            <span class="small text-muted">Activo</span>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-outline-primary" onclick="editProduct('${p.id}')" title="Editar"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct('${p.id}')" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    } catch (err) {
        container.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error al cargar productos</td></tr>';
    }
}

async function loadAdminOrders() {
    const container = document.getElementById('admin-orders-table');
    if (!container) return;

    try {
        const res = await fetch('php/index.php?action=get_all_orders');
        const orders = await res.json();

        if (orders.length === 0) {
            container.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">No hay pedidos registrados</td></tr>';
            return;
        }

        container.innerHTML = orders.map(order => {
            const statusInfo = getStatusBadge(order.status);
            return `
                <tr>
                    <td class="ps-3"><span class="fw-bold text-primary">#${order.order_number}</span></td>
                    <td>
                        <div class="fw-bold">${order.customer_name || 'Usuario'}</div>
                        <small class="text-muted">ID Cliente: #${order.user_id}</small>
                    </td>
                    <td>${new Date(order.date).toLocaleDateString()}</td>
                    <td class="fw-bold">S/. ${parseFloat(order.total).toFixed(2)}</td>
                    <td><span class="badge ${statusInfo.class} px-3 rounded-pill" style="cursor:pointer" onclick="openStatusModal('${order.id}')">${statusInfo.text}</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-dark" onclick="viewOrderDetails('${order.id}')"><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>
            `;
        }).join('');
    } catch (err) {
        console.error('Error al cargar pedidos:', err);
        container.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error de conexión</td></tr>';
    }
}

function getStatusBadge(status) {
    switch(status) {
        case 'processing': return { text: 'En Proceso', class: 'bg-warning-subtle' };
        case 'shipped':    return { text: 'Enviado', class: 'bg-info-subtle' };
        case 'delivered':  return { text: 'Entregado', class: 'bg-success-subtle' };
        case 'cancelled':  return { text: 'Cancelado', class: 'bg-danger-subtle' };
        default:           return { text: 'Pendiente', class: 'bg-secondary-subtle text-secondary' };
    }
}

window.openStatusModal = (id) => {
    document.getElementById('status-order-id').value = id;
    const modal = new bootstrap.Modal(document.getElementById('modalStatus'));
    modal.show();
};

window.updateOrderStatus = async (newStatus) => {
    const id = document.getElementById('status-order-id').value;
    try {
        const res = await fetch('php/index.php?action=update_order_status', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, status: newStatus })
        });
        const data = await res.json();

        if (data.success) {
            if (window.showToast) showToast('Estado actualizado correctamente', 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalStatus'));
            modal.hide();
            loadAdminOrders(); // Recargar tabla
        } else {
            alert('Error al actualizar estado: ' + (data.message || 'Error desconocido'));
        }
    } catch (err) {
        console.error('Error updating order status:', err);
        alert('Error de conexión al servidor');
    }
};

window.viewOrderDetails = (id) => {
    if (window.showToast) showToast('Detalles del pedido próximamente (ID: ' + id + ')', 'info');
    else alert('Detalles del pedido ID: ' + id);
};

async function loadCategories() {
    const select = document.getElementById('select-categorias');
    if (!select) return;

    try {
        const res = await fetch('php/index.php?action=get_categories');
        const categories = await res.json();
        
        select.innerHTML = '<option value="">Selecciona una categoría...</option>' + 
                          categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
    } catch (err) {
        select.innerHTML = '<option value="">Error al cargar categorías</option>';
    }
}

// Funciones globales para botones de acción
window.editProduct = (id) => {
    if (window.showToast) showToast('Módulo de edición próximamente (ID: ' + id + ')', 'info');
    else alert('Función de edición para el producto ID: ' + id);
};

window.deleteProduct = (id) => {
    if (window.showConfirm) {
        window.showConfirm(
            'Eliminar Producto',
            '¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.',
            () => {
                if (window.showToast) showToast('Funcionalidad de eliminación en desarrollo', 'warning');
                else alert('Eliminando producto ID: ' + id);
            }
        );
    }
};
