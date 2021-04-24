const zipCodeRegex = /^(\d{2})(\d{3})(\d{3})$/

function zipCodeFormatter(value) {
  if (!value) return ''

  if (!value.match(zipCodeRegex)) return value

  return value.replace(zipCodeRegex, '$1.$2-$3')
}

export default zipCodeFormatter
