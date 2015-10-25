@extends('app')

@section('title')
	Last opp
@stop

@section('content')
	@if(Session::has('success'))
		<h2 style='color:green;'>{!! Session::get('success') !!}</h2>
	@endif
	@if(Session::has('error'))
		<h2 style='color:red;'>{!! Session::get('error') !!}</h2>
	@endif

	<h1>Last opp bilder fra din datamaskin:</h1>
	<!-- Upload Form -->
	{!! Form::open(array('url'=>'computer/upload','method'=>'POST', 'files'=>true)) !!}
	{!! Form::file('file') !!}
	<br/>
	{!! Form::submit('Hent bilde') !!}
	{!! Form::close() !!}

	<!-- Instagram Images Form -->
	<h1>Hent bilder fra din instagram:</h1>
	{!! Form::open(array('url'=>'https://api.instagram.com/oauth/authorize/?client_id=a1a34c81a46c48df9cae0d0509459d5d&redirect_uri=http://localhost:1337/upload&response_type=code','method'=>'POST')) !!}
	{!! Form::submit('Hent bilder') !!}
	{!! Form::close() !!}

	<?php
		/* GET ACCESS TOKEN AND USER ID FOR INSTAGRAM 
			**********************************************/
		if (isset($_GET['code'])) {
			$code = $_GET['code'];
			$clientSecret = 'e317d43e42d24c1dbc7af1ef1b2702d7';
			$clientId = 'a1a34c81a46c48df9cae0d0509459d5d';
			$url = 'https://api.instagram.com/oauth/access_token';

			$data = array(
				'client_id' => $clientId,
				'client_secret' => $clientSecret,
				'grant_type' => 'authorization_code',
				'redirect_uri' => 'http://localhost:1337/upload',
				'code' => $code
			);

			$options = array(
			    'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($data),
			    ),
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);

			// Get the access token and user ID from the JSON result
			$fromJson = json_decode($result);
			$accessToken = $fromJson->{'access_token'};
			$userId = $fromJson->{'user'}->{'id'};
			$userName = $fromJson->{'user'}->{'username'};
		}
	?>
	
	<?php if(isset($userId)) { ?>
		<!-- Instafeed.js (with custom code by Hjemmeoppgave) -->
		<script type="text/javascript" src="/instafeed.min.js"></script>

		<script>
	    var userFeed = new Instafeed({
	        get: 'user',
	        userId: <?php echo $userId; ?>,
	        accessToken: '<?php echo $accessToken; ?>',
	        resolution: 'standard_resolution',
	        limit: 30,
	        sortBy: 'most-recent',
	        template: '<div class="col-md-3"><a href="/instagram/upload?fileName={image}" onclick=\"return confirm(\'Er du sikker på at du vil laste opp dette bildet?\')\"><img class="img-responsive" src="{image}" /></a></div>'
	    });
	    userFeed.run();
		</script>

		<!-- Users Instagram images -->
		<h2>Hei <?php echo $userName; ?>!</h2> 
		<h3 style="color:orange;">Trykk på et av bildene dine under så lagres dette hos oss.</h3>
		<div id="instafeed" class="row"></div>
	<?php } ?>
@stop