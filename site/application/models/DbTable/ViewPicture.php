<?php

class Application_Model_DbTable_ViewPicture extends Zend_Db_Table_Abstract
{

    protected $_name = 'pictures';

    public function addPicture($picture_id)
    {
        $data = array(
            'uploader_id' => $uploader_id,
            'filename' => $filename,
            'path' => $path);
	$this->insert($data);
    }

    public function listPictures()
    {
    
    }




}

