<?php

require_once Mage::getConfig()->getOptions()->getLibDir() . '/google/google-api-php-client/Google_Client.php';
require_once Mage::getConfig()->getOptions()->getLibDir() . '/google/google-api-php-client/contrib/Google_PlusService.php';

class AW_Google_Connect_Controller_Varien_Router_Standard extends Mage_Core_Controller_Varien_Router_Standard
{
    public function match(Zend_Controller_Request_Http $request)
    {
        $path = explode('/', trim($request->getPathInfo(), '/'));
        // If path doesn't match your module requirements
        if (!in_array(count($path), array(2, 3)) || ($path[0] != 'googleconnect')) {
            return parent::match($request);
        }

        // Define initial values for controller initialization
        $module = $path[0];
        $realModule = 'AW_Google_Connect';
        $controller = $path[1];
        if (!$request->getActionName()) {
            $action = empty($path[2]) ? 'index' : $path[2];
        } else {
            $action = $request->getActionName();
        }
        $controllerClassName = $this->_validateControllerClassName(
            $realModule,
            $controller
        );

        // If controller was not found
        if (!$controllerClassName) {
            return parent::match($request);
        }
        // Instantiate controller class
        $controllerInstance = Mage::getControllerInstance(
            $controllerClassName,
            $request,
            $this->getFront()->getResponse()
        );
        // If action is not found
        if (!$controllerInstance->hasAction($action)) {
            return parent::match($request);
        }
        // Set request data
        $request->setModuleName($module);
        $request->setControllerName($controller);
        $request->setActionName($action);
        $request->setControllerModule($realModule);
        // Set your custom request parameter
        $request->setParam('url_path', @$path[1]);
        // dispatch action
        $request->setDispatched(true);

        $controllerInstance->dispatch($action);
        // Indicate that our route was dispatched
        return true;
    }

    public function getControllerFileName($realModule, $controller)
    {
        $parts = explode('_', $realModule);
        $realModule = implode('_', array_splice($parts, 0, 3));
        $file = Mage::getModuleDir('controllers', $realModule);
        if (count($parts)) {
            $file .= DS . implode(DS, $parts);
        }
        $file .= DS . uc_words($controller, DS) . 'Controller.php';
        return $file;
    }
}
