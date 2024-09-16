<?php
global $SVG;
$option = get_fields('option');
?>
<footer id="footer" class="footer">

    <div class="wrapper">
        <div class="logo">
            <?php echo $SVG['logo'] ?>
        </div>

        <div class="menu-wrapper">

                <div class="item">
                    <?php wp_nav_menu($args = array(
                        'theme_location'  => 'right',
                        'container_class' => 'footer-menu',
                    )); ?>
                </div>

                <div class="item">
                    <?php wp_nav_menu($args = array(
                        'theme_location'  => 'left',
                        'container_class' => 'footer-menu',
                    )); ?>
                </div>

            <?php if( have_rows('links', 'option') ): ?>

                <div class="item social">
                    <p>Follow us</p>

                        <ul>

                            <?php while( have_rows('links', 'option') ): the_row();
                                $name = get_sub_field('name');
                                $link = get_sub_field('link');
                            ?>

                                <li>
                                    <a href="<?php echo $link ?>">
                                        <?php echo $SVG[$name] ?>
                                    </a>

                                </li>

                            <?php endwhile; ?>

                        </ul>


                </div>

            <?php endif; ?>

        </div>

        <?php if($option['address']): ?>
            <div class="address">
                <?php echo $option['address'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="copyright" style="justify-content: flex-end">
        <p>© <?php echo date('Y') ?> All Rights Reserved. Website designed and built by <a target="_blank" href="https://webcap.com/">WebCap Digitals.</a></p>
        <p>
            <a href="/privacy-policy/terms-conditions/">Terms & Conditions</a>
            <a href="/privacy-policy/">Privacy Policy</a>
        </p>
    </div>
</footer>
<div class="modal modalSubscribe">
    <div class="form-wrapper">
        <div class="close"></div>
        <h3>Sign up for the newsletter</h3>
        <p>If you want relevant updates occasionally, sign up for the private newsletter. Your email is never shared.</p>
        <?php if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
            <?php dynamic_sidebar( 'custom-side-bar' ); ?>
        <?php endif; ?>
    </div>
</div>

<div class="modal modalBookNow">
    <div class="form-wrapper">
        <div class="close"></div>
        <h3>Book it Now</h3>
        <p>Leave your contact details and we will contact you to help create your event</p>
        <form id="formBookNow">
            <input required type="text" name="user_name" placeholder="Name">
            <input required type="email" name="user_email" placeholder="Email">
            <input required type="tel" id="phone" name="user_tel" placeholder="Phone">
            <button type="submit" class="button">Send</button>
        </form>
    </div>
</div>

<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        let url = $(location).attr('href');
        $('a.google_ads_link').on('click', function(){
            gtag_report_conversion(url);
            window.location.href = $(this).attr('href');;
        })
    });
</script>
</body>
</html>
