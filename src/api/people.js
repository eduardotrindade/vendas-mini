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
  },
  get(peopleId) {
    return ApiInstance.get(`people/${peopleId}`).then(response => response.data.data)
  },
  makeActive(peopleId, profile_id = null) {
    return ApiInstance.patch(`people/${peopleId}/active`, { profile_id }).then(response => response.data.data)
  },
}
