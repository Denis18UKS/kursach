function BlackTheme() {
    var BlackTheme = document.getElementById("black-theme");
    var Off_BlackTheme = document.getElementById("Off-BlackTheme");
    var CHT = document.getElementById("container-header-text");

    var elements = document.getElementsByTagName('*');
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = 'black';
        elements[i].style.color = 'goldenrod';
    }

    // Замена картинки в зависимости от темы
    var img = document.getElementById('back');
    if (img && img.src.includes('home-black.png')) {
        img.src = '../image/home-gold.png';
    }

    BlackTheme.style.display = "none";
    Off_BlackTheme.style.display = "block";
    CHT.style.borderRadius = '40px';

    // Сохраняем выбор темы в куках
    document.cookie = "theme=black; path=/"; // куки будут применяться ко всем страницам сайта
}

// Функция для выключения темной темы
function Off_BlackTheme() {
    var BlackTheme = document.getElementById("black-theme");
    var Off_BlackTheme = document.getElementById("Off-BlackTheme");
    var CHT = document.getElementById("container-header-text");

    var elements = document.getElementsByTagName('*');
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = '';
        elements[i].style.color = '';
    }

    BlackTheme.style.display = '';
    Off_BlackTheme.style.display = '';
    CHT.style.borderRadius = '';

    // Удаляем куки с выбранной темой
    document.cookie = "theme=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
}

// Проверяем сохраненную тему в куках при загрузке страницы
document.addEventListener("DOMContentLoaded", function() {
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');
    for (var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i].trim();
        if (cookie.startsWith("theme=")) {
            var theme = cookie.substring(6);
            if (theme === "black") {
                BlackTheme();
            }
        }
    }
});