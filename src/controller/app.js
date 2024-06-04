import { sign_in, sign_up } from "./form.js";
import {nav_admin} from "./nav_admin.js";
import { fill_shop } from "./shop.js";

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
    if (window.location.pathname === "/projet_final/store.php") {
        console.log("shop loaded!");
        if (window.location.search === "?type=batiment") {
            console.log("bâtiment");
            fill_shop("bâtiment");
        }
        if (window.location.search === "?type=soldat") {
            console.log("soldat");
            fill_shop("type_soldat");
        }
    }
});