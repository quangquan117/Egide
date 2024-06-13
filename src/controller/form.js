import { link } from "./link.js";

export function sign_in() {
    const form = document.querySelector(".sign_in");
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        for (const key in data) {
            data[key] = data[key].replace(/</g, "&lt;").replace(/>/g, "&gt;");
        }
        const email = data.email;
        const emailRegex = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;
        if (!emailRegex.test(email)) {
            alert("Email invalide");
            return;
        }
        link("sign_in", data);
    });
}

export function sign_up() {
    const form = document.querySelector(".sign_up");
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        for (const key in data) {
            data[key] = data[key].replace(/</g, "&lt;").replace(/>/g, "&gt;");
        }
        const email = data.email;
        const emailRegex = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;
        if (!emailRegex.test(email)) {
            alert("Email invalide");
            return;
        }
        link("sign_up", data);
    });
}