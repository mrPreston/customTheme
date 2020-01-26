<?php

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
    require_once $composer_autoload;
    $timber = new Timber\Timber();
}

spl_autoload_register( function( $class ) {

    $namespace = 'CustomTheme\\';
    $path      = '';

    // Bail if the class is not in our namespace.
    if ( 0 !== strpos( $class, $namespace ) ) {
        return;
    }

    // Remove the namespace.
    $class = str_replace( $namespace, '', $class );

    // Build the filename.
    $file = realpath( __DIR__ . "/{$path}" );
    $file = $file . DIRECTORY_SEPARATOR . str_replace( '\\', DIRECTORY_SEPARATOR, $class ) . '.php';

    // If the file exists for the class name, load it.
    if ( file_exists( $file ) ) {
        include( $file );
    }
} );

function customTheme_enqueue_styles() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'all', get_template_directory_uri() . '/assets/css/all.css' );
    wp_enqueue_style( 'core', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'customTheme_enqueue_styles');

function custom_query_vars_filter($vars) {
    $vars[] .= 'department';
    $vars[] .= 'page';
    return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );

/**
 *
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );
Timber::$autoescape = false;
