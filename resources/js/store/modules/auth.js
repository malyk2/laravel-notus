import { auth as api } from '@/api'

const state = () => ({
  me: {},
  message: {
    text: '',
    type: 'success',
    show: false,
  }
})

const getters = {

};
const actions = {
  async login({ commit }, formData) {
    commit('setMessage', {
      show: false,
    })
    await api.login(formData).then(response => {
      commit('setMe', response.data)
    }).catch(response => {
      throw response
    })
  },
  async logout({ commit }) {
    await api.logout().then(response => {
      commit('setMe', {})
    }).catch(response => {
      throw response
    })
  },
  async getMe({ commit }) {
    console.log('ACTION getMe');
    await api.getMe().then(response => {
      commit('setMe', response.data)
    }).catch(response => {
      throw response
    })
  }
};
const mutations = {
  setMe(state, userData) {
    state.me = userData;
  },
  setMessage(state, message) {
    state.message = message;
  }

}
export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}


