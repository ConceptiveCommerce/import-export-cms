<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Conceptive\Cmsimportexport\Block\Adminhtml;

use Magento\Backend\Block\Widget\Form\Container;

class Import extends Container
{
    protected $_mode = 'upload';

    protected function _construct()
    {
        $this->_objectId = 'import';
        $this->_blockGroup = 'Conceptive_Cmsimportexport';
        $this->_controller = 'adminhtml_import';

        parent::_construct();

        $this->buttonList->remove('back');
        $this->buttonList->update('save', 'label', __('Import'));
    }

    public function getHeaderText(): string
    {
        return __('Import CMS');
    }
}
