import ApiInstance from "./index";

export default {
  getByDocumentNumber(documentNumber) {
    return ApiInstance.post(`people/document-number`, {documentNumber}).then(response => response.data);
  },
}
