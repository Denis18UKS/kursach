

const tariffsLink = document.getElementById('tariffs-link');
const usersLink = document.getElementById('users-link');
const contentTariffs = document.getElementById('content-tariffs');
const contentUsers = document.getElementById('content-users');

tariffsLink.addEventListener('click', function(event) {
    event.preventDefault();
    contentTariffs.style.display = 'block';
    contentUsers.style.display = 'none';
});

usersLink.addEventListener('click', function(event) {
    event.preventDefault();
    contentTariffs.style.display = 'none';
    contentUsers.style.display = 'block';
});