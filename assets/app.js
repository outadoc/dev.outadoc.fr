import './styles/app.css';

import 'materialize-css/dist/css/materialize.min.css';
import 'materialize-css/dist/js/materialize.min';

import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'

document.addEventListener('DOMContentLoaded', function () {
    M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
        hover: true,
        constrain_width: false,
        coverTrigger: false
    });

    M.Sidenav.init(document.querySelectorAll('.sidenav'));
    M.Modal.init(document.querySelectorAll('.modal'));
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
});
