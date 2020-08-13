const $iconMenu = document.querySelector("#sidebar-menu-icon");
const $appContainer = document.querySelector("#app");
const $menuDropDown = document.querySelectorAll("[data-toggle='drop-down']");
// const $sidebarHeader =

if ($iconMenu) {
  $iconMenu.addEventListener("click", () => {
    $appContainer.classList.toggle("sidebar-toggled");
  });
}

if ($menuDropDown) {
  $menuDropDown.forEach((itemMenu) => {
    itemMenu.addEventListener("click", (e) => {
      e.preventDefault();
      const $parentElement = itemMenu.parentNode;

      $parentElement.classList.toggle("expanded");
      const $iconAngle = itemMenu.querySelector("#icon-angle");

      // debugger;
      if ($parentElement.classList.contains("expanded")) {
        $iconAngle.classList.replace("fa-angle-right", "fa-angle-down");
      } else {
        $iconAngle.classList.replace("fa-angle-down", "fa-angle-right");
      }
    });
  });
}
