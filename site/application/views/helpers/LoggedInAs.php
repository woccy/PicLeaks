<?php
class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract 
{
    public function loggedInAs()
    {
        $auth = Zend_Auth::getInstance();
        
        if ($auth->hasIdentity())
        {
            $username = $auth->getIdentity()->username;
            $logoutUrl = $this->view->url(array('controller'=>'index',
                        'action'=>'logout'), null, true);
            return 'Welcome ' . $username .  '. <a href="'.$logoutUrl.'">Logout</a>';
        }
        else
        {
            $form = new Application_Form_Login();
            $form->setAction('index/index')
                 ->setMethod('post');
                 
            return $this->view->form = $form;
        }
    }
}

?>