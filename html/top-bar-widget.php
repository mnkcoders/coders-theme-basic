    <?php if( is_active_sidebar('top-bar') ) : ?>
    <div class="widget-area container col-12">
        <?php dynamic_sidebar('top-bar') ?>
    </div>
    <?php else: ?>
    <div class="widget-area container col-12">
        <!-- -->
    </div>
    <?php endif; ?>
