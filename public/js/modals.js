const modal = document.getElementById("modal")
const btnUserEdit = document.getElementsByClassName("btn__user--edit")
const btnCloseEdit = document.getElementById("btn-close")

for(let i = 0; i < btnUserEdit.length; i++) {
    btnUserEdit[i].addEventListener('click', () => {
        modal.classList.remove('hide')
    })

}

btnCloseEdit.addEventListener('click', () => {
    modal.classList.add('hide')
    console.log(this)
})




