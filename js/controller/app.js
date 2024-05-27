import { sign_in, sign_up } from "./form.js";
import { accordion } from "./accordion.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("App loaded!");

    if (window.location.pathname === "/projet_final/index.php") {
        // Get the form element
        sign_in();
        sign_up();
    }

    if (window.location.pathname === "/projet_final/store.php") {
        console.log("Store page loaded!");
        // accordion();
    }
});