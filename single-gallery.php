<?php get_header();
$event_field = get_fields();
?>

<main role="main">

    <section class="main">

        <div class="wrapper">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>

    </section>

    <?php

    $images = get_field('gallery');

    if( $images ): ?>
    <section class="gallery" id="gallery">

        <div class="wrapper">

            <ul id="image-gallery">
                <?php foreach( $images as $image ): ?>
                    <li class="image">
                        <div class="img-wrapper">
                            <a href="<?php echo $image['sizes']['large'] ; ?>">
                                <img src="<?php echo $image['sizes']['large'] ?>"
                                     data-src="<?php echo $image['sizes']['large'] ?>"
                                     class="blur-up lazyload img"
                                     alt="<?php echo $image['name']; ?>"
                                     loading="lazy"
                                >
                            </a>
                            <div class="img-overlay">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

    </section>

    <?php endif; ?>

    <section class="newsletter">
        <div class="wrapper">
            <div class="form-wrapper">
                <h3>Sign up for the newsletter</h3>
                <p>If you want relevant updates occasionally, sign up for the private newsletter. Your email is never shared.</p>
                <?php if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
                    <?php dynamic_sidebar( 'custom-side-bar' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
