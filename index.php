<?php defined('ABSPATH') or die;

if (class_exists('CoderThemeBase')) {
    CoderThemeBase::instance()->display();
}
else{
    print ':(';
}
