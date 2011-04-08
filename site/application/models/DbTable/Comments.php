<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';
    protected $_dependentTables = array('Users');

   
    public function addComment($picture_id, $commenter_id, $comment)
    {
        $data = array(
            'picture_id' => (int)$picture_id,
            'commenter_id' => (int)$commenter_id,
            'comment' => $comment);
	$this->insert($data);
    }
}

