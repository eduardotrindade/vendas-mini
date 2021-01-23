import ApiInstance from "./index"

export default {
  getByDocumentNumber(documentNumber) {
    return ApiInstance.post(`people/document-number`, {documentNumber}).then(response => response.data.data)
  },
  save(people) {
    return ApiInstance.post(`people`, people).then(response => response.data.data)
  },
  getAll(filters = {}) {
    return ApiInstance.get(`people`, { params: filters }).then(response => response.data)
  }
}
