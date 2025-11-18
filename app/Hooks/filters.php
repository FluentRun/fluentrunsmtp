<?php


add_filter('fluent_crm/quick_links', function ($links) {
    $links[] = [
        'title' => __('SMTP/Mail Settings', 'websmtp'),
        'url'   => admin_url('options-general.php?page=fluent-mail#/')
    ];

    return $links;
});

add_filter( 'plugin_action_links_' . plugin_basename( FLUENTMAIL_PLUGIN_FILE ), function ($links) {
    $links['settings'] = sprintf(
        '<a href="%s" aria-label="%s">%s</a>',
        admin_url('options-general.php?page=fluent-mail#/connections'),
        esc_attr__( 'Go to Fluent SMTP Settings page', 'websmtp' ),
        esc_html__( 'Settings', 'websmtp' )
    );
    return $links;
}, 10, 1 );
