export function get_data_from_token() {
    return new Promise((resolve, reject) => {
        const url = "http://localhost/projet_final/API/api.php/get_data_from_token";
        const xhr = new XMLHttpRequest();
        const token = localStorage.getItem("token");
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify({ "token": token }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.response);
                resolve(data);
            } else {
                reject("Erreur lors de la récupération des données du token");
            }
        };
        xhr.onerror = () => reject("Erreur réseau");
    });
}

export function link(type_sign, data) {
    const url = "http://localhost/projet_final/API/api.php/"
    const xhr = new XMLHttpRequest();
    const body = JSON.stringify({
        "username": data.pseudo,
        "email": data.email,
        "password": data.password
    });
    console.log(body);
    xhr.open("POST", url + type_sign, true);
    xhr.send(body);
    xhr.onload = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const data = xhr.response;
            localStorage.setItem("token", data);
            document.location.href = "http://localhost/projet_final/main_base.php";
        } else {
            const data = xhr.response;
            window.alert(data);
        }
    }
};

export function get_all_data(type) {
    return new Promise((resolve, reject) => {
        console.log(type);
        const url = "http://localhost/projet_final/API/api.php/get_all_data";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.send(JSON.stringify({ "type_data": type }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.response);
                resolve(data);
            } else {
                reject("Erreur lors de la récupération des données");
            }
        }
    });
}
export function get_all_data_from_id(type, id) {
    return new Promise((resolve, reject) => {
        const url = "http://localhost/projet_final/API/api.php/get_all_data_from_id";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.send(JSON.stringify({ "type_data": type, "id": id }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.response);
                resolve(data);
            } else {
                reject("Erreur lors de la récupération des données");
            }
        }
    });
}
export function send_data(type, id, data) {
    return new Promise((resolve, reject) => {
        let body = {
            "type_data": type,
            "data": data
        };
        let url = ""
        console.log(id);
        if (id == 0) {
            url = "http://localhost/projet_final/API/api.php/create_data";
        }
        else {
            body["id"] = id;
            url = "http://localhost/projet_final/API/api.php/update_data";
        }
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.send(JSON.stringify(body));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = xhr.response;
                resolve(data);
            } else {
                reject("Erreur lors de l'envoi des données");
            }
        }
    });
}