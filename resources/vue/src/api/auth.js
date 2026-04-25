import ApiInstance from "./index"

export default {
  login(user) {
    return ApiInstance.post(`auth/login`, user).then(response => response.data)
  },
  logout() {
    return ApiInstance.post(`auth/logout`).then(response => response.data)
  },
  forgotPassword(email) {
    return ApiInstance.post(`auth/forgot-password`, { email }).then(response => response.data)
  },
  resetPassword(data) {
    return ApiInstance.post(`auth/reset-password`, data).then(response => response.data)
  },
  connectContaAzul() {
    return ApiInstance.get(`auth/conta-azul/authorize`).then(response => response.data.data)
  }
}
