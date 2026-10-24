import '@materializecss/materialize/dist/css/materialize.css';
import '@materializecss/materialize/dist/css/materialize.colors.min.css';
import '../css/theme.css';
import '../css/app.css';
import { Dropdown, Sidenav, Tooltip } from '@materializecss/materialize';

import '@fortawesome/fontawesome-free/js/fontawesome.js';
import '@fortawesome/fontawesome-free/js/solid.js';
import '@fortawesome/fontawesome-free/js/regular.js';
import '@fortawesome/fontawesome-free/js/brands.js';

document.addEventListener('DOMContentLoaded', function () {
    Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
        hover: true,
        constrainWidth: false,
        coverTrigger: false
    });

    Sidenav.init(document.querySelectorAll('.sidenav'));
    Tooltip.init(document.querySelectorAll('.tooltipped'), {
        position: 'bottom',
        enterDelay: 0
    });

    // Modals are native <dialog> elements, opened by their trigger and closed by clicking the backdrop
    document.querySelectorAll('.modal-trigger[data-target]').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            const dialog = document.getElementById(trigger.dataset.target);
            dialog.showModal();
            // Focus the dialog itself rather than its first link
            dialog.focus();
        });
    });

    document.querySelectorAll('dialog.modal').forEach(function (dialog) {
        dialog.addEventListener('click', function (event) {
            if (event.target === dialog) {
                dialog.close();
            }
        });
    });
});
