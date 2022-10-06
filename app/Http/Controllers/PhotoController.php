<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function photoEdit(Request $requestVar){

    //Hämtar ut data från request och lagrar i variabel
    $imgFile = $requestVar->uploadedImg;
    
    $width = $requestVar->width;
    $width = (int) $width;
    
    $height = $requestVar->height;
    $height = (int) $height;
    
    $color = $requestVar->color;
    $color = strtolower($color);
    
    $position = $requestVar->position;
    $position = strtolower($position);
    
    $token = $requestVar->bearerToken();


//error prevention och koll av värden innan redigering börjar:
        
        //kollar om token är korrekt
        //hårdkodat i detta fall men $security variabel bör rimligtvis motsvara en lista på alla godkända nycklar i en databas.
        $security = "PASSWORD123";
        if ($token !== $security) {
            return response()->json(["error"=>"invalid token"], 401);
        };

        if ($width < 1) {
            return response()->json(["error"=>"invalid width value"], 400);
        }        
        
        if ($height <= 0) {
            return response()->json(["error"=>"invalid height value"], 400);
        }

//slut på error prevetiont



//redigering av bild:
            
        //gör bildfilen till en bild och lagrar i variabel
            $image = Image::make($imgFile);
            
            //Storlek på bild:
            //låser aspect ration:
            $image->resize($width, $height, function ($constraint) {  
                $constraint->aspectRatio(); 
            });

            //låser ej aspect ration:
            //$image->resize($width, $height);

            //Val av vit eller svart logotyp:
            if ($color === "w" or $color === "white") {
                //länk till vit logotyp
                $logo = Image::make("imgStore/logo-w.png");
             } else {
                //länk till svart logotyp
                $logo = Image::make("imgStore/logo-b.png");
             };

             $logosize = ceil($width/3);
             $logo->resize($logosize, null, function ($constraint) {  
                $constraint->aspectRatio(); 
            });

            //$position tillåter endast: 'top-left' 'top' 'top-right' 'left' 'center' 'right' 'bottom-left' 'bottom' 'bottom-right' 
             $image->insert($logo, $position);

//slut på redigering


//skicka tillbaka redigerad bild:

            //hämtar namn från bildfilen och lagrar i variabel
            $imgName = $imgFile->getClientOriginalName();

            //sparar en encodade bilden i mappen public i storage samt ger bilden ett namn.
            $image->save(storage_path("app/public/" . $imgName));


        //skicka tillbaka ett respons, som görs till en json fil
        return response()->json([asset("storage") . "/" . $imgName]);

      }
}
