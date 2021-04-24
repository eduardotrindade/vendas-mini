const cellphoneRegex = /^(\d{2})(\d{5})(\d{4})$/
const phoneRegex = /^(\d{2})(\d{4})(\d{4})$/

function cellphoneFormatter(value) {
  if (!value.match(cellphoneRegex)) return value

  return value.replace(cellphoneRegex, '($1) $2-$3')
}

function fixedphoneFormatter(value) {
  if (!value.match(phoneRegex)) return value

  return value.replace(phoneRegex, '($1) $2-$3')
}

function phoneFormatter(value) {
  if (!value) return ''

  if (value.length === 11) {
    return cellphoneFormatter(value)
  }

  return fixedphoneFormatter(value)
}

export default phoneFormatter
