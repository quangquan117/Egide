import { get_all_data, get_data_from_token } from "./link.js";

export async function fill_shop(type) {
    const ul = document.querySelector(".shop");
    const all_li = await get_all_data(type);
    let result = await get_data_from_token();

    if (all_li === "Erreur lors de la récupération des données") {
        const li = document.createElement("li");
        li.innerHTML = "Erreur lors de la récupération des données";
        ul.appendChild(li);
    }

    for (let i = 0; i < all_li.length; i++) {
        const li = document.createElement("li");
        const details = document.createElement("details");
        const summary = document.createElement("summary");
        const div = document.createElement("div");
        const button = document.createElement("button");

        summary.innerHTML = all_li[i].nom + "<br>" + all_li[i].description;
        div.innerHTML = all_li[i].description;
        button.innerHTML = "achat";

        details.appendChild(summary);
        details.appendChild(div);
        details.appendChild(button);
        li.appendChild(details);
        ul.appendChild(li);
        if (result && result["admin"] == true) {
            console.log("admin");
            const button_modif = document.createElement("button");
            button_modif.innerHTML = "modifier";
            button_modif.addEventListener("click", () => {
                document.location.href = "http://localhost/projet_final/modif.php?id=" + all_li[i].ID_Batiment + "&type=" + type;
            });
            details.appendChild(button_modif);
        }
    }
    if (result && result["admin"] == true) {
        const button_add = document.createElement("button");
        button_add.innerHTML = "ajouter";
        button_add.addEventListener("click", () => {
            document.location.href = "http://localhost/projet_final/modif.php?id=0&type=" + type;
        });
        ul.appendChild(button_add);
    }
}