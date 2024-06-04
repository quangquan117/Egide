import { sign_in, sign_up } from "./form.js";
import {nav_admin} from "./nav_admin.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("App loaded!");

    if (window.location.pathname === "/projet_final/index.php" ||
        window.location.pathname === "/projet_final/") {
        sign_in();
        sign_up();
    }
    if (window.location.pathname !== "/projet_final/index.php" ||
    window.location.pathname !== "/projet_final/") {
        nav_admin();
    }
});