const NumberFormatter = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });

export default function (value) {
  let number = isNaN(value) ? 0 : value;
  return NumberFormatter.format(number);
}
