<?php

namespace Conceptive\CmsImportExport\Model\Source;

use Conceptive\CmsImportExport\Api\ContentInterface;

class MediaMode
{
    /**
     * To option array
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Do not import'), 'value' => ContentInterface::MEDIA_MODE_NONE],
            ['label' => __('Overwrite existing'), 'value' => ContentInterface::MEDIA_MODE_UPDATE],
            ['label' => __('Skip existing'), 'value' => ContentInterface::MEDIA_MODE_SKIP],
        ];
    }
}
