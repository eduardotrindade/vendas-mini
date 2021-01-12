import ApiInstance from "./index";

export default {
  insert(order) {
    return ApiInstance.post(`orders`, order).then(response => response.data);
  },
}
