// Quitar acentos en una cadena de texto
const removeAccents = (str) => {
  return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
};

export { removeAccents };
