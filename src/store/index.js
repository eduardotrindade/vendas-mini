import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loadCount: 0,
    isLoading: false,
    people: {},
  },
  getters: {
    isLoading: state => state.isLoading,
    people: state => state.people,
  },
  mutations: {
    changeLoadingState(state, value) {
      value === true ? state.loadCount++ : state.loadCount--
      state.isLoading = state.loadCount > 0
    },

    setPeople(state, value) {
      state.people = value;
    },
  },
  actions: {
    startLoading(context) {
      context.commit('changeLoadingState', true)
    },

    stopLoading(context) {
      context.commit('changeLoadingState', false)
    },

    setPeople(context, people) {
      context.commit('setPeople', people);
    },
  },
  modules: {

  },
})
