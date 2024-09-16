<?php get_header();
$type_field = get_fields();
$option = get_fields('option');
global $SVG;
?>

<main role="main">

    <section class="main">

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

        <div class="wrapper">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <button class="button btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></button>
            <a class="scroll" href="#about">
                <?php echo $SVG['arrow'] ?>
            </a>
        </div>

    </section>

    <section class="about" id="about">

        <div class="wrapper">

            <h2 class="section-title">About <?php the_title(); ?></h2>

            <?php if ($type_field['language'] || $type_field['duration'] ): ?>

                <div class="info">
                    <?php if ($type_field['language']): ?>
                        <p>
                            <?php echo $SVG['language'] ?>
                            <?php echo $type_field['language'] ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($type_field['duration']): ?>
                        <p>
                            <?php echo $SVG['duration'] ?>
                            <?php echo $type_field['duration'] ?></p>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <?php if( have_rows('content') ): ?>

                <div class="section-description">

                    <?php while( have_rows('content') ): the_row();

                        $image = get_sub_field('image');
                        $content = get_sub_field('text');

                        ?>

                        <?php if($image):?>
                            <div class="paragraph">
                                <div class="text"><?php echo $content ?></div>

                                <div class="image">
                                    <img src="<?php echo $image['url'] ?>"
                                         data-src="<?php echo $image['url'] ?>"
                                         class="blur-up lazyload img"
                                         alt="Content image"
                                         loading="lazy"
                                    >
                                </div>

                            </div>
                        <?php else: ?>

                            <div class="paragraph full">
                                <div class="text"><?php echo $content ?></div>

                            </div>

                        <?php endif; ?>

                    <?php endwhile; ?>

                </div>

            <?php endif; ?>

        </div>

    </section>

    <?php
    $packages = $type_field['packages'];
    if ($packages): ?>

        <section class="packages">
            <div class="wrapper">
                <div class="package-list">
                    <?php foreach( $packages as $package ): ?>
                        <div class="package">
                            <h3 class="title"><?php echo $package['name'] ?>
                                <?php if($package['location'] == 'prague'): ?>
                                    <span><?php echo $package['location'] ?></span>
                                <?php endif; ?>
                            </h3>
                            <div class="price"><?php echo $package['price'] ?></div>
                            <div class="content"><?php echo $package['content'] ?></div>
                            <a class="link" href="/registration/" onclick="return gtag_report_conversion('https://almostfridayevents.com/registration/')">Create Your Event</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
