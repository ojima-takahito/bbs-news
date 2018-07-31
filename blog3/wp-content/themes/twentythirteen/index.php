<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
		<div class="entry-content">
			<a href="<?php the_permalink (); ?>">
			<h2><?php the_title(); ?></h2>
			<?php if(has_post_thumbnail()): ?>
			<?php the_post_thumbnail(array(560,420)); ?>
			<?php endif; ?> 
			</a>

			<?php /*the_excerpt();*/ ?>

		 <p style="float:right; margin:20px;"><a class="more-link" href="<?php the_permaLink(); ?>">続きを読む</a></p>
		</div>

				<?php /* get_template_part( 'content', get_post_format() ); */ ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<script type="text/javascript">
	window._pt_sp_2 = [];
	_pt_sp_2.push('setAccount,1888d0c9');
	var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	(function() {
		var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
		atag.src = _protocol + 'js.ptengine.jp/pta.js';
		var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
		stag.src = _protocol + 'js.ptengine.jp/pts.js';
		var s = document.getElementsByTagName('script')[0]; 
		s.parentNode.insertBefore(atag, s);s.parentNode.insertBefore(stag, s);
	})();
</script>
	