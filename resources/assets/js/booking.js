$(document).ready(function () {

    // add handler on date change event
    $('[name="date"]').on('change', function(event) {
        UpdateTime($(this).val());
    });

    // add handler on time change event
    $('[name="time"]').on('change', function(event) {
        CheckSlots();
    });

    // add handler for "add guest" button's click event
    $('a[data-section="add_guest"]').on('click', function(event) {
        if ($(this).attr('disabled')) {
            e.preventDefault();
        }

        AddGuest($(this).closest('form'));
    });

    // init change event on page loading
    $('[name="date"]').change();

    // init autocomplete for customer name field
    InitCustomerAutocomplete($('[id="customer_name"]'));

    //check qty of slots on page loading
    CheckSlots();

    // update time field
    function UpdateTime(selectedValue) {
        var timeElement = $('[name="time"]');
        var time = SCHEDULE[selectedValue]['time'];

        timeElement.empty();

        $.each(time, function(key, value) {
            timeElement.append($('<option></option>')
                .attr('value', value.value)
                .text(value.title));
        });

        timeElement.change();
    }

    // add "add guest" section
    function AddGuest(form) {
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

            var counter = parseInt(qtyElement.val(), 10) - 1;
            qtyElement.val(counter);

            CheckSlots();
        });

        CheckSlots();
    }

    // apply values for autocomplete functionality
    function InitCustomerAutocomplete(element) {
        element.autocomplete({
            minLength: 1,
            source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), 'i');
                response($.grep(CUSTOMERS, function(value) {
                    return matcher.test(value.name);
                }));
            },
            create: function() {
                element.val(CUSTOMERS.name);
            },
            focus: function(event, ui) {
                element.val(ui.item.name);
                return false;
            },
            select: function(event, ui) {
                element.val(ui.item.name);
                $('[id="customer_phone"]').val(ui.item.phone);
                return false;
            }
        })
        .autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li></li>')
                .data('item.autocomplete', item)
                .append('<div>Name: ' + item.name + ' Phone: ' + item.phone + '</div>')
                .appendTo(ul);
        };
    }

    // show message and deactivate submit button on low qty of available slots
    function CheckSlots() {
        var datetime = $('[name="date"]').val() + ' ' + $('[name="time"]').val();
        var qty = parseInt($('input[type="hidden"][name="qty_guests"]').val(), 10) + 1;

        $.ajax({
            'async': true,
            'method': 'GET',
            'url': '/api/v1/booking/check-slots',
            'headers': {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'cache-control': 'no-cache',
            },
            'data': {
                'datetime': datetime,
                'qty': qty
            },
            'beforeSend': function() {
                ClearMessages();
            },
            'success': function(response) {
                $('button[type="submit"], a[data-section="add_guest"]').attr('disabled', false);
                AddMessage('success', response.message);
            },
            'error': function(xhr, ajaxOptions, thrownError) {
                $('button[type="submit"], a[data-section="add_guest"]').attr('disabled', true);
                AddMessage('error', xhr.responseJSON.message);
            }
        });
    }

    // adds message by message type and text
    function AddMessage(type, message) {
        ClearMessages();

        var messageSection = $('[data-section="messages"]');
        var messageClass = type == 'success' ? 'alert-success' : 'alert-danger';
        var messageItem = messageSection.find('div.alert.' + messageClass);

        if (messageItem.length == 0) {
            messageItem = $('<div></div>', { 'class': 'alert ' + messageClass });
            messageSection.append(messageItem);
        } else {
            messageItem.append($('<br />'));
        }

        messageItem.append(message);
    }

    // adds message by message type and text
    function ClearMessages() {
        var messageSection = $('[data-section="messages"]');
        messageSection.empty();
    }

});
