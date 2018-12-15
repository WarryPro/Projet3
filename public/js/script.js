const textareaComment = document.querySelector('.textarea-form')
const textareaLabel = document.querySelector('.label-form')

/*
* Ajouter / Supprimer classe label-up du label de textarea
* */
    textareaComment.addEventListener('focus', () => {
        textareaLabel.classList.add('label-up')
    })

    textareaComment.addEventListener('blur', () => {
        if(textareaComment.value === '') {
            textareaLabel.classList.remove('label-up')
        }
    })


// Page postView
const bodyPagePost = document.querySelector("body")
const postMainContainer = document.querySelector("main > .post-main-container")

// verifier si l'elmt existe
if(typeof postMainContainer === "object") {bodyPagePost.className = "body-bg-post"}



