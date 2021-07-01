// eslint-disable-next-line no-unused-vars
const educations = [
  { id: 1, name: 'Ensino fundamental (incompleto)' },
  { id: 2, name: 'Ensino fundamental (completo)' },
  { id: 3, name: 'Ensino médio (incompleto)' },
  { id: 4, name: 'Ensino médio (completo)' },
  { id: 5, name: 'Ensino superior (incompleto)' },
  { id: 6, name: 'Ensino superior (completo)' },
]

export default {
  getAll() {
    return educations
  },
  get(id) {
    return educations.filter(education => education.id === id)[0]
  }
}
