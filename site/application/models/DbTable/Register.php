<?php

class Application_Model_DbTable_Register extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';

    public function addUser($id, $username, $password)
        {
                $salt = 'ce8d96d579d389e783f95b3772785783ea1a9854';
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

