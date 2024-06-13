document.addEventListener('DOMContentLoaded', function() {
    const tariffsLink = document.getElementById('tariffs-link');
    const usersLink = document.getElementById('users-link');

    // Обработчик для ссылки "Управление тарифами"
    tariffsLink.addEventListener('click', function(event) {
        event.preventDefault();
        localStorage.setItem('selectedContent', 'tariffs');
        showSelectedContent();
    });

    // Обработчик для ссылки "Управление пользователями"
    usersLink.addEventListener('click', function(event) {
        event.preventDefault();
        localStorage.setItem('selectedContent', 'users');
        showSelectedContent();
    });

    // Функция для показа выбранного контента
    function showSelectedContent() {
        const selectedContent = localStorage.getItem('selectedContent');
        document.querySelectorAll('.content').forEach(function(content) {
            if (content.id === `content-${selectedContent}`) {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        });
    }

    // Проверяем сохраненное значение при загрузке страницы
    showSelectedContent();
});