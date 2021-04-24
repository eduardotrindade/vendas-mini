const cnpjRegex = /^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/
const cpfRegex = /^(\d{3})(\d{3})(\d{3})(\d{2})$/

function cnpjFormatter(value) {
  if (!value.match(cnpjRegex)) return value

  return value.replace(cnpjRegex, '$1.$2.$3/$4-$5')
}

function cpfFormatter(value) {
  if (!value.match(cpfRegex)) return value

  return value.replace(cpfRegex, '$1.$2.$3-$4')
}

function documentNumberFormatter(value) {
  if (!value) return ''

  if (value.length > 11) {
    return cnpjFormatter(value)
  }

  return cpfFormatter(value)
}

export default documentNumberFormatter
