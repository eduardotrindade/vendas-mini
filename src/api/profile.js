import ApiInstance from "./index";

export default {
  MASTER: 2,
  AFILIADO: 3,

  getProducts(profileId) {
    return ApiInstance.get(`profiles/${profileId}/products`).then(response => response.data);
  },
}
