import User from "./User.js";

document.addEventListener("DOMContentLoaded", async () => {
  let newUser = new User();
  const $tableContainer = document.querySelector("#userTable");

  await newUser.renderUsers($tableContainer);
});
