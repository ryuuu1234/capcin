<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Pusher Test</title>

	<!--
	This example view uses the Pusher Javascript SDK to subscribe
	on new events. https://github.com/pusher/pusher-js
	-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
	<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
</head>
<body>

	<script type="text/javascript">
	$(document).ready(function(){
	 // Enable pusher logging - don't include this in production
	 Pusher.logToConsole = true;
 
		var pusher = new Pusher('c1b487e073e0124e259f', {
			cluster: 'ap1',
			forceTLS: true
		});

		var channel = pusher.subscribe('my-channel');
		channel.bind('my-event', function(data) {
			if(data.message === 'success'){
				alert(data.message);
			}
		});
		// Enable pusher logging - don't include this in production
	});	
	</script>

	<p id="event">Waiting on event...</p>
	<p>Go to <strong><a href="/example/trigger_event" target="_blank">/example/trigger_event</a></strong> in a new tab to trigger event.</p>

</body>
</html>
