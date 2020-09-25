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
  }).then((result) => result.value);
};

const modalRol = (title = "", rol) => {
  return Swal.fire({
    title: title,
    html:
      `<input value="${
        rol ? rol[0] : ""
      }" type="text" id="swal-input1" class="swal2-input" placeholder="Nombre Rol" autocomplete="off" required >` +
      `<textarea id="swal-input2" class="swal2-input" placeholder="Descripción">${
        rol ? rol[1] : ""
      }</textarea>`,
    focusConfirm: false,
    confirmButtonColor: "#ce0f3d",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    preConfirm: () => {
      return [
        ["nombre", document.getElementById("swal-input1").value],
        ["descripción", document.getElementById("swal-input2").value],
      ];
    },
  });
};

export { showModal, modalRol };
