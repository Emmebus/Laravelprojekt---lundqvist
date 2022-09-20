<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add Logo app</title>
       
        <link rel="stylesheet" href="CSS/mystyle.css">

    </head>
    <body>

    <h1>Add logo app</h1>

    <form action="/addLogo" method="post" enctype="multipart/form-data">
        <p>upload picture</p>    
            <input type="file" name="fileToUpload" id="fileToUpload" style="border:solid"><br><br>
            <input type="submit" value="Upload Image" name="submit">
    </form>

    </body>
</html>
