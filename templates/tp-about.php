<?php
/* Template Name: About Template */
get_header();
global $SVG;
$about_fields = get_fields();
$option = get_fields('option');
?>

<main role="main">

    <section class="main">

        <?php
        $video = $about_fields['video']['url'];

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

            <?php
            $content = get_the_content();

             if($content): ?>

            <div class="page-description"><?php echo $content ?></div>

             <?php endif; ?>
            <button class="button btn-bookNow" onclick="return gtag_report_conversion(<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>)"><?= $option['sta_btn_text']?></button>
        </div>
    </section>

    <?php if($about_fields['title']): ?>

    <section class="info">
        <div class="wrapper">
            <div class="image">
                <?php
                    $image = $about_fields['image'];
                    if ($image):
                ?>

                    <img src="<?php echo $image['sizes']['thumbnail'] ?>"
                         data-src="<?php echo $image['sizes']['large'] ?>"
                         class="blur-up lazyload img"
                         alt="<?php echo $image['alt'] ?>"
                         loading="lazy"
                    >

                <?php endif; ?>
            </div>
            <div class="content">
                <h2 class="section-title"><?php echo $about_fields['title'] ?></h2>
                <?php if( $about_fields['content'] ): ?>

                    <div class="section-description"><?php echo $about_fields['content'] ?></div>

                <?php endif; ?>

                <?php if( have_rows('links', 'option') ): ?>

                    <div class="social">
                        <p>Follow us</p>

                        <ul>

                            <?php while( have_rows('links', 'option') ): the_row();
                                $name = get_sub_field('name');
                                $link = get_sub_field('link');
                                ?>

                                <li>
                                    <a href="<?php echo $link ?>">
                                        <?php echo $SVG[$name] ?>
                                    </a>

                                </li>

                            <?php endwhile; ?>

                        </ul>


                    </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
