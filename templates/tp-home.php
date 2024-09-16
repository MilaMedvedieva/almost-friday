<?php
/* Template Name: Homepage Template */
get_header();
global $SVG;
$home_fields = get_fields();
$option = get_fields('option');
?>

<main role="main">

    <section class="main">
        <?php if ($home_fields['background']): ?>
        <div class="background-image">
            <?php foreach( $home_fields['background'] as $image ): ?>
                <img src="<?php echo $image['sizes']['thumbnail'] ?>" data-src="<?php echo $image['sizes']['large'] ?>" class="blur-up lazyload img" alt="<?php echo $image['alt'] ?>" loading="lazy">
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" data-src="<?php echo get_the_post_thumbnail_url(); ?>" class="blur-up lazyload img" alt="" loading="lazy">
        <?php endif; ?>

        <div class="wrapper">
            <h1 class="page-title"><?php echo $home_fields['main_title'] ?></h1>

            <a class="scroll" href="#work">
                <?php echo $SVG['arrow'] ?>
            </a>
        </div>

    </section>

    <section class="work" id="work">

        <div class="wrapper">
            <h2 class="section-title"><?php echo $home_fields['work_title'] ?></h2>

            <div class="section-description"><?php echo $home_fields['work_description'] ?></div>

            <?php if( have_rows('steps') ): ?>

            <?php $key = 0 ?>

            <div class="work-steps">

                    <?php while( have_rows('steps') ): the_row();

                        $name = get_sub_field('name');
                        $description = get_sub_field('description');
                        $key ++;
                        ?>

                        <div class="item">

                        <?php if( $name ): ?>

                            <?php echo $SVG['work-'.$key] ?>

                            <span><?php echo $key ?></span>

                            <h3><?php echo $name ?></h3>

                            <p><?php echo $description ?></p>

                        <?php endif; ?>

                        </div>

                    <?php endwhile; ?>

            </div>

            <?php endif; ?>

            <button class="button btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></button>
        </div>

    </section>

    <?php
    $reviews = $home_fields['items_reviews'];

    if( $reviews ): ?>

        <section class="reviews" id="reviews">
            <div class="wrapper">
                <?php if( $home_fields['title_reviews'] ): ?>
                    <h2 class="section-title"><?php echo $home_fields['title_reviews'] ?></h2>
                <?php endif; ?>
                <?php if( $home_fields['subtitle_reviews'] ): ?>
                    <div class="section-description"><?php echo $home_fields['subtitle_reviews'] ?></div>
                <?php endif; ?>
                <div class="slider-reviews">
                    <?php foreach( $reviews as $review ): ?>
                        <div class="slide-wrap">
                            <?php if( $review['logo'] ): ?>
                                <div class="logo">
                                    <img src="<?php echo $review['logo']['sizes']['thumbnail'] ?>" data-src="<?php echo $review['logo']['sizes']['large'] ?>" class="blur-up lazyload img" alt="<?php echo $review['logo']['alt'] ?>" loading="lazy">
                                </div>
                            <?php endif; ?>

                            <div class="text">
                                <p><?= $review['review']?></p>
                            </div>
                            <div class="caption">
                                <p><strong><?= $review['full_name']?></strong>,<?= $review['position']?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endif; ?>

    <?php
    $gallery = $home_fields['scenes_gallery'];

    if( $gallery ): ?>

    <section class="scenes" id="scenes">

        <div class="wrapper">

            <h2 class="section-title"><?php echo $home_fields['scenes_title'] ?></h2>

            <div class="section-description"><?php echo $home_fields['scenes_description'] ?></div>

            <div class="slider">

                    <div class="slide">
                        <div class="wrap">
                            <?php echo $home_fields['scenes_description'] ?>
                        </div>
                    </div>

                    <?php foreach( $gallery as $image ): ?>
                        <div class="slide">
                            <img src="<?php echo $image['sizes']['thumbnail'] ?>" data-src="<?php echo $image['sizes']['large'] ?>" class="blur-up lazyload img" alt="<?php echo $image['alt'] ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>

                </div>

        </div>

    </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
