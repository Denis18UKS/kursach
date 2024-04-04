function showFormFields() {
    const selectedTariff = document.getElementById('tariff').value;
    const point_b = document.getElementById('point_b');

    switch (selectedTariff) {
        case 'Путешествие':
            point_b.outerHTML = `<select id="point_b" name="point_b">
                <option value="Баженово">Баженово</option>
                <option value="Тимашево">Тимашево</option>
                <option value="Булгаково">Булгаково</option>
                <option value="Субханкулово">Субханкулово</option>
                <option value="Знаменка">Знаменка</option>
            </select>`;
            break;
        case 'Межгород':
            point_b.outerHTML = `<select id="point_b" name="point_b">
                <option value="Москва">Москва</option>
                <option value="Санкт-Петербург">Санкт-Петербург</option>
                <option value="Сочи">Сочи</option>
                <option value="Пенза">Пенза</option>
                <option value="Самара">Самара</option>
                <option value="Казань">Казань</option>
                <option value="Рязань">Рязань</option>
                <option value="Краснодар">Краснодар</option>
                <option value="Туймазы">Туймазы</option>
                <option value="Новомичуринск">Новомичуринск</option>
            </select>`;
            break;
        case 'Экскурсионный':
            point_b.outerHTML = `<select id="point_b" name="point_b">
            <option value="Санкт-Петербург">Санкт-Петербург</option>
            <option value="Сочи">Сочи</option>
            <option value="Пенза">Пенза</option>
            <option value="Самара">Самара</option>
            <option value="Казань">Казань</option>
            <option value="Краснодар">Краснодар</option>
        </select>`;
        break;

        

        default:
            point_b.outerHTML = '<input type="text" id="point_b" name="point_b">';
            break;
    }

    const extraFieldsDiv = document.getElementById('extraFields');
    extraFieldsDiv.innerHTML = '';

    switch (selectedTariff) {
        case 'Travel&Animals':
            extraFieldsDiv.innerHTML = `<label for="animal_count">Количество животных:</label>
            <input type="number" min = "1" max = "3" id="animal_count" name="animal_count">
            <label for="animal_type">Тип животного:</label>
            <select id="animal_type" name="animal_type">
                <option value="кот">Кот</option>
                <option value="кошка">Кошка</option>
                <option value="собака">Собака</option>
                <option value="кролик">Кролик</option>
                <option value="заяц">Заяц</option>
            </select>`;
            break;
        case 'Комфорт':
            extraFieldsDiv.innerHTML = `<label for="car_brand">Выберите марку машины:</label>
            <select id="car_brand" name="car_brand">
                <option value="kia rio">Kia Rio</option>
                <option value="nissan">Nissan</option>
                <option value="volkswagen">Volkswagen</option>
            </select>`;
            break;
        default:
            break;
    }

    if (selectedTariff === 'Путешествие' || selectedTariff === 'Межгород' || selectedTariff === 'Travel&Animals' || selectedTariff === 'Комфорт') {
        extraFieldsDiv.style.display = 'flex';
    } else {
        extraFieldsDiv.style.display = 'none';
    }
}

function calculateTripDuration() {
    const selectedDate = new Date(document.getElementById('date').value);
    const currentDate = new Date();
    const timeDiff = Math.abs(selectedDate - currentDate);
    const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    return days;
}
