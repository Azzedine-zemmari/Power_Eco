import { compile } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from '@/stores/AuthStore';


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
        },
        name:'productDetails'
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
            requiresAuth: true,
            role: 1,
            title: 'User Profile',
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
];

const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();

  if (!auth.authChecked) {
    await auth.fetchUser();
  }

  const isAuthenticated = auth.isAuthenticated;
  const userRole = auth.user?.role_id || null;

  if (to.meta.requiresGuest && isAuthenticated) {
    // redirect logged-in users away from guest pages
    switch (userRole) {
      case 4: return next('/admin/users/management');
      case 2: return next('/productManager/dashboard');
      case 3: return next('/saleList');
      case 1: return next('/');
      default: return next('/');
    }
  }

  if (to.meta.requiresAuth && !isAuthenticated) {
    return next('/');
  }

  if (to.meta.requiresAuth && to.meta.role && Number(to.meta.role) !== Number(userRole)) {
    return next('/unauthorized');
  }

  next();
});


export default router;