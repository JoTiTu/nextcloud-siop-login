<?php
$CONFIG = array (
  'apps_paths' => 
    array (
      0 => 
      array (
        'path' => '/var/www/html/apps',
        'url' => '/apps',
        'writable' => false,
      ),
      1 => 
      array (
        'path' => '/var/www/html/custom_apps',
        'url' => '/custom_apps',
        'writable' => true,
      ),
    ),
  'trusted_domains' => 
    array (
      0 => 'localhost:8080',
      1 => '*.ngrok.io',
      2 => 'desktop.local.fcloud.ovh',
  ),
  'memcache.local' => '\OC\Memcache\APCu',
  'overwriteprotocol' => 'https',
  'oidc_login_button_text' => 'Log in with Wallet App',
  'oidc_login_auto_redirect' => false,
  'oidc_login_redir_fallback' => false,
  'oidc_login_hide_password_form' => false,
  'oidc_login_attributes' => 
    array (
        'id' => 'email',
        'mail' => 'email'
    ),
  'oidc_login_join_attributes' =>
    array(
      'name' => array('first_name', 'last_name', 'givenName', 'familyName'),
  ),
  'oidc_login_anoncred_config' => array(
    'did:indy:idu:test:BafYMQUtA7mm3bYY2rmMiZ:2:verified-email:1.2.3' => array(
      'email', 'time'
    ),
  ),
  'oidc_login_jsonld_config' => array(
    'type' => 'NextcloudCredential',
    'claims' => array(
      'email', 'givenName', 'familyName'
    ),
    'verifier_uri' => 'http://verification-service:3000',
    'verifier_access_token' => 'sdzaZdlsOD50VuI8XwIFF8JaEq4gID'
  ),
  'oidc_create_groups' => true,
  'oidc_login_disable_registration' => false,
  'oidc_login_tls_verify' => true,
  'oidc_login_code_challenge_method' => 'S256',
  'debug' => true,
  'loglevel' => '0',
);