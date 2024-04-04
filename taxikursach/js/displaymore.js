function displayMore(tarifId) {
    var descriptionElement = document.getElementById("description-" + tarifId);
    var buttonElement = document.getElementById("button-more-" + tarifId);

    if (descriptionElement.style.display === "none") {
        descriptionElement.style.display = "block";
        buttonElement.textContent = "Скрыть";
    } else {
        descriptionElement.style.display = "none";
        buttonElement.textContent = "Читать подробнее";
    }
}