<?php

/*
  Plugin Name: Playground plugin
  Description: Plugin by FK for Greator
  Version: 1.0
  Author: FK
  Author URI: https://fkasa.github.io
*/

class Playground {
  function __construct(){
    add_action('admin_menu', array($this, 'adminPage'));
    add_action('admin_init', array($this, 'settings'));
  }

  function settings(){
    add_settings_section('section1', null, null, 'playground-settings-page');

    add_settings_field('playground_sidebar_show_searchbox', 'Sidebar', array($this, 'showSidebarSearchHTML'), 'playground-settings-page', 'section1');
    register_setting('playgroungplugin','playground_sidebar_show_searchbox',array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    add_settings_field('playground_quiet_hours', 'Quite hours', array($this, 'quietHoursHTML'), 'playground-settings-page', 'section1');
    register_setting('playgroungplugin','playground_quiet_hours',array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
  
    add_settings_field('playground_footer_colors', 'Footer colors', array($this, 'footerColorsHTML'), 'playground-settings-page', 'section1');
    register_setting('playgroungplugin','playground_footer_bg_color',array('sanitize_callback' => 'sanitize_text_field', 'default' => '#007CFF'));
    register_setting('playgroungplugin','playground_footer_text_color',array('sanitize_callback' => 'sanitize_text_field', 'default' => '#FFFFFF'));
  }

  function adminPage(){
    add_options_page('Plaground settings', 'Playground', 'manage_options','playground-settings-page',array($this,'optionsHMTL'));
  }

  function showSidebarSearchHTML(){ ?>
    <input type="checkbox" name="playground_sidebar_show_searchbox" value="1" <?php checked(get_option('playground_sidebar_show_searchbox', '0')); ?>  id="playground_sidebar_show_searchbox">
    <label for="playground_sidebar_show_searchbox">Display searchbox in sidebar</label>
  <?php }

  function quietHoursHTML(){ ?>
    <input type="checkbox" name="playground_quiet_hours" value="1" <?php checked(get_option('playground_quiet_hours', '1')); ?> id="playground_quiet_hours">
    <label for="playground_quiet_hours">Show 0 notifications from 8pm to 7am</label>
  <?php }

  function footerColorsHTML(){ ?>
    <label for="playground_footer_bg_color">Background color:</label>
    <input type="text" name="playground_footer_bg_color" value="<?php echo esc_attr(get_option('playground_footer_bg_color', '#007CFF')); ?>" id="playground_footer_bg_color">
    <label for="playground_footer_text_color">Text color:</label>
    <input type="text" name="playground_footer_text_color" value="<?php echo esc_attr(get_option('playground_footer_text_color', '#FFFFFF')); ?>" id="playground_footer_text_color">
  <?php }

  function optionsHMTL(){ ?>
    <div class="wrap">
      <h1>Playground settings</h1>
      <form action="options.php" method="POST">
        <?php
          settings_fields('playgroungplugin');
          do_settings_sections('playground-settings-page');
          submit_button();
        ?>
      </form>
    </div>
  <?php }
}

$playground = new Playground();

// remove deprecation warning in PHP 8
// Deprecated: Required parameter $parameter2 follows optional parameter $parameter1
if ( defined('PHP_VERSION_ID') && PHP_MAJOR_VERSION > 7 ) {
  set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (false === str_contains($errstr, 'follows optional parameter')) {
        return false;
    }
  });
}