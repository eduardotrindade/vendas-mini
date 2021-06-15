import ApiInstance from "./index";

export default {
  sendMoreInformation(numberWhatsApp) {
    return ApiInstance.post(`more-information`, { numberWhatsApp }).then(response => response.data);
  },
}
