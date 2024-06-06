import { get_all_data_from_id } from "./link.js";
import { send_data } from "./link.js";

export async function modif_form(type, id = 0) {
    let data = [];
    if (id != 0) {
        if (type === "batiment") {
            data = await get_all_data_from_id(type, id);
        }
    }
    const form = document.querySelector(".modification");
    form.innerHTML = ''; // Clear the form content before adding new elements

    const name_label = document.createElement("label");
    const name_input = document.createElement("input");
    const description_label = document.createElement("label");
    const description_input = document.createElement("input");
    const send_button = document.createElement("button");

    send_button.textContent = "sauvegarder";

    if (type === "batiment") {
        const ressource_par_minute_label = document.createElement("label");
        const ressource_par_minute_input = document.createElement("input");
        const point_de_vie_label = document.createElement("label");
        const point_de_vie_input = document.createElement("input");
        const defense_label = document.createElement("label");
        const defense_input = document.createElement("input");
        const prix_label = document.createElement("label");
        const prix_input = document.createElement("input");
        
        name_label.textContent = "Nom du batiment";
        description_label.textContent = "Description du batiment";
        ressource_par_minute_label.textContent = "Ressource par minute";
        point_de_vie_label.textContent = "Point de vie";
        defense_label.textContent = "Defense";
        prix_label.textContent = "Prix";

        if (id != 0) {
            name_input.value = data[0].nom;
            description_input.value = data[0].description;
            ressource_par_minute_input.value = data[0].ressource_par_minute;
            point_de_vie_input.value = data[0].point_de_vie;
            defense_input.value = data[0].defense;
            prix_input.value = data[0].prix;
        }

        form.appendChild(name_label);
        form.appendChild(name_input);
        form.appendChild(ressource_par_minute_label);
        form.appendChild(ressource_par_minute_input);
        form.appendChild(point_de_vie_label);
        form.appendChild(point_de_vie_input);   
        form.appendChild(defense_label);
        form.appendChild(defense_input);
        form.appendChild(prix_label);
        form.appendChild(prix_input);
        form.appendChild(description_label);
        form.appendChild(description_input);
    }

    form.appendChild(send_button);

    send_button.addEventListener("click", async (e) => {
        e.preventDefault();
        const inputs = form.querySelectorAll("input");
        const dataToSend = {
            "nom": inputs[0].value,
            "ressource_par_minute": inputs[1].value,
            "point_de_vie": inputs[2].value,
            "defense": inputs[3].value,
            "prix": inputs[4].value,
            "description": inputs[5].value
        };
        if (id != 0) {
            dataToSend["id"] = id;
        }
        try {
            const response = await send_data(type, id, dataToSend);
            if (response === "Erreur lors de la création") {
                window.alert("Erreur lors de la création");
            } else {
                window.alert("sauvegarde effectuée");
                document.location.href = "http://localhost/projet_final/main_base.php";
            }
        } catch (error) {
            console.error("Erreur lors de l'envoi des données :", error);
        }
    });
}
