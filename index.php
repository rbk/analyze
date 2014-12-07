<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" href="css/app.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="js/build/production.min.js"></script>
</head>
<body>
	
<script src="<?php echo base_url; ?>/node_modules/socket.io-client/socket.io.js"></script>
<nav class="nav">
	<div class="pagename">Analyze</div>
	<a target="_blank" href="<?php echo base_url; ?>/testing/test.php">Test URL</a>
	<a target="_blank" href="<?php echo base_url; ?>/testing/stress-test.php">Stress Test</a>
</nav>
		
<div class="row">
	<div class="col c3">
		<div id="total-connections" class="widget center">
			<div class="widget-title">Number of Connections</div>
			<div class="widget-body">
				<div id="connection-count"></div>
			</div>
		</div>
		<div id="domains" class="widget">
			<div class="widget-title">Active Domains</div>
			<div id="domains-list">
				<div class="domain">localhost	<span>0</span></div><hr>
			</div>
		</div>
		<div id="top-pages" class="widget center">
			<div class="widget-title">Top Pages</div>
			<!-- <div class="widget-body">
				<div>http://localhost/sotest/test.html</div>
				<div>http://localhost/sotest/test2.html</div>
				<div>http://localhost/sotest/test3.html</div>
			</div> -->
		</div>
		<div id="average-time" class="widget center">
			<div class="widget-title">Average Time On Page</div>
			<!-- <div class="widget-body">
				<div id="avg">12.2s</div>
			</div> -->
		</div>
		<div class="widget">
			<div class="widget-title">Embed</div>
			<div class="widget-body">
				<textarea name="embed-code" id="embed-code" rows="5"><iframe src="<?php echo base_url; ?>/embed.php" height="0" width="0"></iframe>
				</textarea>
			</div>
		</div>
	</div>

	<div class="col c9">
		<div id="connection-table" class="widget">
			<div class="widget-title">Generic Table</div>
			<div class="widget-body">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>URL</th>
							<th>Domain</th>
							<th>IP</th>
							<th>Location</th>
						</tr>
					</thead>
					<tbody id="table-data">
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="json-widget" class="widget center">
			<div class="widget-title">JSON Output</div>
			<div class="widget-body" style="text-align:left;"><pre id="json"></pre></div>	
		</div>
		
	</div>
	<div class="cf"></div>
</div>


<script>
	$(function(){

 //  var socket = io('http://localhost:3000');
	var socket = io('<?php echo io_url; ?>');

  socket.on('connect', function(){
		socket.on('clients', function(clients){
			var count = clients.length;
			document.getElementById('connection-count').innerHTML = count;
			document.getElementById('json').innerHTML = JSON.stringify(clients, null, 2);
			// console.log( clients )

			$('#table-data').html('');
			$.each( clients, function(index, obj){
				// console.log(obj);
				var string = $('#table-data-template').html();
				string = string.replace('{{id}}', obj.id.substring(0,4));
				string = string.replace('{{url}}', obj.url);
				string = string.replace('{{host}}', obj.host);
				string = string.replace('{{ip}}', obj.ip);
				string = string.replace('{{location}}', obj.city + ', ' + obj.state);
				$('#table-data').append( string )

			});
			var domains = [];
			// var clients = [
			//   {"host": "otherhost"},
			//   {"host": "localhost"},
			//   {"host": "localhost"},
			//   {"host": "gurustudev.com"},
			//   {"host": "gurustudev.com"},
			//   {"host": "gurustudev.com"}
			// ]
			// console.log( clients );
			$.each( clients, function(index,obj){
				domains[obj.host] = [];
			});
			$.each( clients, function(index,obj){
				domains[obj.host].push(obj);
			});

			// console.log( domains );
			$('#domains-list').html('');
			for( key in domains ){
				// console.log( domains[key] )
				var domain_template = $('#domain-list-template').html();
				domain_template = domain_template.replace('{{host}}', key );
				domain_template = domain_template.replace('{{count}}', domains[key].length );
				$('#domains-list').append( domain_template );	
			}
		});  		
	});


	});
</script>
<script type="text/template" id="domain-list-template">
<div class="domain">{{host}}	<span>{{count}}</span></div><hr>
</script>

<script type="text/template" id="table-data-template">
	<tr>
		<td>{{id}}</td>
		<td>{{url}}</td>
		<td>{{host}}</td>
		<td>{{ip}}</td>
		<td>{{location}}</td>
	</tr>
</script>




	
</body>
</html>
