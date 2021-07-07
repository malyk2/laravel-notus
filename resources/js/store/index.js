import { createStore } from 'vuex';
import auth from './modules/auth'


// const modules = {
//   auth: auth,
// }

export default createStore({
  modules: {
    auth,
  },
});
