import ApiInstance from "./index";

export default {
  getAll() {
    return ApiInstance.get(`states`).then(response => response.data);
  },
  getCities(stateId) {
    return ApiInstance.get(`states/${stateId}/cities`).then(response => response.data);
  },
}
