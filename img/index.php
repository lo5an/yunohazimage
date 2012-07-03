<?php 

//http://motyar.blogspot.com/2010/09/create-image-placeholder-with-php.html


if(isset($_GET)){
    $imagedata = explode('x',$_GET['data']); 

    if (!is_array($imagedata) 
      || count($imagedata) != 2 
      || !is_numeric($imagedata[0]) 
      || !is_numeric($imagedata[1])){
      die("URL should be something like http://yunohaz.vlrst.com/img/350x350");
    }
    create_image($imagedata[0],
                 $imagedata[1]);
    exit;
}


function create_image($width, $height)
{

    $yunoguy = imagecreatefrompng("yuno.png");
    $image = imagecreatetruecolor($width, $height);
    $text1 = "Y U NO HAZ ";
    $text2 = $width ."x".$height. " IMAGE ?!?";


    // set the background to white
    // sets background to red
    $white  = imagecolorallocate($image, 200, 200, 200);
    imagefill($image, 0, 0, $white);


    $scaleto= 2.0/3.0*( ($height >= $width)? $width : $height );

    // position yunoguy
    imagecopyresampled($image, 
                       $yunoguy, 
                       $width/2-$scaleto/2, $height/2 - $scaleto/2, 0, 0, 
                       $scaleto, $scaleto, 
                       imagesx($yunoguy), imagesy($yunoguy));


    //Calculating font size   
    $fontsize = $scaleto /8;

     //Inserting Text    
     imagettftext($image,$fontsize, 0, 
                    ($width/2) - 3*$fontsize, 
                    ($height/2 - $scaleto/2 -.5*$fontsize),  
                    $txt_color, 'Impact.ttf', $text1);
     //Inserting Text    
     imagettftext($image,$fontsize, 0, 
                    ($width /2) - ($fontsize *5.2), 
                    ($height/2 + $scaleto/2 + 1.5* $fontsize ),  
                    $txt_color, 'Impact.ttf', $text2);








    //Tell the browser what kind of file is come in 
    header("Content-Type: image/png"); 
    //Output the newly created image in png format 
    imagepng($image);   
    //Free up resources
    ImageDestroy($image);
}