<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2019 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\ProgressiveWebApp\Controller\Adminhtml\Notification;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Delete
 * @package Tigren\ProgressiveWebApp\Controller\Adminhtml\Notification
 */
class Delete extends Action
{
    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('notification_id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('Tigren\ProgressiveWebApp\Model\Notification');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The notification has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['notification_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a notification to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
