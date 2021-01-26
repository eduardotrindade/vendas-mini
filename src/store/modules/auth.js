import AuthApi from '@/api/auth'

export default {
  state: {
    user: null
  },
  getters: {
    isAuthenticated: state => !!state.user,
    user: state => state.user,
  },
  mutations: {
    setUser(state, user){
      state.user = user
    },

    logout(state, user) {
      state.user = user
    },
  },
  actions: {
    async login({commit}, user) {
      user = await AuthApi.login(user)
      await commit('setUser', user)
    },

    async logout({commit}){
      let user = null
      await AuthApi.logout()
      commit('logout', user)
    }
  },
}
