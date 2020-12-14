import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loadCount: 0,
    isLoading: false,
  },
  getters: {
    isLoading: state => state.isLoading,
  },
  mutations: {
    changeLoadingState(state, value) {
      value === true ? state.loadCount++ : state.loadCount--
      state.isLoading = state.loadCount > 0
    },
  },
  actions: {
    startLoading(context) {
      context.commit('changeLoadingState', true)
    },

    stopLoading(context) {
      context.commit('changeLoadingState', false)
    },
  },
  modules: {

  },
})
