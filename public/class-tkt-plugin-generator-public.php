<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.tukutoi.com/
 * @since      1.0.0
 *
 * @package    Tkt_Plugin_Generator
 * @subpackage Tkt_Plugin_Generator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tkt_Plugin_Generator
 * @subpackage Tkt_Plugin_Generator/public
 * @author     TukuToi <hello@tukutoi.com>
 */
class Tkt_Plugin_Generator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tkt-plugin-generator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Copy a file, or recursively copy a folder and its contents
	 *
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     1.0.1
	 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
	 * @param       string $source    Source path.
	 * @param       string $dest      Destination path.
	 * @param       int    $permissions New folder creation permissions.
	 * @return      bool     Returns true on success, false on failure.
	 */
	private function xcopy( $source, $dest, $permissions = 0755 ) {

		$source_hash = $this->hash_directory( $source );

		// Check for symlinks.
		if ( is_link( $source ) ) {
			return symlink( readlink( $source ), $dest );
		}

		// Simple copy for a file.
		if ( is_file( $source ) ) {
			return copy( $source, $dest );
		}

		// Make destination directory.
		if ( ! is_dir( $dest ) ) {
			mkdir( $dest, $permissions, true );
		}

		// Loop through the folder.
		$dir = dir( $source );

		while ( false !== $entry = $dir->read() ) {

			// Skip pointers.
			if ( '.' == $entry || '..' == $entry ) {
				continue;
			}

			// Deep copy directories.
			if ( $source_hash != $this->hash_directory( $source . '/' . $entry ) ) {
				 $this->xcopy( "$source/$entry", "$dest/$entry", $permissions );
			}
		}

		// Clean up.
		$dir->close();

		return true;

	}


	/**
	 * Copy directory inside itself.
	 *
	 * In case of coping a directory inside itself,
	 * hash check the directory.
	 * Otherwise and infinite loop of copying is generated.
	 *
	 * @since 1.0.0
	 * @param string $directory the path to the directory.
	 * @return string | bool md5'd path of file/dir, or false.
	 */
	private function hash_directory( $directory ) {

		if ( ! is_dir( $directory ) ) {

			return false;

		}

		$files  = array();
		$dir    = dir( $directory );

		while ( false !== ( $file = $dir->read() ) ) {

			if ( '.' != $file && '..' != $file ) {

				if ( is_dir( $directory . '/' . $file ) ) {

					$files[] = $this->hash_directory( $directory . '/' . $file );

				} else {

					$files[] = md5_file( $directory . '/' . $file );

				}
			}
		}

		$dir->close();

		return md5( implode( '', $files ) );
	}

	/**
	 * Find all files inside directory.
	 *
	 * Recursively find all files in a directory,
	 * inclisive files in subdirectories.
	 *
	 * @since 1.0.0
	 * @param string $source the path to the directory.
	 * @return array $result Array with all file paths.
	 */
	private function find_all_files( $source ) {

		$root   = scandir( $source );
		$result = array();

		foreach ( $root as $value ) {

			if ( '.' === $value || '..' === $value ) {
				continue;
			}

			if ( is_file( "$source/$value" ) ) {
				$result[] = "$source/$value";
				continue;
			}

			$sub_files  = is_array( $this->find_all_files( "$source/$value" ) ) ? $this->find_all_files( "$source/$value" ) : array();

			foreach ( $sub_files as $value ) {

				$result[] = $value;

			}
		}

		return $result;

	}

	/**
	 * Replace all strings and filenames to be replaced.
	 *
	 * In the newly generated New Source Folder, replace all strings,
	 * rename file names.
	 *
	 * @since 1.0.0
	 * @param string $file the path to the file.
	 * @param array  $new_data Array with all new data to use for repalcement.
	 */
	private function replace_names( $file, $new_data = array() ) {

		if ( empty( $new_data ) ) {
			return;
		}

		$file_contents = file_get_contents( $file );
		$file_contents = str_replace( 'pfx_', $new_data['plugin_prefix'], $file_contents );
		$file_contents = str_replace( 'Plugin Name', $new_data['plugin_full_name'], $file_contents );
		$file_contents = str_replace( 'plugin-name', $new_data['plugin_file_name'], $file_contents );
		$file_contents = str_replace( 'Plugin_Name', $new_data['plugin_class_name'], $file_contents );
		$file_contents = str_replace( 'PLUGIN_NAME_', $new_data['plugin_const_name'], $file_contents );
		$file_contents = str_replace( 'Your Name', $new_data['author_name'], $file_contents );
		$file_contents = str_replace( '<email@example.com>', $new_data['author_email'], $file_contents );
		$new_file      = str_replace( 'plugin-name', $new_data['plugin_file_name'], $file );

		file_put_contents( $file, $file_contents );
		rename( $file, $new_file );

	}

	/**
	 * Create new Folder with files,
	 * Replace all strings and rename files,
	 * Zip new folder and Download.
	 *
	 * @since 1.0.0
	 * @param array $new_data Array with new data to use for replace.
	 */
	public function replace_zip_and_download( $new_data ) {

		if ( ! isset( $_REQUEST['generate_plugin_nonce'] ) || ( isset( $_REQUEST['generate_plugin_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['generate_plugin_nonce'] ) ), 'generate_plugin_submit' ) ) ) {

			return;

		}

		if ( empty( $_POST ) || ( isset( $_POST['form_errors'] ) && empty( $_POST['form_errors'] ) ) ) {
			return;
		}

		$new_data = array(
			'plugin_prefix'      => isset( $_POST['plugin_prefix'] ) ? sanitize_title( wp_unslash( $_POST['plugin_prefix'] ), '', 'save' ) . '_' : 'pfx_',
			'plugin_full_name'   => isset( $_POST['plugin_name'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin_name'] ) ) : 'Plugin Name',
			'plugin_file_name'   => isset( $_POST['plugin_slug'] ) ? sanitize_title( wp_unslash( $_POST['plugin_slug'] ), '', 'save' ) : 'plugin-slug',
			'plugin_class_name'  => str_replace( '-', '_', ucwords( isset( $_POST['plugin_slug'] ) ? sanitize_title( wp_unslash( $_POST['plugin_slug'] ), '', 'save' ) : 'plugin-slug' ) ),
			'plugin_const_name'  => strtoupper( str_replace( '-', '_', ucwords( isset( $_POST['plugin_slug'] ) ? sanitize_title( wp_unslash( $_POST['plugin_slug'] ), '', 'save' ) : 'plugin-slug' ) ) ) . '_',
			'author_name'        => isset( $_POST['author_name'] ) ? sanitize_text_field( wp_unslash( $_POST['author_name'] ) ) : 'Your Name',
			'author_email'       => isset( $_POST['author_email'] ) ? '<' . sanitize_email( wp_unslash( $_POST['author_email'] ) ) . '>' : '<your@email.com>',
		);

		$this->xcopy( plugin_dir_path( __DIR__ ) . 'source', plugin_dir_path( __DIR__ ) . 'new-sources/' . $new_data['plugin_file_name'], 0755 );

		$files = $this->find_all_files( plugin_dir_path( __DIR__ ) . 'new-sources/' . $new_data['plugin_file_name'] );

		foreach ( $files as $file ) {

			$this->replace_names( $file, $new_data );

		}

		wp_redirect( home_url( '/thank-you/' ) );
		exit;

	}

	/**
	 * ShortCode to show the Generate Form.
	 *
	 * @since 1.0.0
	 * @param array $atts The ShortCode attributes.
	 */
	public function generate_plugin_form( $atts ) {

		ob_start();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tkt-plugin-generator-public-display.php';

		$output = ob_get_clean();

		return $output;

	}

	/**
	 * Register the ShortCode.
	 *
	 * @since 1.0.0
	 */
	public function add_shortcode() {

		if ( ! is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			add_shortcode( 'generate_plugin', array( $this, 'generate_plugin_form' ) );
		}

	}

}
