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