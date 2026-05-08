/**
 * Auth Module
 * Gestiona la sesión del usuario con caché en sessionStorage
 */

const CACHE_KEY = 'truxup_auth_session';
const CACHE_TTL = 5 * 60 * 1000; // 5 minutos

export const checkAuth = async () => {
    const cached = _getCache();
    if (cached) {
        _dispatchEvent(cached);
        return cached;
    }

    try {
        const response = await fetch('php/index.php?action=check');
        const data = await response.json();
        
        if (data.loggedIn) {
            _setCache(data.user);
            _dispatchEvent(data.user);
            return data.user;
        } else {
            _clearCache();
            _dispatchEvent(null);
            return null;
        }
    } catch (err) {
        console.error('Auth Error:', err);
        return null;
    }
};

export const login = async (email, password) => {
    try {
        const response = await fetch('php/index.php?action=login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        });
        const data = await response.json();
        
        if (data.success) {
            _setCache(data.user);
            _dispatchEvent(data.user);
            return { success: true, user: data.user };
        } else {
            return { success: false, message: data.message };
        }
    } catch (err) {
        console.error('Login error:', err);
        return { success: false, message: 'Error de conexión con el servidor' };
    }
};

export const register = async (userData) => {
    try {
        const response = await fetch('php/index.php?action=register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData)
        });
        const data = await response.json();
        
        if (data.success) {
            _setCache(data.user);
            _dispatchEvent(data.user);
            return { success: true, user: data.user };
        } else {
            return { success: false, message: data.message };
        }
    } catch (err) {
        console.error('Registration error:', err);
        return { success: false, message: 'Error de conexión con el servidor' };
    }
};

export const logout = async () => {
    // Limpiar caché inmediatamente para feedback visual instantáneo
    _clearCache();
    
    // Mostrar alerta de cierre de sesión
    if (window.showToast) {
        window.showToast('Cerrando sesión...', 'info', 2000);
    }

    try {
        await fetch('php/index.php?action=logout');
    } catch (err) {
        console.error('Logout error:', err);
    }

    // Pequeña espera para que se vea el toast si es necesario, 
    // aunque la redirección suele ser lo esperado.
    const base = window.BASE || window.BASE_URL || './';
    setTimeout(() => {
        window.location.href = base + 'index.html';
    }, 500);
};

const _getCache = () => {
    const data = sessionStorage.getItem(CACHE_KEY);
    if (!data) return null;
    
    const parsed = JSON.parse(data);
    if (Date.now() - parsed.timestamp > CACHE_TTL) {
        _clearCache();
        return null;
    }
    return parsed.user;
};

const _setCache = (user) => {
    sessionStorage.setItem(CACHE_KEY, JSON.stringify({
        user,
        timestamp: Date.now()
    }));
    // Sincronizar con localStorage para compatibilidad con scripts antiguos si es necesario
    localStorage.setItem('truxup-user', JSON.stringify(user));
};

const _clearCache = () => {
    sessionStorage.removeItem(CACHE_KEY);
    localStorage.removeItem('truxup-user');
};

const _dispatchEvent = (user) => {
    document.dispatchEvent(new CustomEvent('app:auth-changed', { 
        detail: { user, loggedIn: !!user } 
    }));
};

