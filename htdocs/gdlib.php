<?php
    $Jpeg = ImageCreate(300,16);
    $bg = ImageColorAllocate($Jpeg,255,150,0);
    $tx = ImageColorAllocate($Jpeg,250,250,250);

    ImageFilledRectangle($Jpeg,0,0,3,3,$bg);
    ImageString($Jpeg,2,1,1, $_ENV["S2G_SERVER_SOFTWARE"]." generated image (by GD)" ,$tx);

    header("Content-Type: image/png");
    ImageJpeg($Jpeg, "", 100);
    ImageDestroy($Jpeg);
?>
