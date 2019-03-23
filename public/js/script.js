const textareaComment = document.querySelector(".textarea-form");
const textareaLabel = document.querySelector(".label-form");

/*
* Ajouter / Supprimer classe label-up du label de textarea
* */
//Vérifier si textareaComment et textareaLabel existent
if ( textareaComment !== null && textareaLabel !== null) {

    textareaComment.addEventListener("focus", () => {
        textareaLabel.classList.add("label-up");
    });

    textareaComment.addEventListener("blur", () => {
        if(textareaComment.value === "") {
            textareaLabel.classList.remove("label-up");
        }
    });
}


// Page postView
const bodyPagePost = document.querySelector("body");
const postMainContainer = document.querySelector("main > .post-main-container");

// verifier si l'elmt existe
if(postMainContainer !== null) {
        bodyPagePost.className = "body-bg-post";
}


// **** EDITER PROFIL *** //
const btnEditerProfil = document.getElementById("btn-editer-profil");
const btnAnnuler = document.getElementById("btn-annuler");
const formGroup = document.getElementById("changermdp");
const btnMaJ = document.getElementById("maj-profil");
const btnEditerImageProfil = document.getElementById("editer-image-profil");

btnEditerProfil.addEventListener("click", (e) => {
    e.preventDefault();
    formGroup.classList.replace("hide", "slide-in-top");
    btnMaJ.classList.replace("hide", "slide-in-top");
    btnEditerImageProfil.classList.remove("hide");
    btnEditerProfil.classList.add("hide");
    btnAnnuler.classList.remove("hide");
});

btnAnnuler.addEventListener("click", (e) => {
    e.preventDefault();
    formGroup.classList.replace("slide-in-top", "slide-out-top");
    btnMaJ.classList.replace("slide-in-top", "slide-out-top");
    btnEditerImageProfil.classList.add("hide");

    setTimeout(() => {
        btnMaJ.classList.replace("slide-out-top", "hide");
        formGroup.classList.replace("slide-out-top", "hide");
    }, 100);

    btnEditerProfil.classList.remove("hide");
    btnAnnuler.classList.add("hide");
});

// **** FIN EDITER PROFIL *** //