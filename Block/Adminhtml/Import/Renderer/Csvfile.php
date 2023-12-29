<?php

namespace Conceptive\CmsImportExport\Block\Adminhtml\Import\Renderer;

use Magento\Framework\DataObject;

class Csvfile extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    protected $_assetRepo;

    public function __construct( 
         \Magento\Framework\View\Asset\Repository $assetRepo
    ) {
         $this->_assetRepo = $assetRepo;
    }

    public function getElementHtml()
    {
         $csvFile1 = $this->_assetRepo->getUrl('Conceptive_CmsImportExport::importfile/cms_page.zip');
         $csvFile2 = $this->_assetRepo->getUrl('Conceptive_CmsImportExport::importfile/cms_block.zip');
         $csvLink = "<div class='sample-link'><div><a href=".$csvFile1." target='_blank'>Download Sample File For Cms Pages</a></div><div><a href=".$csvFile2." target='_blank'>Download Sample File For Cms Blocks</a></div></div>";
        return $csvLink;
    }

}