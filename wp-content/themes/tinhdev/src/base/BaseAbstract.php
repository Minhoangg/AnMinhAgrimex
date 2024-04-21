<?php

namespace TinhDev\base;

/*
 * Class BaseAbstract
 * **/

abstract class BaseAbstract{

    public static $template_directory_uri = '/wp-content/themes/tinhdev/src/assets';

    public function __construct(){
        add_action('wp_enqueue_scripts', [
            $this, 'enqueueStyle'
        ]);
        add_action('wp_enqueue_scripts', [
            $this, 'enqueueScript'
        ]);
    }


    /**
     * @return void
     */
    public function enqueueStyle(){
        wp_enqueue_style('global', self::$template_directory_uri . '/scss/global.css');
    }

    /**
     * @return void
     */
    public function enqueueScript(){
        wp_enqueue_script('jquery-3',
            'https://code.jquery.com/jquery-3.7.1.min.js', ['jquery'],
            1.1, TRUE);
        wp_enqueue_script('slickcarousel-js',
            self::$template_directory_uri . '/vendor/slick-1.8.1/slick/slick.min.js',
            ['jquery'],
            2.3, TRUE);
        wp_enqueue_script('bootstrap-js',
            self::$template_directory_uri . '/vendor/bootstrap-5.0.2/dist/js/bootstrap.min.js',
            ['jquery'], 1.1, TRUE);
        wp_enqueue_script('script', self::$template_directory_uri . '/js/script.js', ['jquery'],
            1.1, TRUE);
    }
}