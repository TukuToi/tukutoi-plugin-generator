=== TukuToi Plugin Gnenerator ===
Contributors: bedas
Donate link: https://www.tukutoi.com/
Tags: plugin, generator, boilerplate
Requires at least: 4.9
Tested up to: 5.7
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This Plugin can be used to generate new plugins based on the [Better WordPress Plugin Boilerplate](https://github.com/TukuToi/better-wp-plugin-boilerplate), or any custom boilerplate.

== Description ==

The plugin helps generating new plugins based on the [Better WordPress Plugin Boilerplate](https://github.com/TukuToi/better-wp-plugin-boilerplate), or any custom boilerplate. You can install and activate it like any other plugin.

Then, insert the `[generate_plugin]` ShortCode in any page and visit the page.
Fill out the form and submit it.
This will generate a new Plugin in the Plugin's existing `new-sources` folder.

Future versions of this plugin will allow direct ZIP download and delete the just generated plugin right after.
As well development will be done to replace more things than the current defaults.

This plugin can be used by *anyone* who wants to create a Plugin generator, all you need to do is replace the plugin source in the `source` folder of this plugin.
As well of course the Generator is lookgin for certain string patterns to be replaced, thus your boilerplate should respect those patterns.
Have a look at the Plugin Sources to see how it is built.

Strictly speaking you can use this plugin to replace *anything* in *anything*.
So you could for example upload a folder full of text files and replace any string(s) in all those files, or else even rename files as you want. However the intention of the plugin is to make it easier for developers to generate theyr *own* version of the plugin boiler-plates and not waste time with string replacements.

Enjoy! 