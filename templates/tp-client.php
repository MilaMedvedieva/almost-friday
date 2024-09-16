<?php
/* Template Name: Client Template */
get_header();
global $SVG;
$about_fields = get_fields();
?>

<main role="main">

    <section class="main">

        <div class="wrapper">
            <h1 class="page-title"><?php the_title(); ?></h1>



                <div class="page-description"><?php the_content() ?></div>

            
        </div>
    </section>

</main>

<?php get_footer(); ?>
