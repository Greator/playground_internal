<?php
/**
 * LearnDash Settings Page PayPal.
 *
 * @since 2.4.0
 * @package LearnDash\Settings\Pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ( class_exists( 'LearnDash_Settings_Page' ) ) && ( ! class_exists( 'LearnDash_Settings_Page_PayPal' ) ) ) {

	/**
	 * Class LearnDash Settings Page PayPal.
	 *
	 * @since 2.4.0
	 */
	class LearnDash_Settings_Page_PayPal extends LearnDash_Settings_Page {

		/**
		 * Public constructor for class
		 *
		 * @since 2.4.0
		 */
		public function __construct() {
			$this->parent_menu_page_url  = 'admin.php?page=learndash_lms_settings';
			$this->menu_page_capability  = LEARNDASH_ADMIN_CAPABILITY_CHECK;
			$this->settings_page_id      = 'learndash_lms_settings_paypal';
			$this->settings_page_title   = esc_html__( 'PayPal Settings', 'learndash' );
			$this->settings_tab_title    = $this->settings_page_title;
			$this->settings_tab_priority = 20;
			$this->show_quick_links_meta = false;
			parent::__construct();
		}
	}
}
add_action(
	'learndash_settings_pages_init',
	function() {
		LearnDash_Settings_Page_PayPal::add_page_instance();
	}
);
