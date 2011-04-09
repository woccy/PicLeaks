<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /** Ensure classes are autoloaded correctly **/
    
    public static function autoload($class)
    {
        include str_replace('_', '/', $class) . '.php';
        
        return $class;
    }
    
    
    protected function _initView()
    {
        $options = $this->getOptions();
        
        if (isset ($options['resources']['view']))
        {
            $view = new Zend_View($options['resources']['view']);
        }
        else
        {
            $view = new Zend_View;
        }

        if (isset ($options['resources']['view']['doctype']))
        {
            $view->doctype($options['resources']['view']['doctype']);
        }

        if (isset ($options['resources']['view']['contentType']))
        {
            $view->headMeta()->appendHttpEquiv('Content-Type',
            $options['resources']['view']['contentType']);
        }
        
        if (isset ($options['resources']['view']['contentLanguage']))
        {
            $view->headMeta()->appendHttpEquiv('Content-Language',
            $options['resources']['view']['contentLanguage']);
        }

        $viewRenderer =
        Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');

        $viewRenderer->setView($view);

        return $view;
    }
}

