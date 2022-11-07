# Scaffold Usage

Scaffold base plugin to quickly deploy a new WordPress plugin.

Please search and replace the following strings after copying to your WordPress development folder:

**Note:** Search and replace should be CASE-sensitive!

* `constants.php`
  * Set the plugin version if needed. Should be the same as in the `plugin.php` header/preamble.
* `plugin.php`
  * Customize the plugin preamble
* Search and replace:
  * The `SCAFFOLD_` prefix with a unique identifier for your plugin
  * The `scaffold_` prefix with a unique identifier for your plugin
  * The `scaffold-` prefix with a unique identifier for your plugin
  * The `"scaffold"` quoted string with a unqiue identifier for your plugin


# LaunchCTL (OSX Only)

## Example file: plugin.scss.plist

	<plist version="1.0">
	<dict>
	    <key>Label</key>
	    <string>scaffold.scss</string>
	    <key>ProgramArguments</key>
	    <array>
	        <string>/usr/bin/sass</string>
	        <string>/Users/leepowers/Clients/client/wp/wp-content/plugins/scaffold/ui/scss/_plugin.scss:/Users/leepowers/Clients/client/wp/wp-content/plugins/scaffold/ui/css/plugin.css</string>
	    </array>
	    <key>WatchPaths</key>
	    <array>
	        <string>/Users/leepowers/Clients/client/wp/wp-content/plugins/scaffold/ui/scss/</string>
	    </array>
	</dict>
	</plist>

## Verify

	/usr/bin/sass /Users/leepowers/Clients/client/wp/wp-content/plugins/scaffold/ui/scss/_plugin.scss:/Users/leepowers/Clients/client/wp/wp-content/plugins/scaffold/ui/css/plugin.css

Double-check the output of `css/plugin.css`

## Auto-compile on file save

	launchctl load -w ~/Library/LaunchAgents/scaffold.scss.plist


# Cleanup

* Delete this file