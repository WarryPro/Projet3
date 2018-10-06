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



