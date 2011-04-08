<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
    protected $_referenceMap    = array(
        'Comment' => array(
                        'columns'   => array('id'),
                        'refTableClass' => 'Comments',
                        'refColumns'    => array('commenter_id')
                        )
    );

    public function addUser($id, $username, $password, $salt)
        {
                
                $password = sha1($password . $salt);
		$data = array(
                        'id' => $id,
			'username' => $username,
			'password' => $password,
                        'salt' => $salt,
                        'role' => 'user');
		$this->insert($data);
	}


}

