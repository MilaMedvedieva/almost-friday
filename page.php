<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 *  @package aesthetix
 */
get_header();
global $SVG;
?>

<main role="main">

    <section class="main">

        <div class="wrapper">
            <h1 class="page-title"><?php the_title(); ?></h1>

            <?php
            $content = get_the_content();

             if($content): ?>

            <div class="page-description"><?php echo $content ?></div>

             <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
