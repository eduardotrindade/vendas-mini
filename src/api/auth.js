import ApiInstance from "./index"

export default {
  login(user) {
    return ApiInstance.post(`auth/login`, user).then(response => response.data)
  },
  logout() {
    return ApiInstance.post(`auth/logout`).then(response => response.data)
  },
}
