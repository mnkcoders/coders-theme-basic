    <?php if( is_active_sidebar('top-bar') ) : ?>
    <div class="widget-area container col-6">
        <?php dynamic_sidebar('top-bar') ?>
    </div>
    <?php endif; ?>
    <?php wp_nav_menu( array(
        'theme_location' => 'top-menu',
        'menu_class'=> is_active_sidebar('top-bar') ?
            'menu right text-right container col-6' :
            'menu text-right container col-12',
        'container' => FALSE )); ?>
