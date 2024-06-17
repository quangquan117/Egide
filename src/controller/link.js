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
export function delete_data(type, id) {
    return new Promise((resolve, reject) => {
        let body = {
            "type_data": type,
            "id": id
        }
        console.log(body);
        let url = "http://localhost/projet_final/API/api.php/delete_data";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.send(JSON.stringify(body));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = xhr.response;
                resolve(data);
            } else {
                reject("Erreur lors de la suppression des données");
            }
        }
    })
}
export function get_batiment_from_base() {
    return new Promise((resolve, reject) => {
        const token = localStorage.getItem("token");
        const url = "http://localhost/projet_final/API/api.php/get_data_of_base";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify({ "token": token }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.response);
                resolve(JSON.parse(data));
            } else {
                reject("Erreur lors de la récupération des données");
            }
        }
    });
}
export function buy_somthing(type, id) {
    return new Promise((resolve, reject) => {
        const token = localStorage.getItem("token");
        const url = "http://localhost/projet_final/API/api.php/buy_something";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify({ "token": token, "type": type, "id": id }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = xhr.response;
                console.log(data);
                resolve(data);
            } else {
                reject("Erreur lors de l'achat");
            }
        }
    });
}
export function get_ressource() {
    return new Promise((resolve, reject) => {
        const token = localStorage.getItem("token");
        const url = "http://localhost/projet_final/API/api.php/get_ressource";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify({ "token": token }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = xhr.response;
                resolve(data);
            } else {
                reject("Erreur lors de la récupération des ressources");
            }
        }
    });

}
export function put_ressource() {
    return new Promise((resolve, reject) => {
        const token = localStorage.getItem("token");
        const url = "http://localhost/projet_final/API/api.php/put_ressource";
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify({ "token": token }));
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = xhr.response;
                resolve(data);
            } else {
                reject("Erreur lors de la récupération des ressources");
            }
        }
    });

}

export function get_api_gpt(description, type, retryCount = 3, delay = 5000) {
    const apiKey = '';
    const apiUrl = 'https://api.openai.com/v1/engines/gpt-3.5-turbo/completions';
    const prompt = `Décrit le ${type} avec beaucoup plus de précision et ajoute une anecdote qu'il aurait pu se passer dedans sans aucune importance. Description: ${description}. C: Réponse assez courte. L: Réponse longue.`;

    const payload = {
        prompt: prompt,
        max_tokens: 250,
        temperature: 0.7
    };

    function sendRequest(retryCount, delay) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', apiUrl, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('Authorization', `Bearer ${apiKey}`);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    resolve(response.choices[0].text.trim());
                } else if (xhr.status === 429 && retryCount > 0) {
                    setTimeout(() => {
                        sendRequest(retryCount - 1, delay * 2)
                            .then(resolve)
                            .catch(reject);
                    }, delay);
                } else {
                    reject(new Error(`Error: ${xhr.status} ${xhr.statusText}`));
                }
            };

            xhr.onerror = function () {
                reject(new Error('Network error'));
            };

            xhr.send(JSON.stringify(payload));
        });
    }

    return sendRequest(retryCount, delay);
}
