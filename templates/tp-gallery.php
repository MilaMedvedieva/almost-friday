<?php
/* Template Name: Gallery Template */
get_header();
global $SVG;
?>

<main role="main">

    <section class="main">

        <h1 class="page-title"><?php the_title(); ?></h1>

        <div class="wrapper">
            <?php
            $currentID = get_the_ID();
            $args = array(
                'post_type'      => 'gallery',
                'posts_per_page' => -1,
                'order' => 'ASC'
            );
            $query = new WP_Query($args);
            ?>


                <?php
                if (isset($query->posts) && !empty($query->posts)) {
                    foreach ($query->posts as $key => $value) {
                        $team_image = get_the_post_thumbnail_url($value->ID);
                        $team_link = get_permalink($value->ID);
                        ?>

                        <article>

                            <a href="<?php echo $team_link ?>">

                                <div class="preview">
                                    <img src="<?php echo $team_image ?>"
                                         data-src="<?php echo $team_image ?>"
                                         class="blur-up lazyload img"
                                         alt="<?php echo $value->post_title ?>"
                                         loading="lazy"
                                    >
                                </div>

                                <h2 class="title"><?php echo $value->post_title ?></h2>
                            </a>

                        </article>

                        <?php
                    }
                }
                ?>
        </div>

    </section>
</main>

<?php get_footer(); ?>
