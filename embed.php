<?php 

  header('Access-Control-Allow-Origin: *');
  require 'config.php';

  if( !isset($_SERVER['HTTP_REFERER']) )
    die();

  if( !@get_headers( io_url ) )
    die();

  extract( $_SERVER );

  $ip = getenv('HTTP_CLIENT_IP')?:
  getenv('HTTP_X_FORWARDED_FOR')?:
  getenv('HTTP_X_FORWARDED')?:
  getenv('HTTP_FORWARDED_FOR')?:
  getenv('HTTP_FORWARDED')?:
  getenv('REMOTE_ADDR');
  error_log( ip2long($ip) );
  $user = array(
    'ip'      => $ip,
    'id'      => $_COOKIE['PHPSESSID'],
    'agent'   => $HTTP_USER_AGENT,
    'time'    => $REQUEST_TIME_FLOAT,
    'scheme'  => $REQUEST_SCHEME,
    'host'    => $HTTP_HOST,
    'url'     => $HTTP_REFERER,
    'city'    => '',
    'state'   => '',
    'lat'     => '',
    'lng'     => ''
  );
  $user = json_encode($user);
?>
<script src="<?php echo base_url; ?>/js/build/client.min.js"></script>
<script>var socket = io('<?php echo io_url; ?>');socket.on('connect', function () {socket.emit('client-info', <?php echo $user; ?>);});</script>
