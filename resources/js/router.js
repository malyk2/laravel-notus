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
import PasswordForgot from './views/auth/PasswordForgot.vue'
import PasswordReset from './views/auth/PasswordReset.vue'
import Register from './views/auth/Register.vue'
import VerifyEmail from './views/auth/VerifyEmail.vue'
// Index
import Landing from "@/views/Landing.vue";
import Profile from "@/views/Profile.vue";
import Index from './views/Index.vue'
// Users
import UsersIndex from './views/admin/users/UsersIndex.vue'
import UsersForm from './views/admin/users/UsersForm.vue'
// middlewares
import { Auth as AuthMiddleware } from '@/middlewares/Auth'

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
        name: "admin.dashboard",
        component: Dashboard,
        meta: { middleware: [new AuthMiddleware()] },
      },
      {
        path: "/admin/users",
        name: "admin.users.index",
        component: UsersIndex,
        meta: { middleware: [new AuthMiddleware()] },
      },
      {
        path: "/admin/users/create",
        name: "admin.users.create",
        component: UsersForm,
        props: {'id': null},
        meta: { middleware: [new AuthMiddleware()] },
      },
      {
        path: "/admin/users/:id",
        name: "admin.users.edit",
        component: UsersForm,
        props: true,
        meta: { middleware: [new AuthMiddleware()] },
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
      // {
      //   path: "/admin/login",
      //   component: Login,
      // },
    ],

  },
  {
    path: "/admin",
    // redirect: "/admin/login",
    component: Auth,
    children: [
      {
        path: "/admin/login",
        name: 'admin.login',
        component: Login,
      },
      {
        path: "/admin/forgot-password",
        name: 'admin.password.forgot',
        component: PasswordForgot,
      },
      {
        path: "/admin/reset-password",
        name: 'admin.password.reset',
        component: PasswordReset,
      },
      {
        path: "/admin/register",
        name: 'admin.register',
        component: Register,
      },
      {
        path: "/admin/verify-email/:id/:hash",
        name: 'admin.verify.verify',
        component: VerifyEmail,
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

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  if (to.meta.middleware) {
    let result;
    for (const middleware of to.meta.middleware) {
      result = await middleware.handle(to, from, next)
      if (result !== true) {
        return result
      }
    }
    return next();
  } else next();
})


export default router
