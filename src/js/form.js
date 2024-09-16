$(function() {

    $(document).ready(function () {

        const ajaxurl = '/wp-admin/admin-ajax.php';

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
                    success: function (data) {
                        setTimeout(function () {
                            window.location.href="/thank-you";
                        },1000);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            });
        }
        function designationCalendar() {
            const calendar = $('#datepicker');

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
            if (n == (x.length - 1)) {
                document.getElementById("prevBtn").style.display = "none";
                document.getElementById("nextBtn").style.display = "none";
                // document.getElementById("nextBtn").innerHTML = "Submit";
                // document.getElementById("nextBtn").setAttribute('type', 'submit')
            }

            fixStepIndicator(n)
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

            if(currentTab == 0){
                var nav = $('form .points .step');
                var inputs = $('form input[type=hidden]');
                $.each(nav,function (key,value){
                    $(this).removeClass('finish');
                });
                $.each(inputs,function (key,value){
                    $(this).val('');
                })
            }

            showTab(currentTab);




        }
        function validateForm() {

            var x, y, i, valid = true;
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
            if(valid && type_events == 'Offline'){
                if(currentTab == 0){
                    document.getElementsByClassName("step")[1].className += " finish";
                }else if(currentTab == 2){
                    document.getElementsByClassName("step")[3].className += " finish";
                }
            }
            return valid;
        }
        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
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
                if(type_events == 'Offline'){
                    if(currentTab == 4){
                        nextPrev(-2);
                    }else if(currentTab == 2){
                        nextPrev(-2);
                    }else{
                        nextPrev(-1);
                    }
                }else{
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
                 const types_of_events = this.outerText;

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'getCurrentEventType',
                        data: types_of_events,
                    },
                    success:function(response) {
                        $('.event-wrap').empty().append(response.data)
                    },
                    complete: function (data) {
                        //console.log( 'complete', data);
                    },
                    error:function(data) {
                        console.log( 'error', data);
                    }
                });

                setTimeout( function(){
                    if(types_of_events == 'Offline'){
                        nextPrev(2);
                        $('#details-country').html('Prague');
                        $('.details-subtype').hide();
                    }else{
                        nextPrev(1);
                        $('.details-subtype').show();
                    }

                }, 500 );
            });
            //в зависимости от страны выводим собития
            $('.country-name').on('click', function (e) {
                e.preventDefault();
                $('#country').val(this.outerText);
                $('#details-country').html(this.outerText);

                const country_name = this.outerText;

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'getCurrentCountry',
                        data: country_name,
                    },
                    success:function(response) {
                        $('.event-wrap').empty().append(response.data)
                    },
                    complete: function (data) {
                        //console.log( 'complete', data);
                    },
                    error:function(data) {
                        console.log( 'error', data);
                    }
                });

                setTimeout( function(){
                    nextPrev(1);
                }, 500 );
            });

            $( document ).on( "click", ".event-wrap .item", function(e) {
                e.preventDefault();
                $('.event-wrap .item').removeClass('active');
                $(this).toggleClass('active');
                $('#event').val($(this).find('.title')[0].outerText);
                $('#details-type').html($(this).find('.title')[0].outerText);

                const event_id = $(this).data('event-id');
                const form =  $('#country').val();
                const type_event = $('#types_of_events').val();

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'getCurrentEvent',
                        data: event_id,
                        country: form,
                        type_event: type_event,
                    },
                    success:function(response) {
                        $('.package-wrap').empty().append(response.data);
                    },
                    complete: function (data) {
                        //console.log( 'complete', data);
                    },
                    error:function(data) {
                        console.log( 'error', data);
                    }
                });

                setTimeout( function(){
                    nextPrev(1);
                }, 500 );
            });
            $( document ).on( "click", ".package-wrap .package", function(e) {
                e.preventDefault();
                $('.package-wrap .package').removeClass('active')
                $(this).toggleClass('active');
                $('#event-package').val($(this).find('.title')[0].outerText);
                $('#details-package').html($(this).find('.title')[0].outerText);


                //var availableDates = dates_array;
                $( "#datepicker" ).datepicker({
                    firstDay: 1,
                    beforeShowDay: function(dt) {
                        return [available(dt), "asdasd" ];
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
                    if ( num < 10 ) {
                        s = "0" + num;
                    }
                    return s;
                }

                $( "#datepicker" ).datepicker("refresh");

                setTimeout( function(){
                    nextPrev(1);
                }, 500 );

            });

            $("#datepicker").on('change', function () {
                var date = $("#datepicker").datepicker({ dateFormat: 'dd.MM.yyyy' }).val();

                $('#event-date').val(date);
                $('#details-date').html(date);

                setTimeout( function(){
                    nextPrev(1);
                }, 500 );;
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
            const form = $('.main');
            const heightFooter = $('#footer').outerHeight();

            $(form).css( { minHeight: 'calc( 100vh - ' + heightFooter + 'px)' } );
        }

        stepsTransition();
        buttonBehavior();
        minHeightForm();
        designationCalendar();
        registrationForm();
    });
});
