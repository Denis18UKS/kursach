    const theme = localStorage.getItem("theme") || "white"; // Получаем текущую тему из localStorage

    function setTheme(theme) {
        localStorage.setItem("theme", theme);
        const svgs = document.querySelectorAll("img.change-color");
        
        svgs.forEach(function(svg) {
            if (theme === "dark") {
                svg.style.filter = "invert(1) sepia(1) saturate(5) hue-rotate(180deg)";
            } else {
                svg.style.filter = "none";
            }
        });
    }

    setTheme(theme); // Устанавливаем тему при загрузке страницы

    // Пример переключения темы
    setTheme("dark"); // Устанавливаем темную тему