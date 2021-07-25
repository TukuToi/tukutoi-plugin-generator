=== TukuToi Plugin Generator ===
Contributors: bedas
Donate link: https://www.tukutoi.com/
Tags: plugin, generator, boilerplate
Requires at least: 4.9
Tested up to: 5.7
Stable tag: 1.3.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This Plugin can be used to generate new plugins based on the [Better WordPress Plugin Boilerplate](https://github.com/TukuToi/better-wp-plugin-boilerplate), or any custom boilerplate.

== Description ==

The plugin helps generating new plugins based on the [Better WordPress Plugin Boilerplate](https://github.com/TukuToi/better-wp-plugin-boilerplate), or any custom boilerplate. You can install and activate it like any other plugin.

Then, insert the `[generate_plugin]` ShortCode in any page and visit the page.
Fill out the form and submit it.
This will generate a new Plugin in the Plugin's existing `builds` folder and immediately download it to your Computer, as well as delete the just generated Files from the `builds` folder.

This plugin can be used by *anyone* who wants to create a Plugin generator, all you need to do is replace the plugin files in the `source` folder of this plugin.
By default the generator operates on the Better WordPress Plugin Boilerplate](https://github.com/TukuToi/better-wp-plugin-boilerplate) and has that Plugin included in the Source.

If you replace the Source with your own custom data, you must ensure that the strings inside the source match the strings that will be replaced.

These are the strings the plugin looks to replace in the source.
`pfx_` The prefix used for technical functions and general prefixing, such as ShortCodes.
`My Plugin Name` The Plugin Name as set in main plugin file `Plugin Name: `.
`plugin-name` The slugified Plugin name. Used to name folder and filenames, as well as the text domain.
`Plugin Human Name` The plugin name as set in the readme.txt file like `=== My Awesome Plugin ===`.
`Plugin_Name` Classnames, @package names.
`https://plugin.com/plugin-name-uri/` The Plugin URI as set in the plugin main file.
`1.0.0` The plugin Version as set in the plugin main file and general Plugin version definitions.
`This is a short description of what the plugin does. It\'s displayed in the WordPress admin area.` The plugin description as set in the main plugin file  in `Description: `.
`https://example.com` The author URI as set in the main plugin file `Author URI: `.
`Requires at least: 4.9` The `Requires at least:` tag in the plugin readme.txt file.
`Tested up to: 5.7` The `Tested up to: ` tag in the plugin readme.txt file.
`Stable tag: 1.0.0`, The `Stable tag: ` tag in the plugin readme.txt file.
`comments, spam` The plugin tags as set in the plugin readme.txt file `Tags: ` tag.
`https://donate.tld/` The plugin donate link as set in the plugin readme.txt file `Donatelink: ` tag.
`PLUGIN_NAME_` The Plugin Constants Prefix.
`Your Name or Your Company Name` The Plugins author name as set in the plugin main file `Author:` tag.
`<email@example.com>` The author email as used throughout the Plugin files.

Strictly speaking you can use this plugin to replace *anything* with *anything* in *anything*.
So you could for example upload a folder full of text files and replace any string(s) in all those files, or else even rename files as you want. 

Of course, you would have to alter the replacement rules in the Plugin.

Enjoy! 