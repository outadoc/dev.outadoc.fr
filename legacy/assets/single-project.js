import './styles/single-project.css';

// Show screenshots full-size in a modal dialog when clicked
document.addEventListener('DOMContentLoaded', function () {
    const dialog = document.createElement('dialog');
    dialog.className = 'screenshot-viewer';
    dialog.appendChild(document.createElement('img'));
    dialog.addEventListener('click', () => dialog.close());
    document.body.appendChild(dialog);

    document.querySelectorAll('img.screenshot').forEach(function (img) {
        img.addEventListener('click', function () {
            dialog.querySelector('img').src = img.src;
            dialog.showModal();
        });
    });
});
