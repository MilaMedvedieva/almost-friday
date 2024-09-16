<?php
/* Template Name: Online Template */
get_header();
global $SVG;
$online_fields = get_fields();
$option = get_fields('option');
?>

<main role="main">

    <section class="main">

        <?php
        $video = $online_fields['video']['url'];

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

    <section class="events" id="events">

        <div class="wrapper">
            <?php
            $events_list = $online_fields['events_list'];
            if(!empty($events_list)):
                foreach( $events_list as $event ):
                    $image = get_the_post_thumbnail_url($event->ID);
                    $link = get_permalink($event->ID);
                    $content = $event->post_content;
                    $field = get_fields($event->ID);
            ?>
                    <div class="item">

                        <a class="wrap" href="<?php echo $link ?>"></a>

                        <h3 class="title">
                            <?php echo (!empty($field['new_title'])) ? $field['new_title'] : $event->post_title;?>
                        </h3>

                        <div class="svg">
                            <?php

                            if ( $field['svg_name'] ) {
                                echo $SVG[$field['svg_name']];
                            }
                            else {
                                echo $SVG['Yoga'];
                            }

                            ?>
                        </div>

                        <div class="description">
                            <?php
                            if ($field['preview_content']) {
                                echo wp_trim_words($field['preview_content'], 15, ' ...');
                            }
                            else {
                                echo wp_trim_words( $content, 15, ' ...' );
                            }
                            ?>
                        </div>
                        <a class="link btn-bookNow" href="#" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></a>
                    </div>
            <?php
                endforeach;
            else:
                echo '<p>The list of events is empty!</p>';
            endif;

           ?>
        </div>

    </section>

    <section class="scenes" id="scenes">

        <div class="wrapper">

            <h2 class="section-title"><?php echo $online_fields['scenes_title'] ?></h2>

            <div class="section-description"><?php echo $online_fields['scenes_description'] ?></div>

            <?php
            $gallery = $online_fields['scenes_gallery'];

            if( $gallery ):
                ?>

                <div class="slider">

                    <?php foreach( $gallery as $image ): ?>
                        <div class="slide">
                            <img src="<?php echo $image['sizes']['thumbnail'] ?>" data-src="<?php echo $image['sizes']['large'] ?>" class="blur-up lazyload img" alt="<?php echo $image['alt'] ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

            <button class="button btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></button>

        </div>

    </section>

</main>

<?php get_footer(); ?>