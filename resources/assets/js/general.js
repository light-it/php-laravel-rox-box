import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$(document).ready(function () {

    // add date input
    $('[data-field-type="date"]').datepicker();

});
