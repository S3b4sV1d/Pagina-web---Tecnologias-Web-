/**
 * Layout Orchestrator
 * Punto de entrada único de la aplicación
 */

import { headerTemplate } from './templates/header.js?v=1.1';
import { footerTemplate } from './templates/footer.js';
import { initUI, _updateThemeIcon } from './ui.js';
import { checkAuth, logout } from './auth.js';

// 1. Aplicar Dark Mode antes del primer paint (Síncrono)
const _applyInitialTheme = () => {
    const theme = localStorage.getItem('truxup-theme') || 'light';
    document.documentElement.setAttribute('data-theme', theme);
};
_applyInitialTheme();

// 2. Detectar Base URL
const _detectBase = () => {
    const script = document.querySelector('script[src*="layout.js"]');
    const scriptPath = script ? script.getAttribute('src') : '';
    window.BASE = window.BASE_URL || scriptPath.replace('js/layout.js', '') || './';
};
_detectBase();

// 3. Orquestación principal
document.addEventListener('DOMContentLoaded', async () => {
    try {
        await _injectLayout();
        initUI();
        // initI18n(); // Pendiente implementación futura
        await checkAuth();
        
        // Sincronizar iconos de UI post-render
        _updateThemeIcon(document.documentElement.getAttribute('data-theme'));
        
        // Integración con módulos antiguos
        if (window.updateCartBadge) window.updateCartBadge();
        if (window.renderCartOffcanvas) window.renderCartOffcanvas();
        
        // Escuchar eventos de comunicación entre módulos
        _setupInternalCommunication();

    } catch (err) {
        console.error('Initialization error:', err);
    }
});

const _injectLayout = async () => {
    const headerContainer = document.getElementById('global-header');
    const footerContainer = document.getElementById('global-footer');

    if (headerContainer) {
        headerContainer.insertAdjacentHTML('afterbegin', headerTemplate());
    }
    if (footerContainer) {
        footerContainer.insertAdjacentHTML('afterbegin', footerTemplate());
    }
};

const _setupInternalCommunication = () => {
    // Escuchar solicitudes de logout desde cualquier parte de la UI
    document.addEventListener('app:logout', () => {
        logout();
    });
};

