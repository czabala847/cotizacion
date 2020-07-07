// Mostrar showModal, con la libreria sweet alert
const showModal = async (title = "", text = "", icon = "", opt) => {
  let response = await Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: opt.showCancelButton,
    confirmButtonColor: "#353a62",
    cancelButtonColor: "#ce0f3d",
    confirmButtonText: "Ok",
    cancelButtonText: "Cancelar",
    allowOutsideClick: opt.allowOutsideClick,
    allowEscapeKey: opt.allowEscapeKey,
  }).then((result) => result.value);

  return response;
};

export { showModal };
