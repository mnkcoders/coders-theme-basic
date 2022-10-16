    <?php wp_nav_menu(array(
        'theme_location' => 'bottom-menu',
        'menu_class' => is_active_sidebar('bottom-bar') ?
            'menu container col-6' :
            'menu container col-12',
        'container' => FALSE )); ?>
    <?php if( is_active_sidebar('bottom-bar') ) : ?>
    <div class="widget-area container col-6 right">
    <?php dynamic_sidebar('bottom-bar') ?>
    </div>
    <?php endif; ?>
