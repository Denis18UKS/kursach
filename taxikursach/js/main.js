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


// Фукнция для включения тёмной темы
function BlackTheme() {
    var BlackTheme = document.getElementById("black-theme")
    var Off_BlackTheme = document.getElementById("Off-BlackTheme")
    var CHT = document.getElementById("container-header-text");
    var btn_more = document.getElementById("button-more")

    var elements = document.getElementsByTagName('*');
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = 'black';
        elements[i].style.color = 'white';

        BlackTheme.style.display = "none";
        Off_BlackTheme.style.display = "block";
        CHT.style.borderRadius = "0px";
    }
}

// Фукнция для выключения тёмной темы
function Off_BlackTheme() {
    var BlackTheme = document.getElementById("black-theme")
    var Off_BlackTheme = document.getElementById("Off-BlackTheme")
    var CHT = document.getElementById("container-header-text");
    var btn_more = document.getElementById("button-more")

    var elements = document.getElementsByTagName('*');
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = '';
        elements[i].style.color = '';

        BlackTheme.style.display = '';
        Off_BlackTheme.style.display = '';
        CHT.style.borderRadius = '';
        btn_more.style.border = ''

    }
}