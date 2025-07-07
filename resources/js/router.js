import { compile } from "vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/HomeRoute.vue"),
        meta: {
            title: 'EcoMove - Sustainable Energy & Mobility'
        },
        name:'Home'
    },
    {
        path: "/admin/users/management",
        component: () => import("./Pages/Admin/UserManagement.vue"),
        meta: {
            title: "User Management",
            requiresAuth: true,
            role: 4
        },
        name:'userManagement'
    },
    {
        path: "/login",
        component: () => import("./Pages/login.vue"),
        meta: {
            title: "Sign In",
            requiresGuest: true // Only guests (not authenticated users) can access
        },
        name:'login'
    },
    {
        path: "/register",
        component: () => import("./Pages/Register.vue"),
        meta: {
            title: "Create Account",
            requiresGuest: true // Only guests (not authenticated users) can access
        },
        name:"register"
    },
    {
        path: "/productManager/dashboard",
        component: () => import("./Pages/ProductManager/Dashboard.vue"),
        meta: {
            title: "Product Manager Dashboard",
            requiresAuth: true,
            role: 2
        },
        name:'dashboard'
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
            role: 2
        },
        name:'categories'
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
            role: 2
        },
        name:'products'
    },
    {
        path: '/user/forgetPassword',
        component: () => import('./Pages/forgotPassword.vue'),
        meta:{
            requiresGuest: true
        },
        name:'forgetPassword'
    },
    {
        path: '/reset-password/:token',
        component: () => import('./Pages/ResetPassword.vue'),
        name: 'reset-password'
    },
    {
        path: '/products',
        component: () => import('./Pages/Products.vue'),
        name:'Userproducts'
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
            role: 1
        },
        name:'cart'
    },
    {
        path: '/checkout',
        component: () => import('./Pages/Checkout.vue'),
        meta: {
            title: 'Checkout Page',
            requiresAuth: true,
            role: 1
        },
        name:'checkout'
    },
    {
        path: '/user/profile',
        component: () => import('./Pages/User/Profile.vue'),
        meta: {
            title: 'User Profile',
            requiresAuth: true,
            role: 1
        },
        name:'profile'
    },
    {
        path: '/saleList',
        component: () => import('./Pages/Commercial/SalesList.vue'),
        meta: {
            title: 'Sales list',
            requiresAuth: true,
            role: 3
        },
        name:'salesList'
    },
    {
        path: '/user/devis',
        component: () => import('./Pages/User/Devis.vue'),
        meta: {
            title: 'Devis',
            requiresAuth: true,
            role: 1
        },
        name:'devis'
    },
    {
        path: '/user/facture',
        component: () => import('./Pages/User/Facture.vue'),
        meta: {
            title: 'facture',
            requiresAuth: true,
            role: 1
        },
        name:'facture'
    },
    {
        path:'/debug',
        component:() => import('./Pages/TestRoute.vue')
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
                    case 4:
                        return next('/admin/users/management');
                    case 2:
                        return next('/productManager/dashboard');
                    case 3:
                        return next('/saleList');
                    case 1:
                        return next('/');
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
        if (to.meta.role && Number(to.meta.role) !== Number(userRole)) {
            return next('/unauthorized');
        }
    }

    next();
});

export default router;