function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.classList.toggle("show");
}

document.addEventListener("click", function(event) {
    var dropdownMenu = document.getElementById("dropdownMenu");
    if (!event.target.closest(".dropdown") && dropdownMenu.classList.contains("show")) {
    dropdownMenu.classList.remove("show");
    }
});