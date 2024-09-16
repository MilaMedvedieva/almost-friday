<section class="scenes" id="scenes">

    <div class="wrapper">

        <h2 class="section-title"><?php echo $home_fields['scenes_title'] ?></h2>

        <div class="section-description"><?php echo $home_fields['scenes_description'] ?></div>

        <?php
        $gallery = $home_fields['scenes_gallery'];

        if( $gallery ):
            ?>

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

        <?php endif; ?>

        <a href="#" class="button">Create Your Event</a>

    </div>

</section>
