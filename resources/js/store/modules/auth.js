// import { createStore } from "vuex";
import { auth as api } from '@/api'


// const modules = {
//   auth: {

//   }
// }
const state = () => ({
  me: {},
})

const getters = {

};
const actions = {
  login({ commit }) {
    // console.log('action login');
    commit('setMe', {foo:'bar'});
    api.login({name:"Some name"}).then(response => {
      console.log('success');
      console.log(response);
    }).catch(errors => {
      console.log('errors');
      console.log(errors);

    })
  }
  // async checkout({ commit, state }, products) {
  //   const savedCartItems = [...state.items]
  //   commit('setCheckoutStatus', null)
  //   // empty cart
  //   commit('setCartItems', { items: [] })
  //   try {
  //     await shop.buyProducts(products)
  //     commit('setCheckoutStatus', 'successful')
  //   } catch (e) {
  //     console.error(e)
  //     commit('setCheckoutStatus', 'failed')
  //     // rollback to the cart saved before sending the request
  //     commit('setCartItems', { items: savedCartItems })
  //   }
  // }
};
const mutations = {
  setMe (state, userData) {
    console.log('mutation setMe');
    console.log(userData);
    state.me = userData;
  }

}
export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
  // modules: {
  //   nested
  // }
}


