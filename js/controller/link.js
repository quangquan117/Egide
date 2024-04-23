export function link(type_sign, data) {
    const url = "http://localhost/projet_final/API/api.php/";
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
            document.location.href = "http://localhost/projet_final/main_base.php";
        } else {
            //create a alert error
            const data = xhr.response;
            window.alert(data);
        }
    };
};