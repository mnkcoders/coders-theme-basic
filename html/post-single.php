<?php defined('ABSPATH') or die; ?>
<?php if (have_posts()) : the_post(); ?>
    <!-- CABECERA -->
    <div class="header">
        <div class="container overlay">
            <h1 class="post-title wrap pad-top-xl pad-bot-md"><?php the_title(); ?></h1>
        </div>
    </div>
    <!-- contenido -->
    <div class="post-content wrap">
        <?php the_content(); ?>
    </div>
<?php endif; ?>