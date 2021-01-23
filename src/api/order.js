import ApiInstance from "./index";

export default {
  insert(order) {
    return ApiInstance.post(`orders`, order).then(response => response.data);
  },
  getAll(filters = {}) {
    return ApiInstance.get(`orders`, { params: filters }).then(response => response.data)
  },
}
