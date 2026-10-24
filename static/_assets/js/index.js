import '../css/index.css';

// Pick a random background for the welcome banner on each visit
document.addEventListener('DOMContentLoaded', function () {
    const hello = document.getElementById('hello');
    const backgrounds = JSON.parse(hello.dataset.backgrounds);
    const background = backgrounds[Math.floor(Math.random() * backgrounds.length)];

    hello.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('${background}')`;
});
