<?php defined('ABSPATH') or die; ?>

<?php if ( $comments ) : ?>

    <div class="comments" id="comments">
        <?php $comments_number = absint( get_comments_number() ); ?>
            <div class="comments-header section-inner small max-percentage">
                <h2 class="comment-reply-title">
                    <?php if ( !have_comments() ) : ?>
                        <?php  _e( 'Leave a comment', 'twentytwenty' ); ?>
                    <?php elseif ( 1 === $comments_number ) : ?>
                    <?php else: ?>
                    <?php endif; ?>
		</h2><!-- .comments-title -->
            </div><!-- .comments-header -->
            <div class="comments-inner section-inner thin max-percentage">
                <?php

                //wp_list_comments()

                ?>
            </div><!-- .comments-inner -->
	</div><!-- comments -->
<?php endif;  ?>

<?php if ( comments_open() || pings_open() )  :?>

    <?php if ( $comments ) : ?>
        <hr class="styled-separator is-style-wide" aria-hidden="true" />
    <?php endif; ?>

    <?php comment_form( array(
			'class_form'         => 'section-inner thin max-percentage',
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		) );
    ?>

<?php elseif ( is_single() ) : ?>
    <?php if ( $comments ) : ?>
        <hr class="styled-separator is-style-wide" aria-hidden="true" />
    <?php endif; ?>

    <div class="comment-respond" id="respond">
        <p class="comments-closed"><?php _e( 'Comments are closed.', 'twentytwenty' ); ?></p>
    </div><!-- #respond -->
<?php endif; ?>
