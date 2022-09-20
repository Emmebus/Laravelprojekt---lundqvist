<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
      //Funktion som körs när knappen "sumbit" trycks och request skickas
      public function imgEdit(Request $requestVar){

            //Hämtar ut filen från requesten och lagrar i variabel
            $imgFile = $requestVar->file('fileToUpload');

            //hämtar namn från bildfilen och lagrar i variabel
            $imgName = $imgFile->getClientOriginalName();
            //dd($imgName);

            //gör bildfilen till en bild och lagrar i variabel
            $image = Image::make($imgFile);
            $logo = "imgStore/lund-logo.png";

            $image->fit(538);
            $image->insert($logo);







            //sparar en encodade bilden i mappen public/ImgStore samt ger bilden ett namn.
            $image->save(public_path("imgStore/" . $imgName));

            //skicka tillbaka en view, som ser ut som koden i filen inom "". I den filen kan du använda variabel inom '' som har med sig informationen efter => (som hämtasi denna fil)
            return view("display",['image'=>$imgName]);

      }
}