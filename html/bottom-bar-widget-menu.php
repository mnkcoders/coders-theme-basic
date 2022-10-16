    <?php if( is_active_sidebar('bottom-bar') ) : ?>
    <div class="widget-area container col-6">
    <?php dynamic_sidebar('bottom-bar') ?>
    </div>
    <?php endif; ?>
    <?php wp_nav_menu(array(
        'theme_location' => 'bottom-menu',
        'menu_class' => is_active_sidebar('bottom-bar') ?
            'menu right container text-right col-6' :
            'menu container text-right col-12',
        'container' => FALSE )); ?>
