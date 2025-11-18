<?php
/*
Plugin Name:  FluentSMTP
Plugin URI:   https://fluentsmtp.com
Description:  The Ultimate SMTP Connection Plugin for WordPress.
Version:      1.0.0
Author:       FluentSMTP & WPManageNinja Team
Author URI:   https://fluentsmtp.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  fluent-run-smtp
Domain Path:  /language
*/

!defined('WPINC') && die;

define('FLUENTMAIL_PLUGIN_FILE', __FILE__);

require_once plugin_dir_path(__FILE__) . 'boot.php';

register_activation_hook(
    __FILE__, array('\FluentMail\Includes\Activator', 'handle')
);

register_deactivation_hook(
    __FILE__, array('\FluentMail\Includes\Deactivator', 'handle')
);

add_action('plugins_loaded', 'fluentSmtpInitUpdater', 8);

function fluentSmtpInitUpdater()
{
    if (!class_exists('\\FluentMail\\Updater\\FluentLicensing')) {
        require_once plugin_dir_path(__FILE__) . 'updater/FluentLicensing.php';
    }

    try {
        $licensing = (new \FluentMail\Updater\FluentLicensing())->register(apply_filters('fluentsmtp_updater_config', [
            'version'  => FLUENTMAIL_PLUGIN_VERSION,
            'item_id'  => '1643',
            'basename' => plugin_basename(FLUENTMAIL_PLUGIN_FILE),
            'api_url'  => 'https://east.webmakerr.com/',
        ]));
    } catch (\Exception $exception) {
        error_log('FluentSMTP updater initialization failed: ' . $exception->getMessage());
        return;
    }

    if (!is_admin()) {
        return;
    }

    if (!class_exists('\\FluentMail\\Updater\\LicenseSettings')) {
        require_once plugin_dir_path(__FILE__) . 'updater/LicenseSettings.php';
    }

    (new \FluentMail\Updater\LicenseSettings())
        ->register($licensing, [
            'menu_title'   => 'FluentSMTP License',
            'page_title'   => 'FluentSMTP License',
            'title'        => 'FluentSMTP License Settings',
            'description'  => 'Manage your FluentSMTP license to enable automatic updates.',
            'purchase_url' => 'https://fluentsmtp.com/pricing/?utm_source=fluentsmtp_plugin&utm_medium=license_screen',
            'account_url'  => 'https://fluentsmtp.com/account/',
            'plugin_name'  => 'FluentSMTP',
        ])
        ->addPage([
            'type'      => 'options',
            'menu_slug' => 'fluentsmtp-license',
        ]);
}

/**
 * Initializes the Fluent SMTP plugin.
 *
 * This function creates a new instance of the FluentMail\Includes\Core\Application class and registers
 * an action hook to be executed when the plugins are loaded. Inside the action hook, the 'fluentMail_loaded'
 * action is triggered with the application instance as a parameter.
 *
 * @since 1.0.0
 */
function fluentSmtpInit() {
    $application = new FluentMail\Includes\Core\Application;
    add_action('plugins_loaded', function () use ($application) {
        do_action('fluentMail_loaded', $application);
    });
}

fluentSmtpInit();

if (!function_exists('wp_mail')):
    function wp_mail($to, $subject, $message, $headers = '', $attachments = array()) {
        return fluentMailSend($to, $subject, $message, $headers, $attachments);
    }
 else :
    if (!(defined('DOING_AJAX') && DOING_AJAX)):
        add_action('init', 'fluentMailFuncCouldNotBeLoadedRecheckPluginsLoad');
    endif;
endif;

/*
 * Thanks for checking the source code
 * Please check the full source here: https://github.com/WPManageNinja/fluent-smtp
 * Would love to welcome your pull request
*/
