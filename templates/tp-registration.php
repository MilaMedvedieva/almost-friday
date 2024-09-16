<?php
/* Template Name: Registration Template */
get_header();
$page_fields = get_fields();
global $SVG;
?>

<main role="main">

    <section class="main">

        <div class="wrapper">
            <h1 class="page-title">

                <?php if ($page_fields['title']): ?>

                    <?php echo $page_fields['title'] ?>

                 <?php else: ?>

                    Registration For The Event

                <?php endif; ?>

            </h1>



            <form id="registration" action="">
                <!--what-->
                <div class="tab">

                    <?php if ($page_fields['types_of_events']): ?>

                        <h3><?php echo $page_fields['types_of_events'] ?></h3>

                    <?php endif; ?>

                    <div class="types_of_events-wrap">

                        <input type="hidden" name="types_of_events" id="types_of_events" value="">

                        <ul class="list">

                            <li>
                                <a href="#" class="events-name"><span><?php echo $SVG['online'] ?></span>Online</a>
                            </li>
                            <li>
                                <a href="#" class="events-name"><span><?php echo $SVG['offline'] ?></span>Offline</a>
                            </li>

                        </ul>

                    </div>

                </div>

                <!--country-->
                <div class="tab">

                    <?php if ($page_fields['first_step']): ?>

                    <h3><?php echo $page_fields['first_step'] ?></h3>

                    <?php endif; ?>

                    <div class="country-wrap">

                        <input type="hidden" name="country" id="country" value="">

                        <ul class="list">

                            <li>
                                <a href="#" class="country-name"><span><?php echo $SVG['cz-flag'] ?></span>Prague</a>
                            </li>
                            <li>
                                <a href="#" class="country-name"><span><?php echo $SVG['planet'] ?></span>The rest of the world</a>
                            </li>

                        </ul>

                    </div>

                </div>

                <!--events for current country -->
                <div class="tab">
                    <?php if ($page_fields['second_step']): ?>

                        <h3><?php echo $page_fields['second_step'] ?></h3>

                    <?php endif; ?>

                    <input type="hidden" name="event" id="event" value="">

                    <div class="event-wrap"></div>

                </div>

                <!--type events -->


                <!--package (type events) -->
                <div class="tab">

                    <?php if ($page_fields['fourth_step']): ?>

                        <h3><?php echo $page_fields['fourth_step'] ?></h3>

                    <?php endif; ?>

                    <input type="hidden" name="event-package" id="event-package" value="">

                    <div class="package-wrap"></div>
                </div>

                <!--calendar  (type events) -->
                <div class="tab">

                    <?php if ($page_fields['fifth_step']): ?>

                        <h3><?php echo $page_fields['fifth_step'] ?></h3>

                    <?php endif; ?>

                    <input type="hidden" name="event-date" id="event-date" value="">

                    <div id="datepicker" class="calendar-wrap"></div>

                </div>

                <div class="tab">
                    <?php if ($page_fields['sixth_step']): ?>

                        <h3><?php echo $page_fields['sixth_step'] ?></h3>

                    <?php endif; ?>
                    <div class="form-wrap">
<!--                        <input name="checked" id="check_input" type="hidden" value="">-->
                        <p><input placeholder="Contact Name" oninput="this.className = ''" name="name" type="text" id="name"></p>
                        <p><input placeholder="Phone Number" oninput="this.className = ''" name="company_phone" type="tel" id="phone"></p>
                        <p><input placeholder="Contact Email " oninput="this.className = ''" name="company_email" type="email" id="mail"></p>
                        <p><input placeholder="Company Name" oninput="this.className = ''" name="company_name" type="text"></p>
                        <p><input placeholder="Company address" oninput="this.className = ''" name="company_address" type="text"></p>
                        <p><input placeholder="Country" oninput="this.className = ''" name="company_country" type="text"></p>
                        <p><input placeholder="Number of Participants" oninput="this.className = ''" name="participants_number" type="number" id="participants"></p>
                        <p><input placeholder="VAT Registration" oninput="this.className = ''" name="company_number" type="text"></p>
                        <p><textarea class="comment" name="message" id="" cols="10" rows="10" placeholder="Additional Details - We’ll be in contact shortly"></textarea></p>
                        <p class="checkbox"><input id="checkbox" type="checkbox" value="">I agree with Terms and Conditions</p>
                    </div>
                </div>
                <div class="tab">
                    <?php if ($page_fields['seventh_step']): ?>

                        <h3><?php echo $page_fields['seventh_step'] ?></h3>

                    <?php endif; ?>
                    <div class="details-wrap">
                        <ul>
                            <li>
                                <div class="name">Type</div>
                                <div id="details-event-type" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Your Location</div>
                                <div id="details-country" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Selected Event</div>
                                <div id="details-type" class="info"></div>
                            </li>
                            <li class="details-subtype">
                                <div class="name">Event Subtype</div>
                                <div id="details-subtype" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Package</div>
                                <div id="details-package" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Number of Participants</div>
                                <div id="details-participants" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Date</div>
                                <div id="details-date" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Price of Event</div>
                                <div class="info">(Cost will vary depending on increase/decrease participants)</div>
                            </li>
                        </ul>
                    </div>

                    <h3>Contact Information</h3>

                    <div class="details-wrap">
                        <ul>
                            <li>
                                <div class="name">Name</div>
                                <div id="details-name" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Email</div>
                                <div id="details-mail" class="info"></div>
                            </li>
                            <li>
                                <div class="name">Phone number</div>
                                <div id="details-phone" class="info"></div>
                            </li>
                        </ul>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </div>

                <div class="buttons-wrap">
                    <button type="button" id="prevBtn" >Return <?php echo $SVG['arrow-circle'] ?></button>
                    <button type="button" id="nextBtn"><?php echo $SVG['arrow-circle'] ?>Next Step</button>
                </div>

                <div class="points">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

                <input type="hidden" name="action" value="orderForm">
            </form>
        </div>

    </section>

</main>

<script>
    // function myFunction() git{
    //     var input, filter, ul, li, a, i, txtValue;
    //     input = document.getElementById('myInput');
    //     filter = input.value.toUpperCase();
    //     ul = document.getElementById("myUL");
    //     li = ul.getElementsByTagName('li');
    //
    //     for (i = 0; i < li.length; i++) {
    //         a = li[i].getElementsByTagName("a")[0];
    //         txtValue = a.textContent || a.innerText;
    //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //             li[i].style.display = "";
    //         } else {
    //             li[i].style.display = "none";
    //         }
    //     }
    // }
</script>

<?php get_footer(); ?>
