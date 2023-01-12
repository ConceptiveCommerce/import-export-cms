<?php
namespace Conceptive\Cmsimportexport\Ui\Component;

class MassAction extends \Magento\Ui\Component\MassAction
{
    public function prepare()
    {
        parent::prepare();
         $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $conf = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('conceptive_cmsimportexport/general/enabled');
        if($conf == false){
            $config = $this->getConfiguration();
            $notAllowedActions = ['export'];
            $allowedActions = [];
            foreach ($config['actions'] as $action) {
                if (!in_array($action['type'], $notAllowedActions)) {
                    $allowedActions[] = $action;
                }
            }
            $config['actions'] = $allowedActions;
            $this->setData('config', (array)$config);
        }
    }
}