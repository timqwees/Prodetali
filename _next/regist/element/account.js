// Получаем все элементы с классом main-header-link
const mainHeaderLinks = document.querySelectorAll('.main-header-link');

// Получаем контентные блоки с классами "profile", "setting", "events" и "admin"
const profileSection = document.querySelector('.profile');
const settingSection = document.querySelector('.setting');
const eventSection = document.querySelector('.events');
const adminSection = document.querySelector('.admin_panel');
// admin control
const adminControl = document.querySelector('.admin_control');
const lock = document.querySelector('.lock');
const close_block_admin = document.querySelector('.close_block_admin');

// Добавляем обработчик событий на каждую ссылку в меню
mainHeaderLinks.forEach((link, index) => {
    link.addEventListener('click', () => {
        // Удаляем класс 'is-active' со всех ссылок
        mainHeaderLinks.forEach(l => l.classList.remove('is-active'));

        // Добавляем класс 'is-active' на текущую ссылку
        link.classList.add('is-active');

        // Скрываем все контентные блоки
        profileSection.style.display = 'none';
        settingSection.style.display = 'none';
        eventSection.style.display = 'none';
        adminSection.style.display = 'none';

        // Показываем нужный контентный блок в зависимости от выбранной ссылки
        if (index === 0) { // Profile
            profileSection.style.display = 'block';
        } else if (index === 1) { // Setting
            settingSection.style.display = 'block';
        } else if (index === 2) { // Events
            eventSection.style.display = 'grid';
        } else if (index === 3) { // Admin
            adminSection.style.display = 'block';
        }
    });
});

adminControl.addEventListener('click', () => {
    if (lock.classList.contains('lock')) {
        lock.classList.remove('lock');
        lock.classList.add('unlock');
        adminSection.style.display = 'none'; // Скрываем панель админа при открытии, чтобы отобразился при нажатии на панель
    }
});
close_block_admin.addEventListener('click', () => {
    if (lock.classList.contains('unlock')) {
        lock.classList.remove('unlock');
        lock.classList.add('lock');
    }
});

function selectAvatar(avatar) {
    document.getElementById("input-avatar").value = avatar;
}
const avatar = [
    "../images/icon/1.jpg",
    "../images/icon/2.jpg",
    "../images/icon/3.jpg",
    "../images/icon/4.jpg",
    "../images/icon/5.jpg",
    "../images/icon/6.jpg",
    "../images/icon/7.jpg",
    "../images/icon/8.jpg",
    "../images/icon/happy.jpg"
]

let slideIndex = 0;

function plusSlides(n) {
    showSlides(slideIndex += n);
    selectAvatar(avatar[slideIndex]);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
    selectAvatar(avatar[slideIndex]);
}

function showSlides(n) {
    const slides = document.getElementsByClassName("slide-thumbnail")[0];
    for (let i = 0; i < slides.children.length; i++) {
        slides.children[i].style.display = "none";
    }
    if (n >= slides.children.length) {
        slideIndex = 0;
    }
    if (n < 0) {
        slideIndex = slides.children.length - 1;
    }
    slides.children[slideIndex].style.display = "block";

    selectedAvatarIndex = slideIndex;
    updateSelectedAvatar(selectedAvatarIndex); // Обновляем выбранный аватар
}

function updateSelectedAvatar(index) {
    const selectAvatarElement = document.getElementById("selectAvatar");
    if (selectAvatarElement) {
        selectAvatarElement.value = index;
    }
}