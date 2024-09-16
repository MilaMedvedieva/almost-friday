<?php
get_header();
$type_field = get_fields();
global $SVG;
?>

<article role="main">
    <section class="main">
        <div class="main-wrapper">
            <div class="post-wrapper w-100">
                <div class="cover">
                    <?php
                    $video = $type_field['video']['url'];
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
                </div>
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>

            </div>
            <div class="post-sidebar w-100">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore earum esse ipsam molestiae nesciunt numquam quas quod repellat suscipit tenetur!</p>
            </div>
        </div>
    </section>

    <section  class="related-list">

        <h2 class="section-title">Related Posts</h2>

        <?php
        $currentID = get_the_ID();
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'order' => 'ASC',
            'orderby' => 'rand',
            'post__not_in' => array($currentID)
        );
        $query = new WP_Query($args);
        ?>
        <div class="wrapper">
            <div class="article-list">
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
        </div>
    </section>

</article>

<?php get_footer(); ?>
