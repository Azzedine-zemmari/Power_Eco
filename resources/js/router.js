import { compile } from "vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/HomeRoute.vue"),
        meta: {
            title: 'EcoMove - Sustainable Energy & Mobility'
        }
    },
    {
        path: "/admin/users/management",
        component: () => import("./Pages/Admin/UserManagement.vue"),
        meta: {
            title: "User Management",
            requiresAuth: true,
            role: "admin"
        }
    },
    {
        path: "/login",
        component: () => import("./Pages/login.vue"),
        meta: {
            title: "Sign In",
            requiresGuest: true 
        }
    },
    {
        path: "/register",
        component: () => import("./Pages/Register.vue"),
        meta: {
            title: "Create Account",
            requiresGuest: true
        }
    },
    {
        path: "/productManager/dashboard",
        component: () => import("./Pages/ProductManager/Dashboard.vue"),
        meta: {
            title: "Product Manager Dashboard",
            requiresAuth: true,
            role: "product-manager"
        }
    },
    {
        path: "/unauthorized",
        component: () => import('./Pages/Unauthorized.vue')
    },
    {
        path: "/:pathMatch(.*)*",
        component: () => import('./Pages/NotFoundPage.vue')
    },
    {
        path: "/productManager/Product/Category",
        component: () => import('./Pages/ProductManager/Categories.vue'),
        meta: {
            title: "Categories - Product Manager Dashboard",
            requiresAuth: true,
            role: "product-manager"
        }
    },
    {
        path: '/set-password/:token',
        component: () => import('./Pages/SetPassword.vue')
    },
    {
        path: '/productManager/Products',
        component: () => import('./Pages/ProductManager/Products.vue'),
        meta: {
            title: "Products - Product Manager Dashboard",
            requiresAuth: true,
            role: "product-manager"
        }
    },
    {
        path: '/user/forgetPassword',
        component: () => import('./Pages/forgotPassword.vue')
    },
    {
        path: '/reset-password/:token',
        component: () => import('./Pages/ResetPassword.vue'),
        name: 'reset-password'
    },
    {
        path: '/products',
        component: () => import('./Pages/Products.vue')
    },
    {
        path: '/product/:id',
        component: () => import('./Pages/ProductDetails.vue'),
        meta: {
            title: 'Product Details'
        }
    },
    {
        path: '/cart',
        component: () => import('./Pages/CartItem.vue'),
        meta: {
            requiresAuth: true,
            role: "user"
        }
    },
    {
        path: '/checkout',
        component: () => import('./Pages/Checkout.vue'),
        meta: {
            title: 'Checkout Page',
            requiresAuth: true,
            role: "user"
        }
    },
    {
        path: '/user/profile',
        component: () => import('./Pages/User/Profile.vue'),
        meta: {
            title: 'User Profile',
            requiresAuth: true,
            role: "user"
        }
    },
    {
        path: '/saleList',
        component: () => import('./Pages/Commercial/SalesList.vue'),
        meta: {
            title: 'Sales list',
            requiresAuth: true,
            role: "commercial"
        }
    },
    {
        path: '/user/devis',
        component: () => import('./Pages/User/Devis.vue'),
        meta: {
            title: 'Devis',
            requiresAuth: true,
            role: "user"
        }
    },
    {
        path: '/user/facture',
        component: () => import('./Pages/User/Facture.vue'),
        meta: {
            title: 'facture',
            requiresAuth: true,
            role: "user"
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Helper function to validate token
async function validateToken(token) {
    try {
        const response = await fetch('/api/user', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        return response.ok;
    } catch (error) {
        return false;
    }
}

// Helper function to clear invalid auth data
function clearAuthData() {
    localStorage.removeItem('token');
    localStorage.removeItem('role');
}

router.beforeEach(async (to, from, next) => {
    const token = localStorage.getItem('token');
    const userRole = localStorage.getItem('role');

    // Handle guest-only routes (login, register)
    if (to.meta.requiresGuest) {
        if (token) {
            // If user is authenticated, validate token first
            const isValidToken = await validateToken(token);
            if (isValidToken) {
                // Redirect to appropriate dashboard based on role
                switch (userRole) {
                    case 'admin':
                        return next('/admin/users/management');
                    case 'product-manager':
                        return next('/productManager/dashboard');
                    case 'commercial':
                        return next('/saleList');
                    case 'user':
                        return next('/user/profile');
                    default:
                        return next('/');
                }
            } else {
                // Token is invalid, clear it and allow access to login
                clearAuthData();
                return next();
            }
        }
        return next();
    }

    // Handle protected routes
    if (to.meta.requiresAuth) {
        if (!token) {
            return next("/");
        }

        // Validate token before proceeding
        const isValidToken = await validateToken(token);
        if (!isValidToken) {
            clearAuthData();
            return next("/");
        }

        // Check role authorization
        if (to.meta.role && to.meta.role !== userRole) {
            return next('/unauthorized');
        }
    }

    next();
});

export default router;