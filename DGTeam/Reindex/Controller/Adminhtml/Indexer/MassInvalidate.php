<?php

namespace DGTeam\Reindex\Controller\Adminhtml\Indexer;

use Magento\Indexer\Controller\Adminhtml\Indexer as MIndexer;

class MassInvalidate extends MIndexer
{

    /**
     * @var Magento\Framework\Indexer\IndexerRegistry $indexerRegistry
     */
    private $indexerRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Indexer\IndexerRegistry $indexerRegistry

    )
    {
        $this->indexerRegistry = $indexerRegistry;
        parent::__construct($context);
    }

    /**
     * Turn mview off for the given indexers
     *
     * @return void
     */
    public function execute()
    {

        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addError(__('Please select indexers.'));
        } else {
            try {
                foreach ($indexerIds as $indexerId) {

                    /** @var \Magento\Framework\Indexer\IndexerInterface $model */
                    $model = $this->indexerRegistry->get($indexerId);
                    $model->invalidate();
                }
                $this->messageManager->addSuccess(
                    __('%1 indexer(s) are in "reindex required" mode and waiting for reindex by cronjob.', count($indexerIds))
                );
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException(
                    $e,
                    __("We couldn't change indexer(s)' mode because of the error: ". $e->getMessage())
                );
            }
        }
        $this->_redirect('*/*/list');


    }

    /**
     * Check the controller alc
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Indexer::changeMode');

    }
}
