// import aut
import store from '@/store'

class Auth {
  async handle(to, from, next) {
    const exists = store.state.auth.me;
    if (exists.id) {
      return true;
      // return 'exists';
    } else {
      // try to get current user
      return await store.dispatch('auth/getMe')
        .then(() => true)
        .catch(() => next({ name: 'admin.login' }))
    }
  }
}

export { Auth };
