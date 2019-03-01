const alert = document.getElementById("alert");
const alertContainer = document.getElementById("alert-container");
if(alert !== null) {
    alert.classList.add("show");
    setTimeout(() => {
        alert.classList.remove("show");
        alert.parentNode.removeChild(alert);
        alertContainer.parentNode.removeChild(alertContainer);
    }, 5000)
}