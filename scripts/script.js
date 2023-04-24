window.addEventListener("load", function init() {
    document.getElementById("form-inscription").addEventListener("submit", function (e) {
        e.preventDefault();
        var data = new FormData(this);
        verifyImgSize(1048576, "input-avatar");  //On vérifie que la taille de l'avatar n'est pas trop grande (ici 1Mo max)
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
    var objets = {  //La liste de tous les id pour pouvoir changer la couleur
        "mail": "input-inscription-email",
        "mdp": "input-inscription-mdp",
        "prenom": "input-prenom",
        "nom": "input-nom",
        "pseudo": "input-inscription-pseudo",
        "date": "input-inscription-date"
    };
    document.getElementById("retour-inscription").innerHTML = "";

    if (res.existe !== true) {
        ecrireRetour("retour-inscription", res.existe);
    }

    for (var value in res) {
        if (objets[value] !== undefined) {
            if (res[value] !== true) {
                ecrireRetour("retour-inscription", res[value]);
                mettreRouge(objets[value]);
            }
            else {
                supprimerRouge(objets[value]);
            }
        }
    }

    var nbTrue = 0;

    for (var value in res) {
        if (res[value] == true) {
            nbTrue++;
        }
    }
    if (nbTrue == (Object.keys(res).length - 1) && res.sql !== true) {  //Si tout est ok sauf la valeur $sql
        ecrireRetour("retour-inscription", "Erreur d'envoie des données");
    }

    let allValueTrue = Object.values(res).every((value) => {
        return value === true;
    })
    if (allValueTrue) { //Si tout est bon
        alert('Inscription OK');
        document.getElementById("retour-inscription").innerHTML = "";
        location.href = "index.php";
    }

    /*if (res.existe === 'ok' && res.mail === 'ok' && res.pseudo === 'ok' && res.mdp === 'ok' && res.prenom === 'ok' && res.nom === 'ok') {
        if (res.sql !== 'ok') {
            ecrireRetour("retour-inscription", "Erreur d'envoie des données");
        }
    }*/
    /*if (res.mail !== 'ok') {
        ecrireRetour("retour-inscription", res.mail);
        mettreRouge("input-inscription-email");
    }
    else {
        supprimerRouge("input-inscription-email");
    }
    if (res.mdp !== 'ok') {
        ecrireRetour("retour-inscription", res.mdp);
        mettreRouge("input-inscription-mdp");
    }
    else {
        supprimerRouge("input-inscription-mdp");
    }
    if (res.prenom !== 'ok') {
        ecrireRetour("retour-inscription", res.prenom);
        mettreRouge("input-prenom");
    }
    else {
        supprimerRouge("input-prenom");
    }
    if (res.nom !== 'ok') {
        ecrireRetour("retour-inscription", res.nom);
        mettreRouge("input-nom");
    }
    else {
        supprimerRouge("input-nom");
    }
    if (res.pseudo !== 'ok') {
        ecrireRetour("retour-inscription", res.pseudo);
        mettreRouge("input-inscription-pseudo");
    }
    else {
        supprimerRouge("input-inscription-pseudo");
    }*/
}

function ecrireRetour(obj_id, retour) {
    document.getElementById(obj_id).innerHTML += "<li>" + retour + "</li>";
}

function mettreRouge(obj_id) {
    document.getElementById(obj_id).style.color = "red";
    document.getElementById(obj_id).style.borderColor = "red";
}

function supprimerRouge(obj_id) {
    document.getElementById(obj_id).style.removeProperty("color");
    document.getElementById(obj_id).style.removeProperty("border-color");
}

//------CONNEXION----

window.addEventListener("load", function init() {
    document.getElementById("form-connexion").addEventListener("submit", function (e) {
        e.preventDefault();
        var data = new FormData(this);
        requeteConnexion(data);
        return false;
    })
});

function requeteConnexion(data) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = this.response;
            afficherMessageConnexion(res);
        }
        if (this.readyState == 4 && this.status == 404) {
            alert("Erreur 404");
        }
    };

    xhr.open("POST", "login.php", true);
    xhr.responseType = "json";
    xhr.send(data);
}

function afficherMessageConnexion(res) {
    var objets = {  //La liste de tous les id pour pouvoir changer la couleur
        "mdp": "input-connexion-mdp",
        "login": "input-connexion-pseudo"
    };
    document.getElementById("retour-connexion").innerHTML = "";

    if (res.existe !== true) {
        ecrireRetour("retour-connexion", res.existe);
    }

    for (var value in res) {
        if (objets[value] !== undefined) {
            if (res[value] !== true) {
                ecrireRetour("retour-connexion", res[value]);
                mettreRouge(objets[value]); 
            }
            else {
                supprimerRouge(objets[value]);
            }
        }
    }

    var nbTrue = 0;

    for (var value in res) {
        if (res[value] == true) {
            nbTrue++;
        }
    }
    if (nbTrue == (Object.keys(res).length - 1) && res.sql !== true) {  //Si tout est ok sauf la valeur $sql
        ecrireRetour("retour-connexion", "Erreur d'envoie des données");
    }

    let allValueTrue = Object.values(res).every((value) => {
        return value === true;
    })
    if (allValueTrue) { //Si tout est bon
        alert('Connexion OK');
        document.getElementById("retour-connexion").innerHTML = "";
        location.href = "index.php";
    }
}

function verifyImgSize(maxSizeOctet, inputName) {
    var img = document.getElementById(inputName);
    if (img.value != "") {
        if (img.files && img.files.length == 1 && img.files[0].size > maxSizeOctet) {    //Si l'image a été upload et que sa taille est supérieure à celle voulue
            alert("Le fichier ne doit pas dépasser " + parseInt(maxSizeOctet / 1024 / 1024) + "Mo");
            mettreRouge(inputName);
            return false;
        }
        supprimerRouge(inputName);
    }
    else {
        alert("Pas d'image de présentation envoyé");
    }
    return true;    //Vrai aussi quand il n'y a pas de fichier
}

window.addEventListener("load", function init() {
    document.getElementById("form-newPost").addEventListener("submit", function (e) {
        e.preventDefault();
        var data = new FormData(this);
        envoiPostNew(data);
        return false;
    });
})

window.addEventListener("load", function init() {
    document.getElementById("form-editPost").addEventListener("submit", function (e) {
        e.preventDefault();
        var data = new FormData(this);
        envoiPost(data);
        return false;
    });
    document.getElementById("form-supprPost").addEventListener("submit", function (e) {
        e.preventDefault();
        var data = new FormData(this);
        envoiPost(data);
        return false;
    });
})

function envoiPostNew(data) {
    if (verifyImgSize(1048576, "input-img")) {    //On vérifie que la taille de l'avatar n'est pas trop grande (ici 1Mo max)
        envoiPost(data);
    }
}

function envoiPost(data) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = this.response;
            location.href = res.redirect;
        }
        if (this.readyState == 4 && this.status == 404) {
            alert("Erreur 404");
        }
    };

    xhr.open("POST", "processPost.php", true);
    xhr.responseType = "json";
    xhr.send(data);
}