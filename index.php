<?php
/**
 * The main template file
 * @package aesthetix
 */

get_header();
global $SVG;
?>

    <main role="main">
        <section class="main">
            <h1 class="page-title">
                <?php
                if ( is_home() && ! is_front_page() ) :
                   single_post_title();
                endif;
                ?>
            </h1>
            <div class="wrapper">
                <div class="article-list">
                    <?php
                    if ( have_posts() ) :

                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /*
                             * Include the Post-Type-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                             */
                            get_template_part( 'template-parts/content', get_post_type() );

                        endwhile;

                        the_posts_pagination(array(
                            'show_all'     => false,
                            'end_size'     => 1,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text' => __('<span class="caret" >'.$SVG['arrow-nav'] .'</span>', 'aesthetix'),
                            'next_text' => __('<span class="caret">'.$SVG['arrow-nav'] .'</span>', 'aesthetix'),
                            'add_args'     => false
                        ));


                    else :

                        get_template_part( 'template-parts/content', 'none' );
                        wp_reset_postdata();

                    endif;
                    ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->

<?php
get_footer();
