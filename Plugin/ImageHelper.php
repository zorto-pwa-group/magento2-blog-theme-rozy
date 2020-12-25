<?php
namespace ZT\BlogThemeRozy\Plugin;

use ZT\Blog\Helper\Image;

class ImageHelper
{
    /**
     * @param Image $subject
     * @param $result
     * @return array
     */
    public function afterGetSize(Image $subject, $result)
    {
        $result[] = [80, 80];
        return $result;
    }
}
