<?php 
  header('Access-Control-Allow-Origin: *');
  session_start();
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
  $user = array(
    'id'      => $_COOKIE['PHPSESSID'],
    'ip'      => $ip,
    'agent'   => $HTTP_USER_AGENT,
    'time'    => $REQUEST_TIME_FLOAT,
    'scheme'  => $REQUEST_SCHEME,
    'host'    => '',
    'url'     => '',
    'city'    => '',
    'state'   => '',
    'lat'     => '',
    'lng'     => '',
    'screen_dimensions' => '',
    'browser_dimensions' => ''
  );
  $user = json_encode($user);
?>
<script src="<?php echo base_url; ?>/js/build/client.min.js"></script>
<script>
  var user = <?php echo $user; ?>;

  var url = document.referrer;
  var tmp = document.createElement('a');
  tmp.href = url;
  var host = tmp.hostname;

  user.host = host;
  user.url = url;
  user.screen_dimensions = screen.width + ' x ' + screen.height;
  user.browser_dimensions = window.outerWidth + ' x ' + window.outerHeight;

  console.log( user );

  var socket = io('<?php echo io_url; ?>');
  socket.on('connect', function () {
    socket.emit('client-info', user);
  });
  </script>
