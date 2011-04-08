<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
        
                $this->setName('Register');
                $this->setMethod('post');

		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');

		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('username')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');

		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('password')
				->setRequired(true)
				->addValidator('NotEmpty');

                $captcha = new Zend_Form_Element_Captcha
                (
                    'signup',
                    array('captcha' => array(
                    'captcha' => 'Figlet',
                    'wordLen' => 4,
                    'timeout' => 600))
                    );
            $captcha->setLabel('Please type in the
            words below to continue');

                
                

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');

		$this->addElements(array($id, $username, $password, $captcha, $submit));
    }


}

