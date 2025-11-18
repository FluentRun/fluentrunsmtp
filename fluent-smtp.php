<?php
/*
Plugin Name:  FluentRunSMTP
Plugin URI:   https://east.webmakerr.com
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

add_action('init', 'fluentSmtpInitUpdater', 8);

function fluentSmtpInitUpdater()
{
    if (!class_exists('\\FluentMail\\Updater\\FluentLicensing')) {
        require_once plugin_dir_path(__FILE__) . 'updater/FluentLicensing.php';
    }

    if (!class_exists('\\FluentMail\\Updater\\LicenseSettings')) {
        require_once plugin_dir_path(__FILE__) . 'updater/LicenseSettings.php';
    }

    try {
        $licensing = (new \FluentMail\Updater\FluentLicensing())->register(apply_filters('fluentsmtp_updater_config', [
            'version'  => FLUENTMAIL_PLUGIN_VERSION,
            'item_id'  => '1649',
            'basename' => plugin_basename(FLUENTMAIL_PLUGIN_FILE),
            'api_url'  => 'https://east.webmakerr.com/',
        ]));
    } catch (\Exception $exception) {
        error_log('FluentSMTP updater initialization failed: ' . $exception->getMessage());
        return;
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
        ->setConfig([
            'title' => 'FluentSMTP License Settings'
        ])
        ->addPage([
            'type'      => 'options',
            'menu_slug' => 'fluentsmtp-license',
        ]);
}

add_filter('http_request_args', 'fluentSmtpBlockWpOrgUpdates', 10, 2);
function fluentSmtpBlockWpOrgUpdates($args, $url)
{
    if (strpos($url, 'api.wordpress.org/plugins/update-check') === false) {
        return $args;
    }

    if (empty($args['body']['plugins'])) {
        return $args;
    }

    $plugins = json_decode($args['body']['plugins'], true);

    if (isset($plugins['plugins']['fluentrunsmtp/fluent-smtp.php'])) {
        unset($plugins['plugins']['fluentrunsmtp/fluent-smtp.php']);
    }

    if (isset($plugins['active']) && is_array($plugins['active'])) {
        $plugins['active'] = array_values(array_filter($plugins['active'], function ($plugin) {
            return $plugin !== 'fluentrunsmtp/fluent-smtp.php';
        }));
    }

    $args['body']['plugins'] = wp_json_encode($plugins);

    return $args;
}

function fluentSmtpCurrentLicenseStatus()
{
    if (!class_exists('\\FluentMail\\Updater\\FluentLicensing')) {
        return [
            'status' => 'unregistered'
        ];
    }

    try {
        $licensing = \FluentMail\Updater\FluentLicensing::getInstance();
    } catch (\Exception $exception) {
        return [
            'status'         => 'unregistered',
            'error_message'  => $exception->getMessage(),
            'error_instance' => true
        ];
    }

    $status = $licensing->getStatus();

    if (is_wp_error($status)) {
        return [
            'status'        => 'error',
            'error_message' => $status->get_error_message()
        ];
    }

    return $status;
}

function fluentSmtpHasValidLicense()
{
    $status = fluentSmtpCurrentLicenseStatus();

    return isset($status['status']) && $status['status'] === 'valid';
}

add_action('admin_init', 'fluentSmtpEnforceLicenseUi');
function fluentSmtpEnforceLicenseUi()
{
    if (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
        return;
    }

    if (fluentSmtpHasValidLicense()) {
        return;
    }

    $page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
    $pluginPages = apply_filters('fluentsmtp_restricted_pages', ['fluent-mail']);

    if (empty($page) || !in_array($page, (array)$pluginPages, true)) {
        return;
    }

    if ($page === 'fluentsmtp-license') {
        return;
    }

    if (!empty($page) && strpos($page, 'license') !== false) {
        return;
    }

    wp_safe_redirect(admin_url('options-general.php?page=fluentsmtp-license'));
    exit;
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
