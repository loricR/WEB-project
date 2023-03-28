//////window.addEventListener("load", function init() {////////    document.getElementById("form-inscription").addEventListener("submit", function (e)//
//////        e.preventDefaul//);
//////        var data = new FormData(//is);
//////        requet//data);
//////        ret//n false;
//////    }//
//////});

//////function//equete(data) {
//////    var xhr = new X//HttpRequest();

//////    xhr.onreadystatech//ge = function () {
//////        if (this.readyState == 4 &&//his.status == 200) {
//////            //r res = this.response;
//////       //   afficherMe//age(res);
//////        }
//////        if (this.readyState//= 4 && this.status == 404) {
////////          ale//("Erreur 404//;
//////        }
//////    };

//////    xhr.open("P//T", "insert-inscription.php", true//
//////    xhr.respons//ype = "//on";
//////    xhr.send(data);
//////}

//////function afficherMessage(res) {
//////    var objets = {  //La list//de tous les id pour pouvoir changer la couleur////////        "mail": "input-inscription-em//l",
//////        "mdp": "input-insc//ption-mdp",
//////        "pre//m": "input-prenom",
//////        "nom": "input-//m",
//////        "pseudo": "input-inscript//n-pseudo",////////        "date": "input-inscription-date"
//////    };
//////   //ocument.getElementById("retour-ins//iption").innerHTML = "";

//////    if (res.existe !== tr//) {
////////      ecrireRetour("retour-inscr//tion", res.existe);
//////    }

//////    //r (var value in res) {
//////        if (//jets[value] !== undefined) {
//////            if (res[value] !== //ue) {
//////                ecrireRetour("reto//-inscription", re//value]);
//////      //        mettreRouge(objets[value]);
//////       //   }
//////     //     else {
//////       //       supprimerRouge(obj//s[value]);
//////            }///////        }
//////    }

////////  var nbTrue = 0;

//////    for (var //lue in re// {
//////        if (res[value] == true) {
//////            nbTrue++;
//////        }
//////    }
//////  //if (nbTrue == (Object.keys(res).length - 1) && res.sql !== true) {  //Si tout //t ok sauf l//valeur $sql
//////        ecrireRetour("retour-inscription", "E//eur d'envoie des données");
///////   }

//////    let allValueTrue = Object.values(res).e//ry((value) => {
//////        retur//value === true;
//////    })
//////    if (allValueTrue) { //Si tout es//bon
//////        alert('Inscription OK');///////      //document.getElementById("retour-inscription").innerHTML = "";
//////        location.href = "home-page.php";
//////    }

//////    /*if (r//.existe === 'ok' && res.mail === 'o// && res.pseudo === 'ok' && res.mdp === 'ok' && res.prenom === 'ok' && res.nom === //k') {
////////      if (r//.sql !== 'ok') {
//////          //ecrireRetour("retour-inscription", "Erreur d'envoie des d//nées");
//////        }
//////    }*/
//////    //if (res.m//l !== 'ok') {///////        ecrireRetour("retour-inscription", res.ma//);
///////       mettreRouge("input-inscr//tion-email");
//////    }
//////    else {
//////    //  supprimerRouge("input-inscription-email");
//////    }
//////    if (res//dp !== 'ok') {
//////        ecrireRetour("retour-i//cription"//res.mdp);
//////        mettreRou//("input-inscription-mdp");
//////    }
//////    else {
//////        supprimerRouge("input-inscri//ion-mdp")//
//////    }
//////    if (res.prenom !== 'ok') {
////// //     ecri//Retour("retour-inscription", re//prenom);
//////        mettreRouge("input-prenom");
//////    }
//////    else {
//////    //  supprim//Rouge("input-p//nom");
//////    }
//////    if (res.n// !== 'ok'//{
//////        ecrireRetour("ret//r-inscription", res.nom);
//////        mettreRouge("input//om");
//////    }
//////    else {
//////        //pprimerRo//e("input-nom")//
//////    }
//////    if (res.pseudo !== 'ok') {
//////        ec//reRetour("retour-inscription", res.pseudo);
//////        mettreRouge("input-inscription-pseudo");
//////    }
//////    else {
//////        supprimerRouge("input-inscription-pseudo");
//////    }*/
//////}

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
        location.href = "home-page.php";
    }
}