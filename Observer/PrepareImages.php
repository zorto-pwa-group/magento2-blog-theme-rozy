<?php
namespace ZT\BlogThemeRozy\Observer;

use Magento\Framework\Event\ObserverInterface;
use ZT\Blog\Model\Post;
use Magento\Framework\App\ObjectManager;

class PrepareImages implements ObserverInterface
{
    /**
     * @var ObjectManager
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $data = $observer->getData('data');
        $model = $observer->getData('model');
        $this->_objectManager = $observer->getData('objectManager');
        /* Prepare logo image */
        if (isset($data['logo_url']) && is_array($data['logo_url'])) {
            if (!empty($data['logo_url']['delete'])) {
                $model->setData('logo_url', null);
            } else {
                if (isset($data['logo_url'][0]['name']) && isset($data['logo_url'][0]['tmp_name'])) {
                    try {
                        $image = $data['logo_url'][0]['name'];
                        $imageUploader = $this->_objectManager->create(
                            \ZT\Blog\ImageUpload::class
                        );
                        $image = $imageUploader->moveFileFromTmp($image);
                        $model->setData('logo_url', Post::BASE_MEDIA_PATH . '/' . $image);
                    }catch (\Exception $e){
                        echo $e->getMessage();
                    }
                } else {
                    if (isset($data['logo_url'][0]['name'])) {
                        $model->setData('logo_url', $data['logo_url'][0]['name']);
                    }
                }
            }
        } else {
            $model->setData('logo_url', null);
        }
        /* Prepare collapse logo image */
        if (isset($data['collapse_logo_url']) && is_array($data['collapse_logo_url'])) {
            if (!empty($data['collapse_logo_url']['delete'])) {
                $model->setData('collapse_logo_url', null);
            } else {
                if (isset($data['collapse_logo_url'][0]['name']) && isset($data['collapse_logo_url'][0]['tmp_name'])) {
                    $image = $data['collapse_logo_url'][0]['name'];
                    $imageUploader = $this->_objectManager->create(
                        \ZT\Blog\ImageUpload::class
                    );
                    $image = $imageUploader->moveFileFromTmp($image);
                    $model->setData('collapse_logo_url', Post::BASE_MEDIA_PATH . '/' . $image);
                } else {
                    if (isset($data['collapse_logo_url'][0]['name'])) {
                        $model->setData('collapse_logo_url', $data['collapse_logo_url'][0]['name']);
                    }
                }
            }
        } else {
            $model->setData('collapse_logo_url', null);
        }
        /* Prepare main banner image */
        if (isset($data['main_banner']) && is_array($data['main_banner'])) {
            if (!empty($data['main_banner']['delete'])) {
                $model->setData('main_banner', null);
            } else {
                if (isset($data['main_banner'][0]['name']) && isset($data['main_banner'][0]['tmp_name'])) {
                    $image = $data['main_banner'][0]['name'];
                    $imageUploader = $this->_objectManager->create(
                        \ZT\Blog\ImageUpload::class
                    );
                    $image = $imageUploader->moveFileFromTmp($image);
                    $model->setData('main_banner', Post::BASE_MEDIA_PATH . '/' . $image);
                } else {
                    if (isset($data['main_banner'][0]['name'])) {
                        $model->setData('main_banner', $data['main_banner'][0]['name']);
                    }
                }
            }
        } else {
            $model->setData('main_banner', null);
        }
        return $this;
    }
}