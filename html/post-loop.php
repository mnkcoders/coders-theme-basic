<?php defined('ABSPATH') or die; ?>
<?php if ( !is_front_page( ) ) : ?>
    <!-- contenido -->
    <div class="header container spa-bot-lg">
        <div class="container overlay">
            <h1 class="category-title wrap pad-top-xl pad-bot-md"><?php print get_queried_object()->name ?></h1>
        </div>
    </div>
<?php endif; ?>
<?php if (have_posts()) : ?>
    <div class="wrap clearfix container">
        <?php if( is_active_sidebar('sidebar') ) :  ?>
        <div class="sidebar container col-3 pad-right-md">
            <!-- SIDEBAR OPENER -->
            <?php dynamic_sidebar('sidebar'); ?>
            <!-- SIDEBAR-CLOSER -->
        </div>
        <?php endif; ?>
        <ul class="loop container grid-4 col-9">
            <?php while ( have_posts()) : the_post(); ?>
            <li class="post container">
                    <div class="container post-image">
                        <a class="container link" href="<?php the_permalink( ); ?>">
                            <img src="<?php
                                print get_the_post_thumbnail_url( get_the_ID() , 'medium' ); ?>" alt="<?php
                                echo get_the_title() ?>" title="<?php
                                echo get_the_title() ?>" />
                        </a>
                    </div>
                    <div class="container post-content">
                        <!--div class="header"-->
                            <h4 class="container title centered">
                                <a href="<?php the_permalink( ); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        <!--/div-->
                        <!--div class="content">
                            <?php the_content(__('Leer m&aacute;s')); ?>
                        </div-->
                    </div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div class="container paginator centered pad-md">
        <div class="pages wrap"><?php echo paginate_links(); ?></div>
    </div>
<?php else: ?>
    <!-- no post -->
    <div class="container empty">
        <div class="wrap">
            <h4 class="title"><?php print __('No hay entradas que mostrar') ?></h4>
        </div>
    </div>
<?php endif; ?>


<?php get_template_part( 'html/pagination' ); ?>