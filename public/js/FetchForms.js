// Envoie de données par la méthode Fetch (ajax mais en ES6)

// const formUserEdit = document.getElementById('form-user--edit')
// const formUserEditRes = document.getElementById('reponse')
// formUserEdit.addEventListener('submit', (e) => {
//     e.preventDefault()
//
//     let donnees = new FormData(formUserEdit) // Crée une nouvelle instance de FormData pour recuperer les données envoyés par le formulaire
//     // console.log(data.get('user-id'))
//
//     fetch('routes/routerUser.php', {
//         method  : 'POST',
//         body    : donnees
//     })
//         .then(res => res.json())
//         .then(data => {
//             if(data === 'error') {
//                 formUserEditRes.innerHTML = `<div class="alert alert__error">Llena todos los campos</div>`
//             }
//             else {
//                 formUserEditRes.innerHTML = `<div class="alert alert__success">Correcto</div>`
//             }
//         })
// })



<!--FETCH API pour envoyer le formulaire pour signaler un commentaire-->
// const signalerForm = document.getElementById('signaler-com')
//
// signalerForm.addEventListener('submit', (e) => {
//     e.preventDefault()
//
//     let donnees = new FormData(signalerForm)
//
//     fetch('./routes/routerSignalerComm.php', {
//         method: 'POST',
//         body: donnees
//     })
//         .then(res => res.json())
//         .then(data => {
//             const modal = document.getElementById('modal')
//             const reponseContainer = document.getElementById('reponse')
//             reponseContainer.innerHTML = `<p class="message-reponse">Le commentaire a été signalé</p>`
//             reponseContainer.classList.add('alert','alert__success','show')
//             console.log(data)
//             setTimeout(() => {
//                 modal.classList.add('hide')
//                 reponseContainer.classList.remove('alert','alert__success','show')
//                 reponseContainer.innerHTML = ''
//             }, 2500)
//
//         })
// })