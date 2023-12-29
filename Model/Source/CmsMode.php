<?php

namespace Conceptive\CmsImportExport\Model\Source;

use Conceptive\CmsImportExport\Api\ContentInterface;

class CmsMode
{
    /**
     * To option array
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Overwrite existing'), 'value' => ContentInterface::CMS_MODE_UPDATE],
            ['label' => __('Skip existing'), 'value' => ContentInterface::CMS_MODE_SKIP],
        ];
    }
}
