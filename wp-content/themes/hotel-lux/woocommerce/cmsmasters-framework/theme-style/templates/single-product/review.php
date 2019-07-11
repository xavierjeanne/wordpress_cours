<?php
/**
 * @cmsmasters_package 	Hotel LUX
 * @cmsmasters_version 	1.0.0
 */

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container cmsmasters_comment_item">
		<figure class="cmsmasters_comment_item_avatar">
			<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '70' ), '' ); ?>
		</figure>
		<div class="comment-text cmsmasters_comment_item_cont">
			<div class="cmsmasters_comment_item_cont_info">
				<h5 class="cmsmasters_comment_item_title" itemprop="author"><?php 
					comment_author(); 
					
					if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
						if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
							echo '<em class="verified">(' . esc_html__( 'verified owner', 'hotel-lux' ) . ')</em> ';
				?></h5>
				<?php hotel_lux_woocommerce_rating('cmsmasters_theme_icon_star_empty', 'cmsmasters_theme_icon_star_full', true, $comment->comment_ID); ?>
				<time class="cmsmasters_comment_item_date" itemprop="datePublished" datetime="<?php echo get_comment_date(); ?>"><?php echo get_comment_date(); ?></time>
			</div>
			<div itemprop="description" class="description cmsmasters_comment_item_content">
				<?php 
				do_action( 'woocommerce_review_before_comment_text', $comment );
				
				comment_text();
				
				do_action( 'woocommerce_review_after_comment_text', $comment );
				
				do_action( 'woocommerce_review_before_comment_meta', $comment );
				
				if ($comment->comment_approved == '0') {
					echo '<p class="meta">' . 
						'<em>' . esc_html__( 'Your comment is awaiting approval', 'hotel-lux' ) . '</em>' . 
					'</p>';
				}
				?>
			</div>
		</div>
	</div>
