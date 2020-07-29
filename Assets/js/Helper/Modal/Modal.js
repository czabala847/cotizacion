// Mostrar showModal, con la libreria sweet alert
const showModal = async (title = "", text = "", icon = "success", opt) => {
  let response = await Swal.fire({
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
  }).then((result) => result.value);

  return response;
};

export { showModal };
