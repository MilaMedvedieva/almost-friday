<?php
/* Template Name: Book Now */
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

                    Book it Now

                <?php endif; ?>

            </h1>
            <p class="subtitle">Leave your contact details and we will contact you to help create your event</p>
            <form id="formBookNow">
                <input required type="text" name="user_name" placeholder="Name">
                <input required type="email" name="user_email" placeholder="Email">
                <input required type="tel" id="phone" name="user_tel" placeholder="Phone">
                <button type="submit" class="button">Send</button>
            </form>


        </div>

    </section>

</main>

<?php get_footer(); ?>
