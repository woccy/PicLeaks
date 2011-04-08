<?php

class Application_Model_DbTable_Pictures extends Zend_Db_Table_Abstract
{

    protected $_name = 'pictures';

    public function addPicture($title, $uploader_id, $filename, $path, $private, $denyComments, $tags)
    {
        $data = array(
            'title' => $title,
            'uploader_id' => $uploader_id,
            'filename' => $filename,
            'path' => $path,
            'private' => $private,
            'denyComments' => $denyComments,
            'tags' => $tags);
	$this->insert($data);
    }

    public function listPictures()
    {

    }


}

