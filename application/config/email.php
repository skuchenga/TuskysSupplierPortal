<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  $config['charset'] = 'iso-8859-1';
  $config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
  $config['mailpath'] = '';
  $config['smtp_host'] = '192.168.150.238';// SMTP Server Address.
  $config['smtp_user'] = 'peninah.kabura@tuskys.com'; // SMTP Username.
  $config['smtp_pass'] = 'P3n1n4h01'; // SMTP Password.
  $config['smtp_port'] = '25';// SMTP Port.
  $config['wordwrap'] = TRUE;
  $config['priority'] = 1; // 1, 2, 3, 4, 5    Email Priority. 1 = highest. 5 = lowest. 3 = normal.
  $config['crlf'] = '\r\n'; // "\r\n" or "\n" or "\r" Newline character. (Use "\r\n" to comply with RFC 822).
  $config['newline'] = '\r\n'; // "\r\n" or "\n" or "\r"    Newline character. (Use "\r\n" to comply with RFC 822).     
  $config['mailtype'] = 'html';