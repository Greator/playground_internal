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