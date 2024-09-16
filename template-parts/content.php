<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <a href="<?php echo esc_url( get_permalink())?>">

        <div class="preview">
            <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>"
                 data-src="<?php echo get_the_post_thumbnail_url($post->ID); ?>"
                 class="blur-up lazyload img"
                 alt="<?php echo the_title(); ?>"
                 loading="lazy"
            >
        </div>

        <?php
            the_title( '<h2 class="title">', '</h2>' );
        ?>

        <p> <?php echo wp_trim_words( get_the_excerpt(), 23, '...' ); ?></p>


    </a>

</article>
