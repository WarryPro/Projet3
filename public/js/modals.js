const modal = document.getElementById("modal")
const btnUserEdit = document.getElementsByClassName("btn__user--edit")

const signaler = document.getElementsByClassName('signaler')

for(let i = 0; i < btnUserEdit.length; i++) {
    btnUserEdit[i].addEventListener('click', () => {
        modal.classList.remove('hide')

        // recupérer les infos de chaque utilisateur pour les copier dans le modal card

        // récupérer l'id de l'utilisateur
        const userId = btnUserEdit[i].getAttribute('data-id')
        const inputId = document.querySelector('#modal #user-id')
        inputId.value = userId

        // Photo de l'utilisateur
        const modalUserPhoto = btnUserEdit[i].parentNode.parentNode.querySelector('#user-photo').attributes.src.textContent
        const cardModalUserPhoto = document.querySelector('.photo-profile')
        cardModalUserPhoto.style.backgroundImage = `url(${modalUserPhoto})`

        // nom de l'utilisateur
        const modalUserName = btnUserEdit[i].parentNode.parentNode.querySelector('.user__name').textContent
        const cardModalUserName = document.querySelector('#user-name')
        cardModalUserName.value = modalUserName

        // email de l'utilisateur
        const modalUserEmail = btnUserEdit[i].parentNode.parentNode.querySelector('.user__email').textContent
        const cardModalUserEmail = document.querySelector('#email')
        cardModalUserEmail.value = modalUserEmail

        // Role de l'utilisateur
        const modalUserRole = btnUserEdit[i].parentNode.parentNode.querySelector('.user__rol').textContent
        const cardModalUserRole = document.getElementsByName('user_role') // Obtient les diff btns radios

        for( let j = 0; j < cardModalUserRole.length; j++) {
            if(cardModalUserRole[j].value === modalUserRole) {
                cardModalUserRole[j].value = modalUserRole
                cardModalUserRole[j].checked = true //Selectionne le Radio
            }
        }
    })

}
setInterval(() =>{
    const btnCloseEdit = document.getElementById("btn-close")
    if(btnCloseEdit !== null) {
        btnCloseEdit.addEventListener('click', () => {
            modal.classList.add('hide')
        })
        clearInterval(this)
    }
}, 500)


// MODAL SIGNALER
for (const elmt of signaler) {
    elmt.addEventListener('click', () => {
        const inputCommId = document.getElementById('commid') // Input hidden pour l'id du commentaire à signaler
        modal.classList.remove('hide')
        inputCommId.value = elmt.getAttribute('id') // insert l'id du commentaire dans l'input hidden

        //cacher le modal si click dans le btn annuler
        const btnAnnuler = document.getElementById('annuler')
        btnAnnuler.addEventListener('click', () => {
            modal.classList.add('hide')
        })
    })
}


