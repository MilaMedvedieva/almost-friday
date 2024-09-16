<?php
/* Template Name: Contact Template */
get_header();
global $SVG;
$option = get_fields('option');
?>

<main role="main">

    <section class="main">

        <h1 class="page-title"><?php the_title(); ?></h1>

        <div class="wrapper">

            <form id="subscribe" action="">
                <input required type="text" name="username" placeholder="Name">
                <input required type="email" name="email" placeholder="Email">
                <input type="tel" id="phone" name="tel" placeholder="Phone">
                <input type="text" id="town" name="town" placeholder="Location">
                <textarea name="message" id="" cols="30" rows="10" placeholder="Please type message here. We look forward to hearing from you."></textarea>
                <input type="hidden" name="action" value="subscribeForm">
                <button type="submit" onclick="return gtag_report_conversion(‘https://almostfridayevents.com/contact-us/')" class="button">Send</button>
            </form>

            <div class="info">
                <?php if($option['address']): ?>
                <div class="item">
                    <h3>Address</h3>
                    <?php echo $option['address'] ?>
                </div>
                <?php endif; ?>

                <?php if($option['phone'] || $option['email']): ?>
                <div class="item">
                    <h3>Contact information</h3>
                    <?php if($option['email']): ?>
                    <a href="mailto:<?php echo $option['email'] ?>"><?php echo $option['email'] ?></a>
                    <?php endif; ?>
                    <?php if($option['phone']): ?>
                        <a href="tel:<?php echo $option['phone'] ?>"><?php echo $option['phone'] ?></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="success">
                <svg class="icon mail">
                    <polyline points="119,1 119,69 1,69 1,1"></polyline>
                    <polyline points="119,1 60,45 1,1 119,1"></polyline>
                </svg>
                <svg class="icon plane">
                    <polyline points="119,1 1,59 106,80 119,1"></polyline>
                    <polyline points="119,1 40,67 43,105 69,73"></polyline>
                </svg>
                <h2 class="section-title">Thank You! We'll get back to you shortly!</h2>
            </div>
        </div>

    </section>

</main>

<?php get_footer(); ?>
