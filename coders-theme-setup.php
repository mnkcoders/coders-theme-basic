<?php defined('ABSPATH') or die;
/**
 * 
 */
final class CodersThemeBase extends CodersTheme {

    public final function __construct() {

        $this->element('top_bar',self::TYPE_TEXT, $this->mod('coders_top_bar_layout',''))
                ->element('bottom_bar',self::TYPE_TEXT,$this->mod('coders_bottom_bar_layout',''))
                ->element('footer_widgets',self::TYPE_NUMBER,$this->mod('coders_footer_widgets',0))
                ->element('header',self::TYPE_TEXT,$this->mod('coders_theme_header_layout',''))
                ->element('has_footer_widgets',self::TYPE_CHECKBOX, $this->hasFooterWidgets())
                ->element('has_bottom_bar',self::TYPE_CHECKBOX, $this->hasBottomBar())
                ->element('has_top_bar',self::TYPE_CHECKBOX, $this->hasTopBar())
                ->element('has_bottom_bar',self::TYPE_CHECKBOX, $this->hasBottomBar());

        //theme core elements
        $this->themeSupport('post-thumbnails', array('post'))
                ->themeSupport('custom-logo', $this->logoSetup())
                ->menu('top', __('Top Menu', 'coder_themes'))
                ->menu('main', __('Main Menu', 'coder_themes'))
                ->menu('bottom', __('Bottom Menu', 'coder_themes'))
                ->menu('social', __('Social Menu', 'coder_themes'))
                ->style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap')
                //->style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap')
                ->style('style', get_stylesheet_uri())
                ->style('style-', $this->themeUri(sprintf('override/%s.css', $this->mod('coders_theme_color', 'red'))))
                ->script('jquery') 
                ->script('coders-script', $this->themeUri('script.js'))->localize('coders-script', array(
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('coders-nonce'),
                ));
        
        $this->sidebar('blog',__('Sidebar','coder_themes'))
                ->sidebar('error',__('Error Bar','coder_themes'))
                ->sidebar('bottom',__('Bottom Bar','coder_themes'))
                ->sidebar('top',__('Top Bar','coder_themes'))
                ->sidebar('header',__('Header Bar','coder_themes'))
                ->sidebar('footer-1',__('Footer A','coder_themes'))
                ->sidebar('footer-2',__('Footer B','coder_themes'))
                ->sidebar('footer-3',__('Footer C','coder_themes'))
                ->sidebar('footer-4',__('Footer D','coder_themes'));

        
        //theme custom settings
        $this->customSetting('coders_theme_color', $this->themeColors())
                ->customSetting('coders_top_bar_layout', $this->themeSettings())
                ->customSetting('coders_bottom_bar_layout', $this->themeSettings())
                ->customSetting('coders_theme_header_layout', $this->themeHeaderSetup())
                ->customSetting('coders_footer_widgets', $this->themeFooterColumns());

        //theme customizer
        $this->customSection('coders_theme_setup', array('title' => __('Coders Theme Setup', 'coder_themes'), 'priority' => 30))
                ->customControl('coders_theme_header_layout', 'coders_theme_setup', 'coders_theme_header_layout', self::TYPE_SELECT)
                ->customControl('coders_theme_color', 'coders_theme_setup', 'coders_theme_color', self::TYPE_SELECT)
                ->customControl('coders_footer_widgets', 'coders_theme_setup', 'coders_footer_widgets', self::TYPE_SELECT)
                ->customControl('coders_top_bar_layout', 'coders_theme_setup', 'coders_top_bar_layout', self::TYPE_SELECT)
                ->customControl('coders_bottom_bar_layout', 'coders_theme_setup', 'coders_bottom_bar_layout', self::TYPE_SELECT);

        parent::__construct();
    }
    
    protected final function wrap(): array {
        return array('wrap','clearfix');
    }
    
    protected final function themeWrappers(): array {
        return array(
            'top-bar','header-main','site-content','footer-widgets','bottom-bar'
        );
    }
    protected final function themeIds(): array {
        return array('site-main','site-header','site-menu','site-content','site-footer');
    }

    protected final function themeLayout(): array {
        return array(
            'site-header' => array(
                'top-bar' => array(
                    'block-left' => 'top-sidebar',
                    'block-right' => 'top-menu',
                ),
                'header-main' => array(
                    'site-logo',
                    'site-menu' => 'main-menu'
                ),
            ),
            'site-content' => 'content',
            'site-footer' => array(
                'footer-widgets',
                'bottom-bar' => array(
                    'block-left'=>'bottom-sidebar',
                    'block-right'=>'bottom-menu',
                )
            ),
        );


        return parent::themeLayout();
    }
    /**
     * 
     */
    protected final function renderFooterWidgetsBlock(){
        $areas = $this->footer_widgets;
        $col = 12 / ($areas > 0 ? $areas : 1);
        print '<div class="wrap clearfix container footer-widgets">';
        for($i = 1 ; $i <= $areas ; $i++){
            printf('<div class="widget-area sidebar-%s container col-%s">',$i,$col);
            $this->showSidebar( 'footer-' . $i );
            print('<!-- footer-widget-area --></div>');
        }
        print '</div>';
    }
    

    /**
     * @return boolean
     */
    private final function hasFooterWidgets(){
        return intval( $this->mod('coders_footer_widgets') ) > 0;
    }

    /**
     * @return boolean
     */
    private final function hasBottomBar(){
        return strlen( $this->mod('coders_bottom_bar_layout') ) > 0;
    }
    /**
     * @return boolean
     */
    private final function hasTopBar(){
        return strlen( $this->mod('coders_top_bar_layout') ) > 0;
    }

    private final function logoSetup(){
        return array(
                    'width' => 200, 'height' => 100,
                    'flex-height' => true, 'flex-width' => true,
                    'header-text' => array('site-title', 'site-description'));
    }
    /**
     * @return array
     */
    private final function themeHeaderSetup(){
        return array(
            '' => __('Default', 'coder_themes'),
            'fixed' => __('Fixed Header', 'coder_themes'),
            
        );
    }
    /**
     * @return array
     */
    private final function themeFooterColumns(){
        return array(
            0 => __('Empty', 'coder_themes'),
            1 => __('1 Column', 'coder_themes'),
            2 => __('2 Columns', 'coder_themes'),
            3 => __('3 Columns', 'coder_themes'),
            4 => __('4 Columns', 'coder_themes'),
        );
    }
    /**
     * @return array
     */
    private final function themeSettings(){
        return array(
            '' => __('Hidden', 'coder_themes'),
            'widget' => __('Widgets Only', 'coder_themes'),
            'menu' => __('Menu Only', 'coder_themes'),
            'widget_menu' => __('Widgets and Menu', 'coder_themes'),
            'menu_widget' => __('Menu and Widgets', 'coder_themes'),
        );
    }
    /**
     * @return array
     */
    private final function themeColors(){
        return array(
            'red' => __('Sakura', 'coder_themes'),
            'sunset' => __('Sunset', 'coder_themes'),
            'nature' => __('Nature', 'coder_themes'),
            'ocean' => __('Ocean', 'coder_themes'),
            'organic' => __('Organic', 'coder_themes'),
            'golden' => __('Cornfield', 'coder_themes'),
            'glass' => __('Glass', 'coder_themes'),
        );
    }
}

new CodersThemeBase();

