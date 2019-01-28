const textareaComment = document.querySelector('.textarea-form')
const textareaLabel = document.querySelector('.label-form')

/*
* Ajouter / Supprimer classe label-up du label de textarea
* */
//Vérifier si textareaComment et textareaLabel existent
if ( textareaComment !== null && textareaLabel !== null) {

    textareaComment.addEventListener('focus', () => {
        textareaLabel.classList.add('label-up')
    })

    textareaComment.addEventListener('blur', () => {
        if(textareaComment.value === '') {
            textareaLabel.classList.remove('label-up')
        }
    })
}


// Page postView
const bodyPagePost = document.querySelector("body")
const postMainContainer = document.querySelector("main > .post-main-container")

// verifier si l'elmt existe
if(postMainContainer !== null) {
        bodyPagePost.className = "body-bg-post"
}
