<?php

class Application_Form_Login extends Zend_Form
{
    public function __construct($options = NULL)
    {
    
        parent::__construct();
        
        Zend_Dojo::enableForm($this);
        
        $this->setName('login')
             ->setMethod('post');
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username')
                 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('NotEmpty', TRUE)
                 ->setRequired(TRUE);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty', TRUE)
                 ->setRequired(TRUE);
        

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Sign in')
               ->setIgnore(TRUE)
               ->setRequired(TRUE);

        
        $this->addElements(array($username, $password, $submit));
        
        /** Lomakkeen ulkoasu */
        
        $this->addDecorator('FormElements')
             ->addDecorator('Fieldset')
             ->addDecorator('HtmlTag', array('tag' => '<tr>'))
             ->addDecorator('Form');
        
        $this->setElementDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('Description'),
            array('HtmlTag', array('tag' => 'td', 'class' => 'element-group')),
            ));
        
        $submit->setDecorators(array(
            array('ViewHelper'),
            array('Description'),
            array('HtmlTag', array('tag' => 'td', 'class' => 'submit-group')),
            ));
        
    }
}

