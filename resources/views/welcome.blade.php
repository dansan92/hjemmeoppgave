<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5 - Hjemmeoppgave</div>
                <h3>Utført av Daniel Sandnes</h3>
                @if(Session::has('error'))
                    <h2 style='color:red;'>{!! Session::get('error') !!}</h2>
                @endif
                <br/>

                <!-- Navigation -->
                <?php if (!Auth::check()) { ?>
                <h1><a href="/auth/register">Registrer</a><br/></h1>
                <h1><a href="/auth/login">Logg inn</a><br/></h1>
                <?php } if (Auth::check()) { ?>
                <h1><a href="/auth/logout">Logg ut</a><br/></h1>
                <h1><a href="/upload">Last opp</a><br/></h1>
                <?php 
                $user = Auth::user();
                $user = DB::table('users')->where('email', $user->email)->first();
                if ($user->role == 'admin') { ?>
                <h1><a href="/controlpanel">Kontrollpanel</a><br/></h1>
                <?php } } ?>
                <br/>

                <!-- Verified images -->
                <h2>Verifiserte Bilder:</h2>
                <?php
                    $images = '';

                    // Create directory 'verified-images' and 'unverified-images', to avoid crash on first time load
                    if(!File::exists('verified-images/'))
                        File::makeDirectory('verified-images/');
                    if(!File::exists('unverified-images/'))
                        File::makeDirectory('unverified-images/');

                    // Find all files in folder 'verified-images'
                    foreach (File::allFiles('verified-images/') as $file) 
                    {
                        // Get the file name with extension
                        $fileName = $file->getRelativePathName();

                        // Get the name without extension
                        $fileNameTrims = explode('.',$fileName);
                        $fileNameTrim = '';
                        for ($i = 0; $i < sizeof($fileNameTrims) - 1; $i++)
                            $fileNameTrim .= $fileNameTrims[$i];

                        // Get the path of the image
                        $filePath = 'verified-images/'.$fileName;

                        // Create string of all images, with class name 'image'
                        $images .= Html::image($filePath, $fileNameTrim, array( 'class' => 'image' ));
                    }

                    // Output the string of images, with inline style for class 'image'
                    echo "<style>.image { border:1px solid #ddd; max-width:300px; max-height:300px; margin:3px; }</style><htm><body>$images</body></htm>";
                ?>
            </div>
        </div>
    </body>
</html>
