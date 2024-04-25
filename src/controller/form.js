import { link } from "./link.js";

export function sign_in() {
    const form = document.querySelector(".sign_in");
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        console.log(data);
        link("sign_in", data);
    });
}

export function sign_up() {
    const form = document.querySelector(".sign_up");
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        console.log(data);
        link("sign_up", data);
    });
}