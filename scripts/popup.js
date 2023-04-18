window.addEventListener("load", function init() {
    if (!document.cookie.split(";").some((item) => item.trim().startsWith("login="))) { //Si le cookie de connexion n'existe pas (donc l'utilisateur n'est pas connecté)
        this.document.getElementById("show-login-btn").addEventListener("click", function () {  //event pour afficher le formulaire de connexion
            showPopup("popup-login")
        });
    }
    
    this.document.getElementById("show-login-link").addEventListener("click", function () {  //event pour afficher le formulaire de connexion
        showPopup("popup-login")
    });
    this.document.getElementById("close-login-btn").addEventListener("click", function () { //event pour fermer le formulaire de connexion
        hidePopup("popup-login")
    });
    /*this.document.getElementById("show-register-btn").addEventListener("click", function () {   //event pour afficher le formulaire d'inscription
        showPopup("popup-register")
    });*/

    //marche pas
    this.document.getElementById("show-register-link").addEventListener("click", function () {  //event pour fermer le formulaire d'inscription
        showPopup("popup-register")
    });

    //marche pas
    this.document.getElementById("close-register-btn").addEventListener("click", function () {  //event pour fermer le formulaire d'inscription
        hidePopup("popup-register")
    });
})

function showPopup(objectName) {
    var objects = document.getElementsByClassName("popup");
    Array.from(objects).forEach((obj) => {
        obj.classList.remove("active"); //Suppression du active sur tous les autres objets (pour pas avoir plusieurs popup affichées)
    });
    document.getElementById(objectName).classList.add("active");    //Ajout de la classe active pour que le formulaire s'affiche (modification dans le css)
}

function hidePopup(objectName) {
    var objects = document.getElementsByClassName("popup");
    Array.from(objects).forEach((obj) => {
        obj.classList.remove("active"); //Suppression du active sur tous les autres objets (pour pas avoir plusieurs popup affichées)
    });
    document.getElementById(objectName).classList.remove("active"); //Suppression de la classe active pour que le formulaire se ferme (se cache avec modification dans le css)
}