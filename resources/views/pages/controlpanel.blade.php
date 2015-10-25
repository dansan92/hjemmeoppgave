@extends('app')

@section('title')
    Kontrollpanel
@stop

@section('content')

    <?php
        /* CONTROL PANEL
        * Control panel is only accessible by admins and is used to approve/decline uploaded images by users.
        *****************************************************************************************************/
    ?>

	<h1>Kontrollpanel</h1>
	<p>Her kan administrator verifisere bildene før de vises på forsiden.</p>
	<h2>Uverifiserte Bilder...</h2>

	@if(Session::has('success'))
		<h2 style='color:green;'>{!! Session::get('success') !!}</h2>
	@endif
	@if(Session::has('error'))
		<h2 style='color:red;'>{!! Session::get('error') !!}</h2>
	@endif

	<?php
		$images = '';

		// Find all files in folder 'unverified-images'
        foreach (File::allFiles('unverified-images/') as $file) 
        {
        	// Get the file name with its extension
            $fileName = $file->getRelativePathName();

            // Get the file name without extension
            $fileNameTrims = explode('.',$fileName);
            $fileNameTrim = '';
            for ($i = 0; $i < sizeof($fileNameTrims) - 1; $i++)
            	$fileNameTrim .= $fileNameTrims[$i];

            // Get the path of the file
            $filePath = 'unverified-images/'.$fileName;

            // Create a string of all files and add a approve/decline link below each one (with Bootstrap classes)
            $images .= '<div class="col-md-3">'.Html::image($filePath, $fileNameTrim, array( 'class' => 'img-responsive')).
            '<br/><a href="/approve/upload?fileName='.$fileName.'">Godkjenn</a>'.
            '<br/><a href="/decline/upload?fileName='.$fileName.'">Avslå</a><br/></div>';
        }

        // Output the string of images, with custom style
        echo "<style>.img-responsive { border:1px solid #ddd; margin:3px; max-height:300px; }</style><div class='row'>$images</div>\n";
	?>


@stop