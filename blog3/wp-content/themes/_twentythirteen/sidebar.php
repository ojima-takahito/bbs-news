<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
<!-- add-start -->
<h4>注目記事ランキング</h4>


<?php
$my_query = new WP_Query(array(
	/*'post_status' => 'publish',*/
	'tag' => 'hot',
	'posts_per_page' => 10,
	'orderby' => date,
	'order' => DESC
	/*'order' => ASC*/
));
if ($my_query->have_posts()):
?>
<ul class="blog">
<?php
while($my_query->have_posts()): $my_query->the_post(); ?>
<a href="<?php the_permalink(); ?>" style="float:left; margin-right:5px;">

<li style="overflow: hidden; margin: 5px 10px;list-style:none;">
<?php if(has_post_thumbnail()) :?>

	<?php the_post_thumbnail('100_thumbnail'); ?></a>

<?php else: ?>
	<?php preg_match('/wp-image-(d+)/s' , $post->post_content, $thumb);?>
	<?php if($thumb): ?>
		<?php echo wp_getattachment_image($thumb[1], '100_thumbnail'); ?></a>
	<? endif; ?>
<?php endif; ?>
<a href="<?php the_permalink(); ?>" style="padding-top:8px; font-size:0.8em;"><?php the_title(); ?></a>

</li>

<?php endwhile ?>

<?php else: ?>
<p>注目ランキングはありません</p>
<?php endif; ?>
</ul>


<?php wp_reset_query(); ?>

<!-- 注目ランキングend -->

<br />
<h4>バックナンバー（新着順）</h4>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("ul.children").hide();
    $("li.cat-item").hover(function() {
        $("ul.children",this).slideDown("slow");
    },
    function() {
        $("ul.children",this).slideUp("slow");
    });
});
</script>

<!-- アーカイブ -->
<?php
$ar_query = new WP_Query(array(
	/*'post_status' => 'publish',*/
	'posts_per_page' => 20,
	'orderby' => date,
	'order' => DESC
	/*'order' => ASC*/
));
if ($ar_query->have_posts()):
?>


<ul class="blog">

<?php while ( $ar_query->have_posts() ) : $ar_query->the_post(); ?>
<li style="overflow: hidden; margin: 5px 10px;list-style:none;">
	<article id="post-<?php the_ID(); ?>">


	<a href="<?php the_permalink(); ?>" style="padding-top:8px; font-size:0.8em;"><?php the_title(); ?></a>

	</article><!-- #post -->

	<?php /*comments_template();*/ ?>
</li>
<?php endwhile; ?>
</ul>
<?php
/* http://www.nxworld.net/wordpress/wp-no-plugin-pagination.html */

?>
<?php /*if ( function_exists( 'page_navi' ) ) { page_navi(); }*/ ?>

<?php else: ?>
<p>記事はありません</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
<!-- アーカイブend -->


<!-- add-end -->

				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>