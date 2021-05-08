import ApiInstance from "./index"

export default {
  getByDocumentNumber(documentNumber) {
    return ApiInstance.post(`people/document-number`, {documentNumber}).then(response => response.data.data)
  },
  getAll(filters = {}) {
    return ApiInstance.get(`people`, { params: filters }).then(response => response.data)
  },
  get(peopleId) {
    return ApiInstance.get(`people/${peopleId}`).then(response => response.data.data)
  },
  save(people) {
    return ApiInstance.post(`people`, people).then(response => response.data.data)
  },
  update(people) {
    return ApiInstance.put(`people/${people.id}`, people).then(response => response.data.data)
  },
  changeActive(peopleId, profile_id = null) {
    return ApiInstance.patch(`people/${peopleId}/change-active`, {profile_id}).then(response => response.data.data)
  },
  exportFile() {
    return ApiInstance.get(`export-people`).then(response => response.data.data)
  },
}
