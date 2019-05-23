/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/booking.js":
/*!****************************************!*\
  !*** ./resources/assets/js/booking.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // add handler on date change event
  $('[name="date"]').on('change', function (event) {
    UpdateTime($(this).val());
  }); // add handler for "add guest" button's click event

  $('a[data-section="add_guest"]').on('click', function (event) {
    AddGuest($(this).closest('form'));
  }); // init change event on page loading

  $('[name="date"]').change(); // init autocomplete for customer name field

  InitCustomerAutocomplete($('[id="customer_name"]')); // update time field

  function UpdateTime(selectedValue) {
    var timeElement = $('[name="time"]');
    var time = SCHEDULE[selectedValue]['time'];
    timeElement.empty();
    $.each(time, function (key, value) {
      timeElement.append($('<option></option>').attr('value', value.value).text(value.title));
    });
  } // add "add guest" section


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
    $(removeBtn).on('click', function (event) {
      var section = $(this).closest('div[data-section="add_guest"]');
      section.empty().remove();
    });
  } // apply values for autocomplete functionality


  function InitCustomerAutocomplete(element) {
    element.autocomplete({
      minLength: 1,
      source: function source(request, response) {
        var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), 'i');
        response($.grep(CUSTOMERS, function (value) {
          return matcher.test(value.name);
        }));
      },
      create: function create() {
        element.val(CUSTOMERS.name);
      },
      focus: function focus(event, ui) {
        element.val(ui.item.name);
        return false;
      },
      select: function select(event, ui) {
        element.val(ui.item.name);
        $('[id="customer_phone"]').val(ui.item.phone);
        return false;
      }
    }).autocomplete('instance')._renderItem = function (ul, item) {
      return $('<li></li>').data('item.autocomplete', item).append('<div>Name: ' + item.name + ' Phone: ' + item.phone + '</div>').appendTo(ul);
    };
  }
});

/***/ }),

/***/ 2:
/*!**********************************************!*\
  !*** multi ./resources/assets/js/booking.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/wsbooking.loc/resources/assets/js/booking.js */"./resources/assets/js/booking.js");


/***/ })

/******/ });