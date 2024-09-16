<?php
/* Template Name: Offline OFF */
get_header();
global $SVG;
$offline_fields = get_fields();
?>

<main role="main">

    <section class="main">

        <?php
        $video = $offline_fields['video']['url'];

        $image = get_the_post_thumbnail_url();

        if ($video) {

            ?>

            <video width="100%" height="auto" preload="auto" autoplay="autoplay" loop="loop">
                <source src="<?php echo $video ?>"></source>
                <source src="<?php echo $video ?>" type="video/mp4"></source>
            </video>

            <?php
        }
        else {
            ?>

            <img src="<?php echo $image ?>"
                 data-src="<?php echo $image ?>"
                 class="blur-up lazyload img"
                 alt="<?php the_title(); ?>"
                 loading="lazy"
            >

            <?php
        }

        ?>

        <div class="wrapper">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>

    </section>

</main>

<?php get_footer(); ?>
