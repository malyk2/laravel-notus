// import aut
import store from '@/store'

class AuthMiddleware {
  async handle(to, from, next) {
    const exists = store.state.auth.me;
    if (exists.id) {
      return true;
      // return 'exists';
    } else {
      // try to get current user
      return await store.dispatch('auth/getMe').then((me) => {
        // return 'success get'
        return true
      }).catch(response => {
        return next({ name: 'admin.login' })
        // throw false;
      })
    }
  }
}

export default AuthMiddleware;
