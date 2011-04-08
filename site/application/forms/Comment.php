<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
       
        $this->setAction(array('controller'=>'index','action'=>'comment'), null, true)
         ->setMethod('post');

        $comment = new Zend_Form_Element_Text('comment');
        $comment->setLabel('comment')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit');
        // attach elements to form

        $this->addElement($comment)
             ->addElement($submit);
    }

}

