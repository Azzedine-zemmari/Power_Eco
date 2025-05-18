import { createRouter,createWebHistory } from "vue-router";

const routes = [
    {
        path:"/",
        component : () => import("./Pages/HomeRoute.vue"),
        meta:{
            title:'Home'
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
            title:"User Management"
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
    }
];

export default createRouter({
    history:createWebHistory(),
    routes
})