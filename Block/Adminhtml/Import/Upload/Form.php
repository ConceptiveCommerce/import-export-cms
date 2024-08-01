<?php

namespace Conceptive\CmsImportExport\Block\Adminhtml\Import\Upload;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Store\Api\StoreRepositoryInterface;
use Conceptive\CmsImportExport\Api\ContentInterface;
use Conceptive\CmsImportExport\Model\Source\CmsMode;
use Conceptive\CmsImportExport\Model\Source\MediaMode;

class Form extends Generic
{
    protected $mediaMode;
    protected $cmsMode;
    protected $storeRepositoryInterface;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        StoreRepositoryInterface $storeRepositoryInterface,
        MediaMode $mediaMode,
        CmsMode $cmsMode,
        array $data = []
    ) {
        $this->mediaMode = $mediaMode;
        $this->cmsMode = $cmsMode;
        $this->storeRepositoryInterface = $storeRepositoryInterface;

        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getUrl('*/*/post'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('import_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Upload'),
                'class' => 'fieldset-wide',
            ]
        );

        $fieldsetMode = $form->addFieldset(
            'mode_fieldset',
            [
                'legend' => __('Import mode'),
                'class' => 'fieldset-wide',
            ]
        );

       /* $fieldsetStores = $form->addFieldset(
            'store_fieldset',
            [
                'legend' => __('Store mapping'),
                'class' => 'fieldset-wide',
            ]
        );*/

        $fieldset->addField(
            'zipfile',
            'file',
            [
                'name' => 'zipfile',
                'label' => __('ZIP File'),
                'title' => __('ZIP File'),
                'required' => true,
                'Renderer' => '\Conceptive\CmsImportExport\Block\Adminhtml\Import\Renderer\Csvfile',
            ]
        );

        $fieldset->addType('csvfile', '\Conceptive\CmsImportExport\Block\Adminhtml\Import\Renderer\Csvfile');

        $fieldset->addField(
            'importtext',
            'csvfile',
            [
                'name'  => 'csvfile',
                'label' => __('csvfile'),
                'title' => __('csvfile'),

            ]
        );

        

        $fieldsetMode->addField(
            'cms_mode',
            'select',
            [
                'name' => 'cms_mode',
                'label' => __('CMS import mode'),
                'title' => __('CMS import mode'),
                'required' => true,
                'values' => $this->cmsMode->toOptionArray(),
            ]
        );

        $fieldsetMode->addField(
            'media_mode',
            'select',
            [
                'name' => 'media_mode',
                'label' => __('Media import mode'),
                'title' => __('Media import mode'),
                'required' => true,
                'values' => $this->mediaMode->toOptionArray(),
            ]
        );

        $stores = $this->storeRepositoryInterface->getList();
        foreach ($stores as $storeInterface) {
            $fieldset->addField(
                'store_map:'.$storeInterface->getCode(),
                'hidden',
                [
                    'name' => 'store_map['.$storeInterface->getCode().']',
                    'label' => __('Store "%1"', $storeInterface->getCode()),
                    'title' => __('Store "%1"', $storeInterface->getCode()),
                    'required' => false,
                ]
            );
        }

        $values = [
            'cms_mode' => ContentInterface::CMS_MODE_UPDATE,
            'media_mode' => ContentInterface::MEDIA_MODE_UPDATE,
        ];
        foreach ($stores as $storeInterface) {
            $values['store_map:'.$storeInterface->getCode()] = $storeInterface->getCode();
        }

        // Set defaults
        $form->setValues($values);

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
?>
<style type="text/css">
    .sample-link {
        text-align: center;
        margin-left: 146px;
        line-height: 34px;
        font-size: 16px;
    }
</style>