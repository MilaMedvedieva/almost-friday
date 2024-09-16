<?php
/* Template Name: Thank You Template */
get_header();
global $SVG;
?>

<main role="main">

    <section class="main">

        <div class="wrapper">
            <?php echo $SVG['success'] ?>
            <h1 class="page-title">Thank you!<br> You have successfully placed your inquiry!</h1>
            <p>A confirmation letter has been sent to your mail</p>
        </div>

    </section>

</main>

<?php get_footer(); ?>
