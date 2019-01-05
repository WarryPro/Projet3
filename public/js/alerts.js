const alert = document.getElementById('alert');

if(alert !== null) {
    alert.classList.add('show')
    setTimeout(() => {
        alert.classList.remove('show')
        alert.parentNode.removeChild(alert)
    }, 5000)
}