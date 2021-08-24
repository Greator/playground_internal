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

    add_settings_field('playground_sidebar_show_searchbox', 'Display searchbox on sidebar', array($this, 'showSidebarSearchHTML'), 'playground-settings-page', 'section1');
    register_setting('playgroungplugin','playground_sidebar_show_searchbox',array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

  }

  function adminPage(){
    add_options_page('Plaground settings', 'Playground', 'manage_options','playground-settings-page',array($this,'optionsHMTL'));
  }

  function showSidebarSearchHTML(){ ?>
    <input type="checkbox" name="playground_sidebar_show_searchbox" value="1" <?php checked(get_option('playground_sidebar_show_searchbox', '0')); ?> >
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