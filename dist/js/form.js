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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/form.js":
/*!************************!*\
  !*** ./src/js/form.js ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $(document).ready(function () {
    var ajaxurl = '/wp-admin/admin-ajax.php';
    var currentTab = 0;
    showTab(currentTab);

    function registrationForm() {
      $('#registration').on('submit', function (e) {
        e.preventDefault();
        var obj = $(this);
        var form = $(this).serialize();
        $.post({
          url: ajaxurl,
          data: form,
          success: function success(data) {
            setTimeout(function () {
              window.location.href = "/thank-you";
            }, 1000);
          },
          error: function error(_error) {
            console.log(_error);
          }
        });
      });
    }

    function designationCalendar() {
      var calendar = $('#datepicker');
      $(calendar).append('<p class="designation">Available Dates</p>');
    }

    function showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";

      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "flex";
      }

      if (n == x.length - 1) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("nextBtn").style.display = "none"; // document.getElementById("nextBtn").innerHTML = "Submit";
        // document.getElementById("nextBtn").setAttribute('type', 'submit')
      }

      fixStepIndicator(n);
    }

    function nextPrev(n) {
      var x = document.getElementsByClassName("tab");
      if (n == 1 && !validateForm()) return false;
      if (n == 2 && !validateForm()) return false;
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;

      if (currentTab >= x.length) {
        document.getElementById("registration").submit();
        return false;
      }

      if (currentTab == 0) {
        var nav = $('form .points .step');
        var inputs = $('form input[type=hidden]');
        $.each(nav, function (key, value) {
          $(this).removeClass('finish');
        });
        $.each(inputs, function (key, value) {
          $(this).val('');
        });
      }

      showTab(currentTab);
    }

    function validateForm() {
      var x,
          y,
          i,
          valid = true;
      var type_events = $('#types_of_events').val();
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");

      for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
          y[i].className += " invalid";
          valid = false;
        }
      }

      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }

      if (valid && type_events == 'Offline') {
        if (currentTab == 0) {
          document.getElementsByClassName("step")[1].className += " finish";
        } else if (currentTab == 2) {
          document.getElementsByClassName("step")[3].className += " finish";
        }
      }

      return valid;
    }

    function fixStepIndicator(n) {
      var i,
          x = document.getElementsByClassName("step");

      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }

      x[n].className += " active";
    }

    function buttonBehavior() {
      $('#nextBtn').on('click', function () {
        nextPrev(1);
      });
      $('#prevBtn').on('click', function () {
        var type_events = $('#types_of_events').val();

        if (type_events == 'Offline') {
          if (currentTab == 4) {
            nextPrev(-2);
          } else if (currentTab == 2) {
            nextPrev(-2);
          } else {
            nextPrev(-1);
          }
        } else {
          nextPrev(-1);
        }
      });
    }

    function stepsTransition() {
      //online or offline
      $('.events-name').on('click', function (e) {
        e.preventDefault();
        $('#types_of_events').val(this.outerText);
        $('#details-event-type').html(this.outerText);
        var types_of_events = this.outerText;
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'getCurrentEventType',
            data: types_of_events
          },
          success: function success(response) {
            $('.event-wrap').empty().append(response.data);
          },
          complete: function complete(data) {//console.log( 'complete', data);
          },
          error: function error(data) {
            console.log('error', data);
          }
        });
        setTimeout(function () {
          if (types_of_events == 'Offline') {
            nextPrev(2);
            $('#details-country').html('Prague');
            $('.details-subtype').hide();
          } else {
            nextPrev(1);
            $('.details-subtype').show();
          }
        }, 500);
      }); //в зависимости от страны выводим собития

      $('.country-name').on('click', function (e) {
        e.preventDefault();
        $('#country').val(this.outerText);
        $('#details-country').html(this.outerText);
        var country_name = this.outerText;
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'getCurrentCountry',
            data: country_name
          },
          success: function success(response) {
            $('.event-wrap').empty().append(response.data);
          },
          complete: function complete(data) {//console.log( 'complete', data);
          },
          error: function error(data) {
            console.log('error', data);
          }
        });
        setTimeout(function () {
          nextPrev(1);
        }, 500);
      });
      $(document).on("click", ".event-wrap .item", function (e) {
        e.preventDefault();
        $('.event-wrap .item').removeClass('active');
        $(this).toggleClass('active');
        $('#event').val($(this).find('.title')[0].outerText);
        $('#details-type').html($(this).find('.title')[0].outerText);
        var event_id = $(this).data('event-id');
        var form = $('#country').val();
        var type_event = $('#types_of_events').val();
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'getCurrentEvent',
            data: event_id,
            country: form,
            type_event: type_event
          },
          success: function success(response) {
            $('.package-wrap').empty().append(response.data);
          },
          complete: function complete(data) {//console.log( 'complete', data);
          },
          error: function error(data) {
            console.log('error', data);
          }
        });
        setTimeout(function () {
          nextPrev(1);
        }, 500);
      });
      $(document).on("click", ".package-wrap .package", function (e) {
        e.preventDefault();
        $('.package-wrap .package').removeClass('active');
        $(this).toggleClass('active');
        $('#event-package').val($(this).find('.title')[0].outerText);
        $('#details-package').html($(this).find('.title')[0].outerText); //var availableDates = dates_array;

        $("#datepicker").datepicker({
          firstDay: 1,
          beforeShowDay: function beforeShowDay(dt) {
            return [available(dt), "asdasd"];
          }
        });

        function available(date) {
          dmy = date.getDate() + "." + pad(date.getMonth() + 1) + "." + date.getFullYear();

          if ($.inArray(dmy, dates_array) != -1) {
            return true;
          } else {
            return false;
          }
        }

        function pad(num) {
          var s = "" + num;

          if (num < 10) {
            s = "0" + num;
          }

          return s;
        }

        $("#datepicker").datepicker("refresh");
        setTimeout(function () {
          nextPrev(1);
        }, 500);
      });
      $("#datepicker").on('change', function () {
        var date = $("#datepicker").datepicker({
          dateFormat: 'dd.MM.yyyy'
        }).val();
        $('#event-date').val(date);
        $('#details-date').html(date);
        setTimeout(function () {
          nextPrev(1);
        }, 500);
        ;
      });
      $('#checkbox').click(function (event) {
        if (this.checked) {
          $(this).val('yes');
          $('#details-participants').html($('#participants').val());
          $('#details-name').html($('#name').val());
          $('#details-mail').html($('#mail').val());
          $('#details-phone').html($('#phone').val());
        } else {
          $(this).val('');
        }
      });
    }

    function minHeightForm() {
      var form = $('.main');
      var heightFooter = $('#footer').outerHeight();
      $(form).css({
        minHeight: 'calc( 100vh - ' + heightFooter + 'px)'
      });
    }

    stepsTransition();
    buttonBehavior();
    minHeightForm();
    designationCalendar();
    registrationForm();
  });
});

/***/ }),

/***/ 1:
/*!******************************!*\
  !*** multi ./src/js/form.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/medvedevaluda/dev/dev-almostfriday/wp-content/themes/almost-friday/src/js/form.js */"./src/js/form.js");


/***/ })

/******/ });