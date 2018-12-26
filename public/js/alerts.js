const alert = document.getElementById('alert');

if(typeof alert === 'object') {
    alert.classList.add('show')
    setTimeout(() => {
        alert.classList.remove('show')
        alert.parentNode.removeChild(alert)
    }, 5000)
}