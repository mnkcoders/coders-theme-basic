<?php defined('ABSPATH') or die; ?>
<?php if (have_posts()) : the_post(); ?>
    <?php if ( !is_home( ) && !is_front_page( ) ) : ?>
        <!-- CABECERA -->
        <div class="page-header">
            <div class="container overlay">
                <h1 class="wrap page-title pad-top-xl pad-bot-md"><?php the_title( ) ?></h1>
            </div>
        </div>
    <?php endif; ?>
    <!-- contenido -->
    <div class="page-content container">
        <div class="wrap clearfix">
        <?php the_content() ?>
        </div>
    </div>
<?php endif; ?>


