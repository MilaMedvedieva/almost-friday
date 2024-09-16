<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header pb-30 ">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title f-lg">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title f-lg"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header>
	<div class="entry-content base f-montserrat_r black500 leading-tight text-justify">
		<p><?php echo get_the_excerpt(); ?></p>
	</div>
	<footer class="entry-footer base f-montserrat_r black500 leading-tight text-left">
		<div class="post-info">
			<p>By <?php echo get_the_author_meta('display_name'); ?> |
				<?php echo get_the_date() ?> |
				Categories:
				<?php
				$categories = get_the_category();
				foreach($categories as $category) {
					echo '<span><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a><span class="mark">,</span></span>';
				}
				?>
			</p>
		</div>
		<div class="button-area">
			<a href="<?php echo get_permalink() ?>">Read More</a>
		</div>
	</footer>
</article>
