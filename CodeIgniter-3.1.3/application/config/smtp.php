<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * --------------------------------------------------------------------
 * SMTP SETTINGS.
 * --------------------------------------------------------------------
 *
 * This configuration is used for the smtp settings.
 *
 * EXPLANATION:
 *
 * ['mail_protocol']    = The mailing protocol. (smtp).
 * ['mail_host']        = The domain name for the smtp service.
 * ['mail_user']        = The smtp user name.
 * ['mail_pass']        = The password for the smtp user.
 * ['mail_port']        = The port where the smtp service run on.
 * ['mail_auth']        = Authencation for the smtp service .(can only be true or false).
 */

$config['mail_protocol'] = 'smtp';
$config['mail_host']     = '';
$config['mail_user']     = '';
$config['mail_pass']     = '';
$config['mail_port']     = 25;
$config['mail_auth']     = true;
