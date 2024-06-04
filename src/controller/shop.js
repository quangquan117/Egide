import { get_li, get_data_from_token } from "./link.js";

export async function fill_shop(type){
    const ul = document.querySelector(".shop");
    const all_li = await get_li(type);
    let result = await get_data_from_token();

    console.log(all_li);

    // <li>
    //     <details>
    //         <summary>
    //             batiment 1<br>
    //             Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis molestiae itaque eius beatae sequi in aspernatur a, vel non velit!
    //         </summary>
    //         <div class="details-content">
    //             Contenu détaillé du batiment 1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate repudiandae, iusto laudantium nihil odit ut, quam molestiae aperiam, et accusamus suscipit. Eum totam ullam maxime odit? Voluptates corporis praesentium nihil dolores dolor perferendis dicta ducimus soluta eaque mollitia impedit consequatur debitis veritatis veniam doloribus, deleniti aut rerum voluptatibus adipisci sapiente?
    //         </div>
    //         <button>achat</button>
    //     </details>
    // </li>
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
        if (result && result["admin"] == true) {
            const button_modif = document.createElement("button");
            button_modif.innerHTML = "modifier";
            button_modif.addEventListener("click", () => {
                document.location.href = "http://localhost/projet_final/modif.php?id=" + all_li[i].ID_Bâtiment + "&type=" + type;
            });
            details.appendChild(button_moldif);
        }
    }
}