import { get_all_data } from "./link.js";

export async function print_all_base(){
    const base = await get_all_data("batiment");
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
            const button = document.createElement("button");
            button.textContent = "obtenir ressource";
            button.addEventListener("click", () => {
                console.log("obtenir ressource");
            });
            li.appendChild(button);
        }
    }
}