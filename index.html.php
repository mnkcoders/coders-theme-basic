<?php defined('ABSPATH') or die; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <header id="site-header" class="header-group <?php print CodersTheme::feature('header') ?>">
            <?php if( CodersTheme::feature('has_top_bar') ) : ?>
            <div class="top-bar container <?php print CodersTheme::feature('top_bar') ?>">
                <div class="wrap clearfix">
                    <?php CodersTheme::templatePart( 'top-bar-' . CodersTheme::feature('top_bar') ); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="header-main container">
                <div class="wrap clearfix">
                    <div class="header-logo-wrapper container col-3">
                        <!-- LOGO -->
                        <?php print the_custom_logo() ?>
                        <!-- TITLE -->
                    </div>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'menu_class'=>'menu right container col-9 text-right' ,
                        'container'=> FALSE)); ?>
                </div>
            </div>
        </header>        
        <main id="site-content" class="container">
                <?php $post_type = array( get_post_type() , is_single() ? 'single' : 'loop' ); ?>            
                <?php if( $post_type[0] === FALSE || is_404() ) : ?> 
                    <div class="content error-404">
                    <?php CodersTheme::templatePart( '404' ); ?>
                    </div>
                <?php elseif( $post_type[0] === 'page' ) : ?>
                <div class="content page">
                    <?php CodersTheme::templatePart( 'page' ); ?>
                </div>
                <?php else: ?>
                <div class="container content <?php print implode(' ', $post_type);  ?>">
                    <?php CodersTheme::templatePart( implode('-', $post_type) ); ?>
                </div>
                <?php endif; ?>
            <button id="list_request">Send AjaxRequest</button>
        </main><!-- #site-content -->
        
        <footer id="site-footer" class="footer-group">
            <?php if( CodersTheme::feature('has_footer_widgets' ) ) : ?>
                <div class="footer-widgets">
                    <div class="wrap clearfix">
                        <!-- footer widgets -->
                        <?php for( $i = 0 ; $i < CodersTheme::feature('footer_widgets',true) ; $i++ ) : ?>
                            <?php if (is_active_sidebar('footer-widget-'.($i+1))) : ?>
                            <div class="widget-area container pad-top-md pad-bot-lg col-<?php
                                print 12 / CodersTheme::feature('footer_widgets') ?>">
                                <?php dynamic_sidebar('footer-widget-'.($i+1)) ?>
                            </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
                
            <?php if( strlen( CodersTheme::feature('has_bottom_bar' ) ) ) : ?> 
            <div class="bottom-bar">
                <div class="wrap clearfix <?php print CodersTheme::feature('bottom_bar') ?>">
                <!-- bottom bar -->
                    <?php CodersTheme::templatePart( 'bottom-bar-' . CodersTheme::feature('bottom_bar') ); ?>
                </div>
            </div><!-- .section-inner -->
            <?php endif; ?>
        </footer><!-- #site-footer -->	
        <?php wp_footer(); ?>
    </body>
</html>
