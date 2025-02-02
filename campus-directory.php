<?php
/** 
 * Plugin Name: Campus Directory
 * Plugin URI: https://emdplugins.com
 * Description: Integrated information repository for academic people
 * Version: 1.8.0
 * Author: eMarket Design
 * Author URI: https://emarketdesign.com
 * Text Domain: campus-directory
 * Domain Path: /lang
 * @package CAMPUS_DIRECTORY
 * @since WPAS 4.0
 */
/*
 * LICENSE:
 * Campus Directory is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Campus Directory is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * Please see <http://www.gnu.org/licenses/> for details.
*/
if (!defined('ABSPATH')) exit;
if (!class_exists('Campus_Directory')):
	/**
	 * Main class for Campus Directory
	 *
	 * @class Campus_Directory
	 */
	final class Campus_Directory {
		/**
		 * @var Campus_Directory single instance of the class
		 */
		private static $_instance;
		public $app_name = 'campus_directory';
		public $session;
		/**
		 * Main Campus_Directory Instance
		 *
		 * Ensures only one instance of Campus_Directory is loaded or can be loaded.
		 *
		 * @static
		 * @see CAMPUS_DIRECTORY()
		 * @return Campus_Directory - Main instance
		 */
		public static function instance() {
			if (!isset(self::$_instance)) {
				self::$_instance = new self();
				self::$_instance->define_constants();
				self::$_instance->includes();
				self::$_instance->load_plugin_textdomain();
				self::$_instance->session = new Emd_Session('campus_directory');
				add_filter('the_content', array(
					self::$_instance,
					'change_content'
				));
				add_action('admin_menu', array(
					self::$_instance,
					'display_settings'
				));
				add_filter('template_include', array(
					self::$_instance,
					'show_template'
				));
			}
			return self::$_instance;
		}
		/**
		 * Cloning is forbidden.
		 */
		public function __clone() {
			_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'campus-directory') , '1.0');
		}
		/**
		 * Define Campus_Directory Constants
		 *
		 * @access private
		 * @return void
		 */
		private function define_constants() {
			define('CAMPUS_DIRECTORY_VERSION', '1.8.0');
			define('CAMPUS_DIRECTORY_AUTHOR', 'eMarket Design');
			define('CAMPUS_DIRECTORY_NAME', 'Campus Directory');
			define('CAMPUS_DIRECTORY_PLUGIN_FILE', __FILE__);
			define('CAMPUS_DIRECTORY_PLUGIN_DIR', plugin_dir_path(__FILE__));
			define('CAMPUS_DIRECTORY_PLUGIN_URL', plugin_dir_url(__FILE__));
			define('EMD_ADMIN_DIR', ABSPATH . 'wp-admin');
		}
		/**
		 * Include required files
		 *
		 * @access private
		 * @return void
		 */
		private function includes() {
			//these files are in all apps
			if (!function_exists('emd_mb_meta')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'assets/ext/emd-meta-box/emd-meta-box.php';
			}
			if (!function_exists('emd_translate_date_format')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/date-functions.php';
			}
			if (!function_exists('emd_get_hidden_func')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/common-functions.php';
			}
			if (!class_exists('Emd_Entity')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/entities/class-emd-entity.php';
			}
			if (!function_exists('emd_get_template_part')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/layout-functions.php';
			}
			//the rest
			if (!class_exists('Emd_Query')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/class-emd-query.php';
			}
			if (!function_exists('emd_get_p2p_connections')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/relationship-functions.php';
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'assets/ext/posts-to-posts/posts-to-posts.php';
			}
			if (!function_exists('emd_shc_get_layout_list')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/shortcode-functions.php';
			}
			if (!class_exists('Emd_Session')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/class-emd-session.php';
			}
			if (!function_exists('emd_show_login_register_forms')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/login-register-functions.php';
			}
			do_action('emd_ext_include_files');
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/plugin-app-functions.php';
			//app specific files
			if (!function_exists('emd_show_settings_page')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/settings-functions.php';
			}
			if (!function_exists('emd_global_register_settings')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/settings-functions-globs.php';
			}
			if (!function_exists('emd_misc_register_settings')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/settings-functions-misc.php';
			}
			if (is_admin()) {
				if (!class_exists('WP_List_Table', false)) {
					require_once EMD_ADMIN_DIR . '/includes/class-wp-list-table.php';
				}
				if (!class_exists('Emd_List_Table')) {
					require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/class-emd-list-table.php';
				}
				if (!function_exists('emd_show_shortcodes_page')) {
					require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/shortcode-list-functions.php';
				}
				//these files are in all apps
				if (!function_exists('emd_display_store')) {
					require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/store-functions.php';
				}
				//the rest
				if (!function_exists('emd_shc_button')) {
					require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/wpas-btn-functions.php';
				}
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/glossary.php';
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/admin/getting-started.php';
			}
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/class-install-deactivate.php';
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/entities/class-emd-person.php';
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/entities/emd-person-shortcodes.php';
			if (!function_exists('emd_show_forms_lite_page')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/emd-form-builder-lite/emd-form-builder.php';
			}
			if (!function_exists('emd_lite_modal')) {
				require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/emd-lite/emd-lite.php';
			}
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/scripts.php';
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/plugin-feedback-functions.php';
			require_once CAMPUS_DIRECTORY_PLUGIN_DIR . 'includes/content-functions.php';
		}
		/**
		 * Loads plugin language files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			$locale = apply_filters('plugin_locale', get_locale() , 'campus-directory');
			$mofile = sprintf('%1$s-%2$s.mo', 'campus-directory', $locale);
			$localmo = CAMPUS_DIRECTORY_PLUGIN_DIR . '/lang/' . $mofile;
			$globalmo = WP_LANG_DIR . '/campus-directory/' . $mofile;
			if (file_exists($globalmo)) {
				load_textdomain('campus-directory', $globalmo);
			} elseif (file_exists($localmo)) {
				load_textdomain('campus-directory', $localmo);
			} else {
				load_plugin_textdomain('campus-directory', false, CAMPUS_DIRECTORY_PLUGIN_DIR . '/lang/');
			}
		}
		/**
		 * Changes content on frontend views
		 *
		 * @access public
		 * @param string $content
		 *
		 * @return string $content
		 */
		public function change_content($content) {
			if (!is_admin()) {
				if (post_password_required()) {
					$content = get_the_password_form();
				} else {
					$mypost_type = get_post_type();
					if ($mypost_type == 'post' || $mypost_type == 'page') {
						$mypost_type = "emd_" . $mypost_type;
					}
					$ent_list = get_option($this->app_name . '_ent_list');
					if (in_array($mypost_type, array_keys($ent_list)) && class_exists($mypost_type)) {
						$func = "change_content";
						$obj = new $mypost_type;
						$content = $obj->$func($content);
					}
				}
			}
			return $content;
		}
		/**
		 * Creates plugin page in menu with submenus
		 *
		 * @access public
		 * @return void
		 */
		public function display_settings() {
			$settings_pages_cap = 'manage_options';
			$settings_pages_cap = apply_filters('emd_settings_pages_cap', $settings_pages_cap, $this->app_name);
			add_menu_page(__('CampusDirectory', 'campus-directory') , __('CampusDirectory', 'campus-directory') , $settings_pages_cap, $this->app_name, array(
				$this,
				'display_getting_started_page'
			));
			add_submenu_page($this->app_name, __('Getting Started', 'campus-directory') , __('Getting Started', 'campus-directory') , $settings_pages_cap, $this->app_name);
			add_submenu_page($this->app_name, __('Glossary', 'campus-directory') , __('Glossary', 'campus-directory') , $settings_pages_cap, $this->app_name . '_glossary', array(
				$this,
				'display_glossary_page'
			));
			add_submenu_page($this->app_name, __('Settings', 'campus-directory') , __('Settings', 'campus-directory') , $settings_pages_cap, $this->app_name . '_settings', array(
				$this,
				'display_settings_page'
			));
			add_submenu_page($this->app_name, __('Shortcodes', 'campus-directory') , __('Shortcodes', 'campus-directory') , $settings_pages_cap, $this->app_name . '_shortcodes', array(
				$this,
				'display_shortcodes_page'
			));
			add_submenu_page($this->app_name, __('Forms', 'campus-directory') , __('Forms', 'campus-directory') , $settings_pages_cap, $this->app_name . '_forms', array(
				$this,
				'display_forms_page'
			));
			add_submenu_page($this->app_name, __('Custom Fields', 'campus-directory') , __('Custom Fields', 'campus-directory') , $settings_pages_cap, $this->app_name . '_cust_fields', array(
				$this,
				'display_cust_fields_page'
			));
			add_submenu_page($this->app_name, __('Plugins', 'campus-directory') , __('Plugins', 'campus-directory') , $settings_pages_cap, $this->app_name . '_store', array(
				$this,
				'display_store_page'
			));
			add_submenu_page($this->app_name, __('Support', 'campus-directory') , __('Support', 'campus-directory') , $settings_pages_cap, $this->app_name . '_support', array(
				$this,
				'display_support_page'
			));
			//add submenu page under app settings page
			do_action('emd_ext_add_menu_pages', $this->app_name);
			$emd_lic_settings = get_option('emd_license_settings', Array());
			$show_lic_page = 0;
			if (!empty($emd_lic_settings)) {
				foreach ($emd_lic_settings as $key => $val) {
					if ($key == $this->app_name) {
						$show_lic_page = 1;
						break;
					} else if ($val['type'] == 'ext') {
						$show_lic_page = 1;
						break;
					}
				}
				if ($show_lic_page == 1 && function_exists('emd_show_license_page')) {
					add_submenu_page($this->app_name, __('Licenses', 'campus-directory') , __('Licenses', 'campus-directory') , 'manage_options', $this->app_name . '_licenses', array(
						$this,
						'display_licenses_page'
					));
				}
			}
		}
		/**
		 * Calls settings function to display glossary page
		 *
		 * @access public
		 * @return void
		 */
		public function display_glossary_page() {
			do_action($this->app_name . '_settings_glossary');
		}
		public function display_getting_started_page() {
			do_action($this->app_name . '_getting_started');
		}
		public function display_store_page() {
			emd_display_store($this->app_name);
		}
		public function display_support_page() {
			emd_display_support($this->app_name, 2, 'campus-directory');
		}
		public function display_licenses_page() {
			do_action('emd_show_license_page', $this->app_name);
		}
		public function display_settings_page() {
			do_action('emd_show_settings_page', $this->app_name);
		}
		public function display_shortcodes_page() {
			do_action('emd_show_shortcodes_page', $this->app_name);
		}
		public function display_forms_page() {
			do_action('emd_show_forms_lite_page', $this->app_name);
		}
		public function display_cust_fields_page() {
			emd_lite_get_operations('cust_fields', __('Custom Fields', 'campus-directory') , 'campus_directory');
		}
		/**
		 * Displays single, archive, tax and no-access frontend views
		 *
		 * @access public
		 * @return string, $template:emd template or template
		 */
		public function show_template($template) {
			return emd_show_template($this->app_name, CAMPUS_DIRECTORY_PLUGIN_DIR, $template);
		}
	}
endif;
/**
 * Returns the main instance of Campus_Directory
 *
 * @return Campus_Directory
 */
function CAMPUS_DIRECTORY() {
	return Campus_Directory::instance();
}
// Get the Campus_Directory instance
CAMPUS_DIRECTORY();