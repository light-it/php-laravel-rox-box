$(document).ready(function () {

    // update time field
    $('[name="date"]').on('change', function(event) {
        var selectedValue = $(this).val();
        var timeElement = $('[name="time"]');
        var time = schedule[selectedValue]['time'];

        timeElement.empty();

        $.each(time, function(key, value) {
            timeElement.append($('<option></option>')
                .attr('value', value.value)
                .text(value.title));
        });
    });

    // init change event on page loading
    $('[name="date"]').change();

    // add guest button
    $('a[data-section="add_guest"]').on('click', function(event) {
        var form = $(this).closest('form');

        var qtyElement = form.find('input[type="hidden"][name="qty_guests"]');
        var counter = parseInt(qtyElement.val(), 10) + 1;
        qtyElement.val(counter);

        var guestSection = form.next('div[data-section="add_guest"]');
        var section = guestSection.clone();
        section.insertBefore('form [data-section="buttons"]').removeClass('hide');

        section.find('[id="guest_name"]').attr('name', 'guest[' + counter + '][name]');
        section.find('[id="guest_email"]').attr('name', 'guest[' + counter + '][email]');

        var removeBtn = section.find('a[data-section="remove_guest"]');
        $(removeBtn).on('click', function(event) {
            var section = $(this).closest('div[data-section="add_guest"]');
            section.empty().remove();
        });

    });

});
