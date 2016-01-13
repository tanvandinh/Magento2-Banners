<?php
/**
 * Copyright © 2015 TanDinh. All rights reserved.
 */

namespace TanDinh\Banner\Controller\Adminhtml\Banners;

class Edit extends \TanDinh\Banner\Controller\Adminhtml\Banners
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('TanDinh\Banner\Model\Banners');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('tandinh_banner/*');
                return;
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->_coreRegistry->register('current_tandinh_banner_banners', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('banners_banners_edit');
        $this->_view->renderLayout();
    }
}
