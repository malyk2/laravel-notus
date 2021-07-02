import { createWebHistory, createRouter } from "vue-router";
import Admin from './layouts/Admin.vue'
import Auth from './layouts/Auth.vue'
// Admin
import Dashboard from './views/admin/Dashboard.vue'
import Settings from './views/admin/Settings.vue'
import Tables from './views/admin/Tables.vue'
import Maps from './views/admin/Maps.vue'
// Auth
import Login from './views/auth/Login.vue'
import Register from './views/auth/Register.vue'
// Index
import Landing from "@/views/Landing.vue";
import Profile from "@/views/Profile.vue";
import Index from './views/Index.vue'

const routes = [
  {
    path: "/",
    component: Index,
  },
  {
    path: "/admin",
    redirect: "/admin/dashboard",
    component: Admin,
    children: [
      {
        path: "/admin/dashboard",
        component: Dashboard,
      },
      {
        path: "/admin/settings",
        component: Settings,
      },
      {
        path: "/admin/tables",
        component: Tables,
      },
      {
        path: "/admin/maps",
        component: Maps,
      },
    ],

  },
  {
    path: "/auth",
    redirect: "/auth/login",
    component: Auth,
    children: [
      {
        path: "/auth/login",
        component: Login,
      },
      {
        path: "/auth/register",
        component: Register,
      },
    ],
  },
  {
    path: "/landing",
    component: Landing,
  },
  {
    path: "/profile",
    component: Profile,
  },
]

export default createRouter({
  history: createWebHistory(),
  routes,
});
