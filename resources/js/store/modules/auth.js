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
      commit('setMessage', {
        show: true,
        text: response.data.message,
        type: 'danger',
      })
      throw response.data

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


