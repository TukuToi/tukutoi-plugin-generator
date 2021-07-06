<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.tukutoi.com/
 * @since      1.0.0
 *
 * @package    Tkt_Plugin_Generator
 * @subpackage Tkt_Plugin_Generator/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
if ( isset( $_POST['submit'] ) && ( 'submit' === $_POST['submit'] ) && ( isset( $_REQUEST['generate_plugin_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['generate_plugin_nonce'] ) ), 'generate_plugin_submit' ) ) ) {

	$form_errors = array();
	$_POST['form_errors'] = $form_errors;

	foreach ( $_POST as $key => $value ) {

		if ( empty( $value ) ) {
			switch ( $key ) {
				case 'plugin_prefix':
					$form_errors[] = 'The Plugin Prefix is empty.';
					break;
				case 'plugin_name':
					$form_errors[] = 'The Plugin Name is empty.';
					break;
				case 'plugin_slug':
					$form_errors[] = 'The Plugin Slug is empty.';
					break;
				case 'author_name':
					$form_errors[] = 'The Author Name is empty.';
					break;
				case 'author_email':
					$form_errors[] = 'The Author Email is empty.';
					break;
				default:
					$form_errors[] = $key . ' is empty.';
			}
			$_POST['form_errors'] = $form_errors;
		}
	}

	if ( ! empty( $form_errors ) ) {

		foreach ( $form_errors as $form_error ) {
			esc_html( $error ) . '<br>';
		}
	}
} else {
	?>

	<h2> <?php esc_html_e( 'Generate Your Plugin!', 'tkt-plugin-generator' ); ?>  </h2>

	<form id="tkt-plugin-generator-generator" method="post" >
		
		<div>
		<label for="plugin_name"> <?php esc_html_e( 'Plugin Name', 'tkt-plugin-generator' ); ?> </label>
		<input name="plugin_name" />
		<p> <?php esc_html_e( 'The plugin name', 'tkt-plugin-generator' ); ?>  </p>
		</div>
		
		<div>
		<label for="plugin_slug"> <?php esc_html_e( 'Plugin Slug', 'tkt-plugin-generator' ); ?> </label>
		<input name="plugin_slug" />
		<p> <?php esc_html_e( 'The plugin slug. All lower case. Use hyphens between words. No spaces. Eg "plugin-slug".', 'tkt-plugin-generator' ); ?>  </p>
		</div>

		<div>
		<label for="plugin_prefix"> <?php esc_html_e( 'Plugin Prefix', 'tkt-plugin-generator' ); ?> </label>
		<input name="plugin_prefix" />
		<p> <?php esc_html_e( 'The plugin Prefix', 'tkt-plugin-generator' ); ?>  </p>
		</div>   
		
		<div>
		<label for="author_name"> <?php esc_html_e( 'Author Name', 'tkt-plugin-generator' ); ?> </label>
		<input name="author_name" />
		<p> <?php esc_html_e( 'The author or company name.', 'tkt-plugin-generator' ); ?>  </p>
		</div>
		
		<div>
		<label for="author_email"> <?php esc_html_e( 'Author Email', 'tkt-plugin-generator' ); ?> </label>
		<input name="author_email" /> 
		<p> <?php esc_html_e( 'The author or company email.', 'tkt-plugin-generator' ); ?>  </p>
		</div>
		
		<div>
		<button id="tkt-plugin-generator-generator-submit" type="submit" value="submit" name="submit"> <?php esc_html_e( 'Generate', 'tkt-plugin-generator' ); ?> </button>
		</div>

		<?php wp_nonce_field( 'generate_plugin_submit', 'generate_plugin_nonce' ); ?>
		
	</form>

<?php } ?>
