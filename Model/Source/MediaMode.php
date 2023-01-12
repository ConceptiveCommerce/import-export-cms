<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Conceptive\Cmsimportexport\Model\Source;

use Conceptive\Cmsimportexport\Api\ContentInterface;

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
