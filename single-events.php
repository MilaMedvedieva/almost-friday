<?php get_header();
$event_field = get_fields();
$option = get_fields('option');
global $SVG;
?>

<main role="main">

    <section class="main">

        <?php
        $video = $event_field['video']['url'];

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
            <h1 class="page-title">
                <?php echo (!empty($event_field['new_title'])) ? $event_field['new_title'] : the_title();?>
            </h1>
            <button class="button btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></button>

            <a class="scroll" href="#about">
                <?php echo $SVG['arrow'] ?>
            </a>
        </div>

    </section>

    <section class="about" id="about">

        <div class="wrapper">

            <h2 class="section-title">About <?php the_title(); ?></h2>

            <?php if ($event_field['language'] || $event_field['duration'] ): ?>

                <div class="info">
                    <?php if ($event_field['language']): ?>
                        <p>
                            <?php echo $SVG['language'] ?>
                            <?php echo $event_field['language'] ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($event_field['duration']): ?>
                        <p>
                            <?php echo $SVG['duration'] ?>
                            <?php echo $event_field['duration'] ?></p>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <?php if( have_rows('content') ): ?>

                <div class="section-description">

                    <?php while( have_rows('content') ): the_row();

                        $image = get_sub_field('image');
                        $video = get_sub_field('video');
                        $content = get_sub_field('text');

                        ?>

                            <?php if($image or $video):?>
                                <div class="paragraph">
                                    <div class="text"><?php echo $content ?></div>
                                    <?php if ($video) { ?>
                                        <div class="video">
                                            <video width="100%" height="auto" preload="" autoplay="" controls="controls" loop="loop">
                                                <source src="<?php echo $video ?>"></source>
                                                <source src="<?php echo $video ?>" type="video/mp4"></source>
                                            </video>
                                        </div>
                                        <?php
                                    }
                                    else {
                                        ?>

                                        <div class="image">
                                            <img src="<?php echo $image['url'] ?>"
                                                 data-src="<?php echo $image['url'] ?>"
                                                 class="blur-up lazyload img"
                                                 alt="Content image"
                                                 loading="lazy"
                                            >
                                        </div>

                                        <?php
                                    }
                                    ?>
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

    <?php if(isset($event_field['choose_type']) && !empty($event_field['choose_type'])): ?>

        <section class="types" style="display: none">
            <div class="wrapper">
                <div class="type-list">

                    <?php foreach( $event_field['choose_type'] as $item ): ?>

                        <div class="item">

                            <div class="type">

                                <?php if( get_field( 'single', $item->ID) ): ?>

                                    <a class="wrap" href="<?php echo get_permalink($item->ID) ?>"></a>

                                    <h3 class="title"><?php echo $item->post_title ?></h3>

                                    <div class="svg">

                                        <?php

                                        $svg_name = get_field( 'svg_name', $item->ID);

                                        if ( $svg_name ) {
                                            echo $SVG[$svg_name];
                                        }
                                        else {
                                            echo $SVG['Yoga'];
                                        }

                                        ?>

                                    </div>

                                    <div class="description">
                                        <?php
                                        $preview = get_field( 'preview_content', $item->ID);

                                        if ($preview) {
                                            echo wp_trim_words($preview, 15, ' ...');
                                        }
                                        else {
                                            echo wp_trim_words( $item->post_content, 15, ' ...' );
                                        }
                                        ?>
                                    </div>
                                    <div class="arrow">
                                        <?php echo $SVG['button'] ?>
                                    </div>

                                <?php else: ?>

                                    <div class="wrap"></div>

                                    <h3 class="title"><?php echo $item->post_title ?></h3>

                                    <div class="svg">

                                        <?php

                                        $svg_name = get_field( 'svg_name', $item->ID);

                                        if ( $svg_name ) {
                                            echo $SVG[$svg_name];
                                        }
                                        else {
                                            echo $SVG['Yoga'];
                                        }

                                        ?>

                                    </div>

                                    <div class="description">
                                        <?php
                                        $preview = get_field( 'preview_content', $item->ID);

                                        if ($preview) {
                                            echo wp_trim_words($preview, 15, ' ...');
                                        }
                                        else {
                                            echo wp_trim_words( $item->post_content, 15, ' ...' );
                                        }
                                        ?>
                                    </div>
                                    <div class="arrow">
                                        <?php echo $SVG['button'] ?>
                                    </div>

                                <?php endif; ?>



                            </div>

                            <?php
                            $packages = get_field( 'packages', $item->ID);

                            if ($packages):
                                ?>
                                <div class="packages">
                                    <?php foreach( $packages as $package ): ?>
                                        <div class="package">
                                            <h3 class="title">
                                                <?php echo $package['name'] ?>
                                                <?php if($package['location'] == 'prague'): ?>
                                                    <span><?php echo $package['location'] ?></span>
                                                <?php endif; ?>
                                            </h3>
                                            <div class="price"><?php echo $package['price'] ?></div>
                                            <div class="content"><?php echo $package['content'] ?></div>
                                            <a class="link btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </section>

    <?php endif; ?>



    <?php if(isset($event_field['packages_offline']) && !empty($event_field['packages_offline'])): ?>

        <section class="types">
            <div class="wrapper">
                <div class="type-list type-list-offline">
                    <?php $packages = $event_field['packages_offline'];?>
                        <div class="packages">
                            <?php foreach( $packages as $package ): ?>
                                <div class="package">
                                    <h3 class="title">
                                        <?php echo $package['name'] ?>
                                    </h3>
                                    <div class="price"><?php echo $package['price'] ?></div>
                                    <div class="content"><?php echo $package['content'] ?></div>
                                    <a class="link btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                </div>
            </div>
        </section>

    <?php endif; ?>


    <?php if($event_field['packages']): ?>

        <section class="types">
            <div class="wrapper">
                <div class="type-list type-list-offline">
                    <?php $packages = $event_field['packages'];?>
                    <div class="packages">
                        <?php foreach( $packages as $package ): ?>
                            <div class="package">
                                <h3 class="title">
                                    <?php echo $package['name'] ?>
                                </h3>
                                <div class="svg">
                                    <?php
                                    $svg_name = get_field( 'svg_name', $post->ID);
                                    if ( $svg_name ) {echo $SVG[$svg_name];}
                                    else {echo $SVG['Yoga'];}
                                    ?>
                                </div>
                                <div class="price"><?php echo $package['price'] ?></div>
                                <div class="content"><?php echo $package['content'] ?></div>
                                <a class="link btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>



    <?php
    $gallery = $event_field['scenes_gallery'];

    if( $gallery ): ?>

    <section class="scenes" id="scenes">

        <div class="wrapper">

            <h2 class="section-title"><?php echo $event_field['scenes_title'] ?></h2>

            <div class="section-description"><?php echo $event_field['scenes_description'] ?></div>

            <div class="slider">

                <?php foreach( $gallery as $image ): ?>
                    <div class="slide">
                        <img src="<?php echo $image['sizes']['thumbnail'] ?>" data-src="<?php echo $image['sizes']['large'] ?>" class="blur-up lazyload img" alt="<?php echo $image['alt'] ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>

            </div>

            <button class="button btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></button>

        </div>

    </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
