<!DOCTYPE html>
<html>
<head>
	<meta chartset="UTF-8">
	<title>@yield('title')</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<!-- Navigation menu -->
		<div class="header" style="font-size:24px;margin-right:20px;">
			<a href="/">Hjem</a>
			| <a href="/about">Om Daniel</a>
			| <a href="/images">Verifiserte bilder</a>
			<?php if (!Auth::check()) { ?>
				| <a href="/auth/login">Logg inn</a>
				| <a href="/auth/register">Registrer</a>
			<?php } else { ?>
				| <a href="/upload">Last opp</a>
				<?php 
				$user = Auth::user();
	            $user = DB::table('users')->where('email', $user->email)->first();
	            if ($user->role == 'admin') { ?>
					| <a href="/controlpanel">Kontrollpanel</a>
				<?php } ?>
				| <a href="/auth/logout">Logg ut</a>
			<?php } ?>
		</div>
		<br/>
		<!-- Main content -->
		@yield('content')
	</div>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>