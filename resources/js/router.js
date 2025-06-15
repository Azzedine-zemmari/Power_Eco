import { compile } from "vue";
import { createRouter,createWebHistory } from "vue-router";

const routes = [
    {
        path:"/",
        component : () => import("./Pages/HomeRoute.vue"),
        meta:{
            title:'EcoMove - Sustainable Energy & Mobility'
        }
    },
    {
        path : "/test",
        component: () => import("./Pages/TestRoute.vue")
    },
    {
        path:"/admin/users/management",
        component:() => import("./Pages/Admin/UserManagement.vue"),
        meta:{
            title:"User Management",
            requiresAuth:true,
            role: "admin"
        }
    },
    {
        path:"/login",
        component:() => import("./Pages/login.vue"),
        meta:{
            title:"Sign In"
        }
    },
    {
        path:"/register",
        component:() => import("./Pages/Register.vue"),
        meta:{
            title:"Create Account"
        }
    },
    {
        path:"/productManager/dashboard",
        component:() => import("./Pages/ProductManager/Dashboard.vue"),
        meta:{
            title:"Product Manager Dashboard",
            requiresAuth: true,
            role: "product-manager"
        }
    },
    {
        path:"/unauthorized",
        component:()=>import('./Pages/Unauthorized.vue')
    },
    {
        path:"/:pathMatch(.*)*",
        component:()=>import('./Pages/NotFoundPage.vue')
    },
    {
        path:"/productManager/Product/Category",
        component:()=>import('./Pages/ProductManager/Categories.vue'),
        meta:{
            title:"Categories - Product Manager Dashboard",
            requiresAuth:true,
            role: "product-manager"
        }
    },
    {
        path:'/set-password/:token',
        component:() => import('./Pages/SetPassword.vue')
    },
    {
        path:'/productManager/Products',
        component:()=>import('./Pages/ProductManager/Products.vue'),
        meta:{
            title:"Products - Product Manager Dashboard",
            requiresAuth:true,
            role:"product-manager"
        }
    },{
        path:'/user/forgetPassword',
        component:()=>import('./Pages/forgotPassword.vue')
    },
    {
        path: '/reset-password/:token',
        component: () => import('./Pages/ResetPassword.vue'),
        name: 'reset-password'
    },
    {
        path:'/products',
        component:()=> import('./Pages/Products.vue')
    },
    {
        path:'/product/:id',
        component:()=>import('./Pages/ProductDetails.vue'),
        meta:{
            title:'Product Details'
        }
    },{
        path:'/cart',
        component:() => import('./Pages/CartItem.vue')
    },{
    path:'/checkout',
        component:() => import('./Pages/Checkout.vue'),
        meta:{
            title:'Checkout Page'
        }
    },
    {
        path:'/user/profile',
        component:()=> import('./Pages/User/Profile.vue'),
        meta:{
            title:'User Profile'
        }
    },{
        path:'/saleList',
        component:() => import('./Pages/Commercial/SalesList.vue'),
        meta:{
            title:'Sales list'
        }
    },{
        path:'/user/devis',
        component:()=>import('./Pages/User/Devis.vue'),
        meta:{
            title:'Devis'
        }
    },{
        path:'/user/facture',
        component : () => import('./Pages/User/Facture.vue'),
        meta:{
            title:'facture'
        }
    }
];

const router =  createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to,from,next)=>{
    const token = localStorage.getItem('token')
    const userRole = localStorage.getItem('role')

    if(to.meta.requiresAuth){
        if(!token){
            return next("/login")
        }
        if(to.meta.role && to.meta.role !== userRole){
            return next('/unauthorized');
        }
    }
    next();

})

export default router;