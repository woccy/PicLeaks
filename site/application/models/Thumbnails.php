<?php

include 'C:\wamp\www\picleaks\library\Custom\Thumbnail.php';

class Application_Model_Thumbnails
{
    public function createThumbnail($w, $sourcePath, $savePath)
    {
       $thumb = PhpThumbFactory::create($sourcePath);
       $thumb->resize($w, 0)->save($savePath);
    }


}

