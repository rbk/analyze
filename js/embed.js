// NOT USING
!(function(){
	var m = document.getElementById('live-embed');
	var domain = m.getAttribute('domain');
	var iframe = document.createElement('iframe');
	iframe.src='http://localhost/sotest/embed.php';
	iframe.setAttribute('seamless','');
	iframe.setAttribute('domain',domain);
	m.parentNode.insertBefore(iframe, m.nextSibling);
	iframe.setAttribute('style','height:0;width:0;border:0;'); 
})();