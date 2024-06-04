import { get_li } from "./link.js";

export async function fill_shop(type){
    const ul = document.querySelector(".shop");
    const all_li = await get_li(type);

    console.log(all_li);

    if (all_li === "Erreur lors de la récupération des données") {
        const li = document.createElement("li");
        li.innerHTML = "Erreur lors de la récupération des données";
        ul.appendChild(li);
    }
    
    //all_li [{"ID_B\u00e2timent":"1","ressource_par_minute":"10","point_de_vie":"100","d\u00e9fense":"10","prix":"0","description":"Batiment principale"}]
    
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
    }
}