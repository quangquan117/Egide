import { get_data_from_token } from "./link.js";

export async function nav_admin(admin) {
    let result = await get_data_from_token();
    if (result && result["admin"] == true) {
        console.log("admin");
        const nav = document.querySelector(".burger-menu");
        const li = document.createElement("li");
        const a = document.createElement("a");
        a.textContent = "Users";
        a.href = "./user.php";
        li.appendChild(a);
        nav.appendChild(li);
    }
}