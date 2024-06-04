import { sign_in, sign_up } from "./form.js";
import { modif_form } from "./modif_form.js";
import { nav_admin } from "./nav_admin.js";
import { fill_shop } from "./shop.js";

document.addEventListener("DOMContentLoaded", () => {
    if (window.location.pathname === "/projet_final/index.php" || window.location.pathname === "/projet_final/") {
        sign_in();
        sign_up();
    }
    if (window.location.pathname !== "/projet_final/index.php" || window.location.pathname !== "/projet_final/") {
        nav_admin();
    }
    if (window.location.pathname === "/projet_final/store.php") {
        if (window.location.search === "?type=batiment") {
            fill_shop("batiment");
        }
        if (window.location.search === "?type=soldat") {
            fill_shop("type_soldat");
        }
    }
    if (window.location.pathname === "/projet_final/modif.php") {
        const id = window.location.search.split("=")[1].split("&")[0];
        const type = window.location.search.split("=")[2];
        modif_form(id, type);
    }
});