import ApiInstance from "./index";

export default {
  getProducts(profileId) {
    return ApiInstance.get(`profiles/${profileId}/products`).then(response => response.data);
  },
}
