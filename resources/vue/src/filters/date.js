const DateFormatter = new Intl.DateTimeFormat('pt-BR', {timeZone: 'UTC'});
const DateTimeFormatter = new Intl.DateTimeFormat('pt-BR', {year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false, timeZone: 'UTC'});

function dateFormatter(date, dateTime = false) {
  let formatter = dateTime ? DateTimeFormatter : DateFormatter,
    dateObj   = date instanceof Date ? date : Date.parse(date);

  if (isNaN(dateObj)) return;

  return formatter.format(dateObj);
}

export default dateFormatter
