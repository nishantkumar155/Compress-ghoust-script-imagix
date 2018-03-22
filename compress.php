<?php


//require "/vender/image-optimizer/src/ImageOptimizer/OptimizerFactory.php";
require_once 'autoload.php';

//$all_files = glob("files/*.*");
//for ($i=0; $i<count($all_files); $i++)
//{
//    $image_name = $all_files[$i];
//    $supported_format = array('gif','jpg','jpeg','png');
//    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
//    if (in_array($ext, $supported_format))
//    {
////        echo '<img src="'.$image_name .'" alt="'.$image_name.'" />'."<br /><br />";
//        print_r("<pre>");
//        print_r($image_name);
//        print_r("</pre>");
//        // Optimize image
//        $factory = new \ImageOptimizer\OptimizerFactory();
//        $optimizer = $factory->get('jpegoptim');
//        $optimizer->optimize($image_name);
//
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
//    } else {
//        continue;
//    }
//}

///================================================

function getDirContents($dir, &$results = array()){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != ".." && $value !== "..." && $value !== "....") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }
    print_r("<pre>");
//    print_r($path);
    print_r("</pre>");
    return $results;
}

$as = getDirContents('files/');
//$as = getDirContents('new/');
foreach($as as $a) {
    print_r("<pre>");
    if (!is_dir($a)) {
           print_r($a);
//         Optimize image
        $factory = new \ImageOptimizer\OptimizerFactory();
        $optimizer = $factory->get('jpg');
        $optimizer->optimize($a);
//

//       compress($a, $a, 40);
//        if( chmod('files/', 0777) ) {
//            // more code
//            chmod('files/', 0777);
//            echo "Done";
//        }
//        else
//            echo "Couldnt do it";
    print_r("</pre>");
    }
}



function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}


//$source_img = 'source.jpg';
//$destination_img = 'destination .jpg';
//
//$d = compress($source_img, $destination_img, 90);
?>
