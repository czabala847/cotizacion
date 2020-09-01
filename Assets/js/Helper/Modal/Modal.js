// Mostrar showModal, con la libreria sweet alert
const showModal = (title = "", text = "", icon = "success", opt) => {
  return Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: opt ? opt.showCancelButton : true,
    confirmButtonColor: "#353a62",
    cancelButtonColor: "#ce0f3d",
    confirmButtonText: "Ok",
    cancelButtonText: "Cancelar",
    allowOutsideClick: opt ? opt.allowOutsideClick : true,
    allowEscapeKey: opt ? opt.allowEscapeKey : true,
  }).then((result) => {
    return result.value;
  });
};

export { showModal };
