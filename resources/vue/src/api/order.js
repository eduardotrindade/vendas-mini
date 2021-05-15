import ApiInstance from "./index";

export default {
  getAll(filters = {}) {
    return ApiInstance.get(`orders`, {params: filters}).then(response => response.data)
  },
  create(order) {
    return ApiInstance.post(`orders`, order).then(response => response.data);
  },
  cancel(order) {
    return ApiInstance.delete(`orders/${order.id}`).then(response => response.data);
  },
  paymentNotification(data) {
    return ApiInstance.post(`orders/payment-notification`, data).then(response => response.data);
  },
  exportFile() {
    ApiInstance.get(`orders/export`)
  },
}
