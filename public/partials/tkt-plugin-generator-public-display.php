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
<h2> <?php esc_html_e( 'Generate Your Plugin!', 'tkt-plugin-generator' ); ?>  </h2>
<form id="tkt-plugin-generator-generator" method="post" >
	<div>
		<label for="plugin_name"> <?php esc_html_e( 'Plugin Name', 'tkt-plugin-generator' ); ?> </label>
		<input type="text" name="plugin_name" required>
		<p> <?php esc_html_e( 'The plugin name', 'tkt-plugin-generator' ); ?>  </p>
	</div>
	<div>
		<label for="plugin_slug"> <?php esc_html_e( 'Plugin Slug', 'tkt-plugin-generator' ); ?> </label>
		<input type="text" name="plugin_slug" required>
		<p> <?php esc_html_e( 'The plugin slug. All lower case. Use hyphens between words. No spaces. Eg "plugin-slug".', 'tkt-plugin-generator' ); ?>  </p>
	</div>
	<div>
		<label for="plugin_prefix"> <?php esc_html_e( 'Plugin Prefix', 'tkt-plugin-generator' ); ?> </label>
		<input type="text" name="plugin_prefix" required>
		<p> <?php esc_html_e( 'The plugin Prefix', 'tkt-plugin-generator' ); ?>  </p>
	</div>
	<div>
		<label for="author_name"> <?php esc_html_e( 'Author Name', 'tkt-plugin-generator' ); ?> </label>
		<input type="text" name="author_name" required>
		<p> <?php esc_html_e( 'The author or company name.', 'tkt-plugin-generator' ); ?>  </p>
	</div>
	<div>
		<label for="author_email"> <?php esc_html_e( 'Author Email', 'tkt-plugin-generator' ); ?> </label>
		<input type="email" name="author_email" required>
		<p> <?php esc_html_e( 'The author or company email.', 'tkt-plugin-generator' ); ?>  </p>
	</div>
	<div>
		<button id="tkt-plugin-generator-generator-submit" type="submit" value="tkt_plugin_generator_submit" name="tkt_plugin_generator_submit"> <?php esc_html_e( 'Generate', 'tkt-plugin-generator' ); ?> </button>
	</div>
	<?php wp_nonce_field( 'generate_plugin_submit', 'generate_plugin_nonce' ); ?>
</form>

