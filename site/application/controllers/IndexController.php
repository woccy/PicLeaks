<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$form = new Application_Form_Login();
        $request = $this->getRequest();
        
        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                if ($this->_process($form->getValues()))
                {
                    // We're authenticated! Redirect to the home page
                    $this->_helper->redirector('index', 'index');
                }
            }
        }

        $picturesTable = new Application_Model_DbTable_Pictures();
        $select = $picturesTable->select()
                                ->where('private = ?', 0)
                                ->order('uploadtime DESC');
                    
        $pictures = $picturesTable->fetchAll($select);

        $this->view->pictures = $pictures;
		
    }

    protected function _process($values)
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']); 
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        
        if ($result->isValid())
        {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        
        return false;
    }

    protected function _getAuthAdapter()
    {
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('SHA1(CONCAT(?,salt))');
                    
        return $authAdapter;
    }

    public function logoutAction()
    {
    
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page		
    }

    public function registerAction()
    {
                
        $form = new Application_Form_Register();
		$form->submit->setLabel('Register');
		$this->view->form = $form;

		if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
            
			if($form->isValid($formData))
			{
                $id         = $form->getvalue('id');
				$username   = $form->getvalue('username');
				$password   = $form->getvalue('password');
                $salt       = md5($id.$username.$password);
                                
				$user = new Application_Model_DbTable_Users();
                $user->addUser($id, $username, $password, $salt);
				
				$this->_helper->redirector('index');
			}
			else
			{
				$form->populate($formData);
			}
        }
    }

    public function uploadAction()
    {
        $auth = Zend_Auth::getInstance();
        
        if ($auth->hasIdentity())
        {
            $form = new Application_Form_PicUpload();
            $this->view->form = $form;
            
            if ($this->getRequest()->isPost())
            {
                if ($form->isValid($this->getRequest()->getPost()))
                {
                    $title = $form->getValue('title');
                    
                    $uploader_id = $auth->getIdentity()->id;
                    
                    $filename = $form->getValue('picture');
                    
                    $private = $form->getValue('private');
                    
                    $denyComments = $form->getValue('denyComments');
                    
                    $tags = $form->getValue('tags');
                    
                    $path = './pictures/';

                    //$renameFile = implode('_', $uploader_id, date('YmdHis'), $filename);
                    $renameFile = strtolower($uploader_id . substr(md5(time(0)), 0, 5) .'_'.$filename);

                    $fullFilePath = './pictures/'.$renameFile;
                    $thumbPath = './pictures/thumbs/'.$renameFile;

                    // Rename uploaded file using Zend Framework
                    $filterFileRename = new Zend_Filter_File_Rename(array('target' => $fullFilePath, 'overwrite' => true));
                    $filterFileRename->filter('./pictures/'.$filename);

                    $thumbs = new Application_Model_Thumbnails();
                    
                    /** Kuvan rajaus **/
                    
                    $thumbs->createThumbnail(600, $fullFilePath, $fullFilePath);
                    
                    /** Pikkukuvat **/
                    
                    $thumbs->createThumbnail(250, $fullFilePath, $thumbPath);

                    $picupload = new Application_Model_DbTable_Pictures();
                    $picupload->addPicture($title, $uploader_id, $renameFile, $path, $private, $denyComments, $tags);
                    $this->_redirect('/index/');
                }
            }
        }
    }

    
    public function viewpictureAction()
    {

        $id = $this->_getParam('id', 0);
        
        $picturesTable = new Application_Model_DbTable_Pictures();
        
        $select = $picturesTable->select()
                                ->where('picture_id = ?', $id)
                                ->limit(1, 0);
                                
        $picture = $picturesTable->fetchAll($select);       

        $comment_form = new Application_Form_Comment();
        $picture_id = new Zend_Form_Element_Hidden('picture_id');
        $picture_id->addFilter('Int');
        $picture_id->setValue($id);
        $comment_form->addElement($picture_id);

        $comment_form->setAction('http://picleaks.local/index/comment/id/'. $id)
                     ->setMethod('post');
        
        $this->view->picture = $picture;
        $this->view->comment_form = $comment_form;

        $commentsTable = new Application_Model_DbTable_Comments();
        $select = $commentsTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
        $select->setIntegrityCheck(false)
                ->where('picture_id = ?', $id)
                ->join('users', 'users.id = comments.commenter_id');
                
        $listComments = $commentsTable->fetchAll($select);
        
        $this->view->listComments = $listComments;
    }

    public function commentAction()
    {
        $auth = Zend_Auth::getInstance();
        $comment_form = new Application_Form_Comment();
        $id = $this->_getParam('id', 0);
        
        //echo $this->getRequest()->getPost('comment', null);

        if ($this->getRequest()->isPost())
        {
            if ($comment_form->isValid($this->getRequest()->getPost()))
            {
                //$picture_id = $comment_form->getvalue('picture_id');
                $commenter_id = $auth->getIdentity()->id;
                $comment = $comment_form->getvalue('comment');                

                $commentModel = new Application_Model_DbTable_Comments();
                //echo $picture_id;
                $commentModel->addComment($id, $commenter_id, $comment);
                $this->_redirect('http://picleaks.local/index/viewpicture/id/'. $id);
            }
        }        
    }

    public function faqAction()
    {
        // UKK voisi olla yksinkertaisimmillaan taulukko kysymys/vastaus -pareista ?
        $this->view->answers = array("Was ist das?" => "I don't know!");
    }

    public function advancedSearchAction()
    {
        $advancedSearchForm = new Application_Form_AdvancedSearch();
        $this->view->form = $advancedSearchForm;

        $searchForm = new Application_Form_Search();
        if ($this->getRequest()->isPost())
        {
            if ($searchForm->isValid($this->getRequest()->getPost()))
            {

                $picturesTable = new Application_Model_DbTable_Pictures();
                $search = $searchForm->getValue('search');
                $select = $picturesTable->select()
                                        ->where('title LIKE ?', '%'.$search.'%')
                                        ->order('uploadtime DESC');
                                        
                $searchQuery = $picturesTable->fetchAll($select);

                $this->view->searchQuery = $searchQuery;
            }
        }
    }
    
}
