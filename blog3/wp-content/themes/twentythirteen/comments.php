<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<?php /*add yamasaki */ ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js?ver=1.8.3"></script>
<style type="text/css">
#acMenu dt{
    display:block;
    width:100%;
    height:auto;
    line-height:80px;
    text-align:center;
    border:#666 1px solid;
    cursor:pointer;
    }
#acMenu dd{
    background:#f2f2f2;
    width:100%;
    height:auto;
    line-height:auto;
    text-align:center;
    border:#666 1px solid;
    display:none;
    }
</style>
<script>
    $(function(){
        $("#acMenu dt").on("click", function() {
            $(this).next().slideToggle();
        });
    });
</script>

<?php /*add-end*/ ?>

<dl id="acMenu">
    <dt>コメントを残す</dt>
    <dd>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'twentythirteen' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 74,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
</dd>
</dl>
