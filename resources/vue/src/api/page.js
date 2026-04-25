import ApiInstance from "./index";

export default {
  sendMoreInformation(data) {
    return ApiInstance.post(`more-information`, data).then(response => response.data);
  },
}
