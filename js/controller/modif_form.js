import { get_all_data_from_id } from "./link.js";

export async function modif_form(id, type) {
    const data = await get_all_data_from_id(type, id);
    const form = document.querySelector(".modification");
    const name_label = document.createElement("label");
    const name_input = document.createElement("input");
    const description_label = document.createElement("label");
    const description_input = document.createElement("input");

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
        name_input.value = data[0].nom;
        description_label.textContent = "Description du batiment";
        description_input.value = data[0].description;
        ressource_par_minute_label.textContent = "Ressource par minute";
        ressource_par_minute_input.value = data[0].ressource_par_minute;
        point_de_vie_label.textContent = "Point de vie";
        point_de_vie_input.value = data[0].point_de_vie;
        defense_label.textContent = "Defense";
        defense_input.value = data[0].defense;
        prix_label.textContent = "Prix";
        prix_input.value = data[0].prix;

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
}