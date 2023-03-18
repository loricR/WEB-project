window.addEventListener("load", function init() {
    document.getElementById("form-inscription").addEventListener("submit", function (e) {
        e.preventDefault();
        var data = new FormData(this);
        requete(data);
        return false;
    })
});

function requete(data) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = this.response;
            afficherMessage(res);
        }
        if (this.readyState == 4 && this.status == 404) {
            alert("Erreur 404");
        }
    };

    xhr.open("POST", "insert-inscription.php", true);
    xhr.responseType = "json";
    xhr.send(data);
}

function afficherMessage(res) {
    document.getElementById("retour-inscription").innerHTML = "";

    if (res.existe !== 'ok') {
        ecrireRetour("retour-inscription", res.existe);
    }
    if (res.mail !== 'ok') {
        ecrireRetour("retour-inscription", res.mail);
        mettreRouge("input-inscription-email");
    }
    if (res.mdp !== 'ok') {
        ecrireRetour("retour-inscription", res.mdp);
        mettreRouge("input-inscription-mdp");
    }
    if (res.prenom !== 'ok') {
        ecrireRetour("retour-inscription", res.prenom);
        mettreRouge("input-prenom");
    }
    if (res.nom !== 'ok') {
        ecrireRetour("retour-inscription", res.nom);
        mettreRouge("input-nom");
    }
    if (res.pseudo !== 'ok') {
        ecrireRetour("retour-inscription", res.pseudo);
        mettreRouge("input-inscription-pseudo");
    }
    if (res.existe === 'ok' && res.mail === 'ok' && res.pseudo === 'ok' && res.mdp === 'ok' && res.prenom === 'ok' && res.nom === 'ok') {
        if (res.sql !== 'ok') {
            ecrireRetour("retour-inscription", "Erreur d'envoie des données");
        }
    }
    if (res.existe === 'ok' && res.mail === 'ok' && res.pseudo === 'ok' && res.mdp === 'ok' && res.prenom === 'ok' && res.nom === 'ok' && res.sql === 'ok') {
        alert('Inscription OK');
        document.getElementById("retour-inscription").innerHTML = "";
        //location.reload();
    }
}

function ecrireRetour(obj_id, retour) {
    document.getElementById(obj_id).innerHTML += "<li>" + retour + "</li>";
}

function mettreRouge(obj_id) {
    document.getElementById(obj_id).style.color = "red";
    document.getElementById(obj_id).style.borderColor = "red";
}