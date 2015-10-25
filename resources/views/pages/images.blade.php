@extends('app')

@section('title')
	Bilder
@stop

@section('content')
	<h1>Verifiserte bilder:</h1>
	<?php
		$images = '';
		foreach (File::allFiles('verified-images/') as $file) {
			$filename = $file->getRelativePathName();
			$images .= Html::image('verified-images/'.$filename, $filename, array( 'class' => 'image' ));
		}

		echo  "<html><body><style>.image { border:1px solid #eee; max-width:300px; max-height:300px; margin:3px; }</style>$images</body></html>";
	?>
@stop