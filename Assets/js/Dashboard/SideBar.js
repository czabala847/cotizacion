const $iconMenu = document.querySelector("#sidebar-menu-icon");
const $appContainer = document.querySelector("#app");
// const $sidebarHeader =

if ($iconMenu) {
  $iconMenu.addEventListener("click", () => {
    $appContainer.classList.toggle("sidebar-toggled");
  });
}
