<?php
	/**
	 * Plugin Name: Disable Sensitive Files
	 * Plugin URI:  https://pluginurl.com/
	 * Description: Enhance your site security with disable sensitive files & click jacking protection.
	 * Version:     1.0
	 * Author:      Noman Khan
	 * Author URI:  https://google.com
	 * Text Domain: disable-sensitive-files
	 *
	 */
	if( !defined('ABSPATH')) {
		die("Can't access");
	}

    function nk_activation() {
		$htaccess_file = ABSPATH . '.htaccess';
	
		// Existing rules...
		$rules = "\n# Block access to xmlrpc.php\n<Files xmlrpc.php>\norder deny,allow\ndeny from all\n</Files>\n";
		$rules .= "\n# Disable directory listing\nOptions -Indexes\n";
		
		// Deny access to sensitive files
		$rules .= "\n# Deny access to sensitive files\n<FilesMatch \"\\.(htaccess|htpasswd|wp-config\\.php|php\\.ini|php5\\.ini)\">\nRequire all denied\n</FilesMatch>\n";
	
		// Disable access to internal directories
		$rules .= "\n# Block access to internal admin/includes\nRewriteRule ^wp-admin/includes/ - [F,L]\n";
		$rules .= "# Block access to wp-includes (allow necessary assets)\nRewriteRule ^wp-includes/[^/]+\\.(php|txt)\$ - [F,L]\n";
	
		// Disable server signature
		if (function_exists('apache_get_version')) {
			$rules .= "\n# Disable server signature\nServerSignature Off\n";
		}
	
		// Set Clickjacking protection headers
		$rules .= "\n# Clickjacking protection\nHeader always set X-Frame-Options \"DENY\"\n";
		$rules .= "Header always set Content-Security-Policy \"frame-ancestors 'none';\"\n";
	
		// Check if the .htaccess file is writable and doesn't already contain the rules
		if (is_writable($htaccess_file) && strpos(file_get_contents($htaccess_file), 'Block access to xmlrpc.php') === false) {
			// Add the rules to .htaccess
			file_put_contents($htaccess_file, $rules, FILE_APPEND);
		}
    }
    // Hook the function to run when the plugin is activated
	register_activation_hook(__FILE__, 'nk_activation');


    function nk_deactivation() {
        $htaccess_file = ABSPATH . '.htaccess';
		$content = file_get_contents($htaccess_file);
		
		// Remove existing rules (xmlrpc, directory listing, sensitive files, internal directories)
		if (strpos($content, 'Block access to xmlrpc.php') !== false) {
			$content = str_replace("\n# Block access to xmlrpc.php\n<Files xmlrpc.php>\norder deny,allow\ndeny from all\n</Files>\n", '', $content);
		}
	
		if (strpos($content, 'Disable directory listing') !== false) {
			$content = str_replace("\n# Disable directory listing\nOptions -Indexes\n", '', $content);
		}
	
		if (strpos($content, 'Deny access to sensitive files') !== false) {
			$content = str_replace("\n# Deny access to sensitive files\n<FilesMatch \"\\.(htaccess|htpasswd|wp-config\\.php|php\\.ini|php5\\.ini)\">\nRequire all denied\n</FilesMatch>\n", '', $content);
		}
	
		if (strpos($content, 'Block access to internal admin/includes') !== false) {
			$content = str_replace("\n# Block access to internal admin/includes\nRewriteRule ^wp-admin/includes/ - [F,L]\n", '', $content);
		}
	
		// Remove the server signature rule
		if (strpos($content, 'Disable server signature') !== false) {
			$content = str_replace("\n# Disable server signature\nServerSignature Off\n", '', $content);
		}
	
		// Remove Clickjacking protection headers
		if (strpos($content, 'Clickjacking protection') !== false) {
			$content = str_replace("\n# Clickjacking protection\nHeader always set X-Frame-Options \"DENY\"\n", '', $content);
			$content = str_replace("Header always set Content-Security-Policy \"frame-ancestors 'none';\"\n", '', $content);
		}
	
		// Write the updated content back to the .htaccess file
		file_put_contents($htaccess_file, $content);
    }
    // Hook the function to run when the plugin is deactivated
	register_deactivation_hook(__FILE__, 'nk_deactivation');