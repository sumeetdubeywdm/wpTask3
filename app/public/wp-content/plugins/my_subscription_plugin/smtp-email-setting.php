<?php
// SMTP email settings 
define( 'SMTP_USER', get_option( 'smtp_user' ) );
define( 'SMTP_PASS', get_option( 'smtp_pass' ) );
define( 'SMTP_HOST', get_option( 'smtp_host' ) );
define( 'SMTP_FROM', get_option( 'smtp_from' ) );
define( 'SMTP_NAME', get_option( 'smtp_name' ) );
define( 'SMTP_PORT', get_option( 'smtp_port' ) );
define( 'SMTP_SECURE', get_option( 'smtp_secure' ) );
define( 'SMTP_AUTH', (bool) get_option( 'smtp_auth' ) );