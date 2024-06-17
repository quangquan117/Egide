import { get_batiment_from_base, get_ressource, put_ressource } from "./link.js";

export async function print_all_base(){
    const base = await get_batiment_from_base();
    const ressource_of_base = await get_ressource();
    const section = document.querySelector("section");
    for (let i = 0; i < base.length; i++){
        const ul = document.createElement("ul");
        const h2 = document.createElement("h2");
        const li = document.createElement("li");
        const p = document.createElement("p");

        h2.textContent = base[i].nom;
        p.textContent = base[i].description;

        section.appendChild(ul);
        ul.appendChild(h2);
        ul.appendChild(li);
        li.appendChild(p);
        if (i == 0){
            const ressource = document.createElement("p");
            const button = document.createElement("button");
            ressource.textContent = "ressource : " + ressource_of_base;
            button.textContent = "obtenir ressource";
            li.appendChild(ressource);
            li.appendChild(button);
            button.addEventListener("click", () => {
                put_ressource();
                window.location.reload();
            });
        }
    }
}