import './styles/single-project.css';

import 'materialize-css/dist/js/materialize.min';

const $ = require("jquery");

$('.dropdown-trigger').dropdown({
    hover: true,
    constrain_width: false,
    coverTrigger: false
});

$(document).ready(function () {
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('.materialboxed').materialbox();
});
