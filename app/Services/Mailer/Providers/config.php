<?php

return [
    'connections' => [],
    'mappings'    => [],
    'providers'   => [
        'smtp'        => [
            'key'      => 'smtp',
            'title'    => __('SMTP server', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-smtp.svg'),
            'provider' => 'Smtp',
            'need_pro' => 'no',
            'is_smtp'  => true,
            'options'  => [
                'sender_name'      => '',
                'sender_email'     => '',
                'force_from_name'  => 'no',
                'force_from_email' => 'yes',
                'return_path'      => 'yes',
                'host'             => '',
                'port'             => '',
                'auth'             => 'yes',
                'username'         => '',
                'password'         => '',
                'auto_tls'         => 'yes',
                'encryption'       => 'none',
                'key_store'        => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/set-up-fluent-smtp-with-any-host-or-mailer/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure any SMTP with FluentSMTP.', 'websmtp')
        ],
        'ses'         => [
            'key'      => 'ses',
            'title'    => __('Amazon SES', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-aws-ses.svg'),
            'provider' => 'AmazonSes',
            'options'  => [
                'sender_name'      => '',
                'sender_email'     => '',
                'force_from_name'  => 'no',
                'force_from_email' => 'yes',
                'return_path'      => 'yes',
                'access_key'       => '',
                'secret_key'       => '',
                'region'           => 'us-east-1',
                'key_store'        => 'db'
            ],
            'regions'  => [
                'us-east-1'      => __('US East (N. Virginia)', 'websmtp'),
                'us-east-2'      => __('US East (Ohio)', 'websmtp'),
                'us-west-1'      => __('US West (N. California)', 'websmtp'),
                'us-west-2'      => __('US West (Oregon)', 'websmtp'),
                'ca-central-1'   => __('Canada (Central)', 'websmtp'),
                'eu-west-1'      => __('EU (Ireland)', 'websmtp'),
                'eu-west-2'      => __('EU (London)', 'websmtp'),
                'eu-west-3'      => __('Europe (Paris)', 'websmtp'),
                'eu-central-1'   => __('EU (Frankfurt)', 'websmtp'),
                'eu-south-1'     => __('Europe (Milan)', 'websmtp'),
                'eu-north-1'     => __('Europe (Stockholm)', 'websmtp'),
                'ap-south-1'     => __('Asia Pacific (Mumbai)', 'websmtp'),
                'ap-northeast-2' => __('Asia Pacific (Seoul)', 'websmtp'),
                'ap-southeast-1' => __('Asia Pacific (Singapore)', 'websmtp'),
                'ap-southeast-2' => __('Asia Pacific (Sydney)', 'websmtp'),
                'ap-northeast-1' => __('Asia Pacific (Tokyo)', 'websmtp'),
                'ap-northeast-3' => __('Asia Pacific (Osaka)', 'websmtp'),
                'sa-east-1'      => __('South America (São Paulo)', 'websmtp'),
                'me-south-1'     => __('Middle East (Bahrain)', 'websmtp'),
                'us-gov-west-1'  => __('AWS GovCloud (US)', 'websmtp'),
                'af-south-1'     => __('Africa (Cape Town)', 'websmtp'),
                'cn-northwest-1' => __('China (Ningxia)', 'websmtp')
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/set-up-amazon-ses-in-fluent-smtp/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure Amazon SES with FluentSMTP.', 'websmtp')
        ],
        'mailgun'     => [
            'key'      => 'mailgun',
            'title'    => __('Mailgun', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-mailgun.svg'),
            'provider' => 'Mailgun',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'return_path'     => 'yes',
                'api_key'         => '',
                'domain_name'     => '',
                'key_store'       => 'db',
                'region'          => 'us'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/configure-mailgun-in-fluent-smtp-to-send-emails/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure Mailgun with FluentSMTP.', 'websmtp')
        ],
        'sendgrid'    => [
            'key'      => 'sendgrid',
            'title'    => __('SendGrid', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-sendgrid.svg'),
            'provider' => 'SendGrid',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'api_key'         => '',
                'key_store'       => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/set-up-the-sendgrid-driver-in-fluent-smtp/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure SendGrid with FluentSMTP.', 'websmtp')
        ],
        'sendinblue'  => [
            'key'      => 'sendinblue',
            'title'    => __('Sendinblue', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-sendinblue.svg'),
            'provider' => 'SendInBlue',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'api_key'         => '',
                'key_store'       => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/setting-up-sendinblue-mailer-in-fluent-smtp/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure Sendinblue with FluentSMTP.', 'websmtp')
        ],
        'sparkpost'   => [
            'key'      => 'sparkpost',
            'title'    => __('SparkPost', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-sparkpost.svg'),
            'provider' => 'SparkPost',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'api_key'         => '',
                'key_store'       => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/configure-sparkpost-in-fluent-smtp-to-send-emails/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure SparkPost with FluentSMTP.', 'websmtp')
        ],
        'pepipost'    => [
            'key'      => 'pepipost',
            'title'    => __('Netcore Email API, formerly Pepipost', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-netcore.svg'),
            'provider' => 'PepiPost',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'api_key'         => '',
                'key_store'       => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/set-up-the-pepipost-mailer-in-fluent-smtp/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure Netcore (formerly Pepipost) with FluentSMTP.', 'websmtp')
        ],
        'postmark'    => [
            'key'      => 'postmark',
            'title'    => __('Postmark', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-postmark.svg'),
            'provider' => 'Postmark',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'track_opens'     => 'no',
                'track_links'     => 'no',
                'api_key'         => '',
                'message_stream'  => 'outbound',
                'key_store'       => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/configure-postmark-in-fluent-smtp-to-send-emails/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure Postmark with FluentSMTP.', 'websmtp')
        ],
        'elasticmail' => [
            'key'      => 'elasticmail',
            'title'    => __('Elastic Email', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-elastic-email.svg'),
            'provider' => 'ElasticMail',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'api_key'         => '',
                'mail_type'       => 'transactional',
                'key_store'       => 'db'
            ],
            'note'     => '<a href="https://fluentsmtp.com/docs/configure-elastic-email-in-fluent-smtp/" target="_blank" rel="noopener">' . __('Read the documentation', 'websmtp') . '</a>' . __(' for how to configure Elastic Email with FluentSMTP.', 'websmtp')
        ],
        'smtp2go'    => [
          'key'      => 'smtp2go',
          'title'    => __('SMTP2GO', 'websmtp'),
          'image'    => fluentMailAssetUrl('images/provider-smtp2go.svg'),
          'provider' => 'Smtp2Go',
          'options'  => [
            'sender_name'     => '',
            'sender_email'    => '',
            'force_from_name' => 'no',
            'api_key'         => '',
            'key_store'       => 'db'
          ]
        ],
        'gmail'       => [
            'key'      => 'gmail',
            'title'    => __('Gmail or Google Workspace', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-gmail-google-workspace.svg'),
            'provider' => 'Gmail',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'return_path'     => 'yes',
                'key_store'       => 'db',
                'client_id'       => '',
                'client_secret'   => '',
                'auth_token'      => '',
                'access_token'    => '',
                'refresh_token'   => ''
            ],
            'note'     => __('Gmail/Google Workspace is not recommended for sending mass marketing emails.', 'websmtp')
        ],
        'outlook'     => [
            'key'      => 'outlook',
            'title'    => __('Outlook or Office 365', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-microsoft.svg'),
            'provider' => 'Outlook',
            'options'  => [
                'sender_name'     => '',
                'sender_email'    => '',
                'force_from_name' => 'no',
                'return_path'     => 'yes',
                'key_store'       => 'db',
                'client_id'       => '',
                'client_secret'   => '',
                'auth_token'      => '',
                'access_token'    => '',
                'refresh_token'   => ''
            ],
            'note'     => __('Outlook/Office365 is not recommended for sending mass marketing emails.', 'websmtp')
        ],
        'default'     => [
            'key'      => 'default',
            'title'    => __('PHP mail()', 'websmtp'),
            'image'    => fluentMailAssetUrl('images/provider-php.svg'),
            'provider' => 'DefaultMail',
            'options'  => [
                'sender_name'      => '',
                'sender_email'     => '',
                'force_from_name'  => 'no',
                'force_from_email' => 'yes',
                'return_path'      => 'yes',
                'key_store'        => 'db'
            ],
            'note'     => __('The Default option does not use SMTP or any Email Service Providers so it will not improve email delivery on your site.', 'websmtp')
        ],
    ],
    'misc'        => [
        'log_emails'              => 'yes',
        'log_saved_interval_days' => '14',
        'disable_fluentcrm_logs'  => 'no',
        'default_connection'      => '',
        'fallback_connection'     => ''
    ]
];
