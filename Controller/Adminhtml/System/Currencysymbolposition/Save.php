<?php

namespace Hitkaipe\CurrencySymbolPosition\Controller\Adminhtml\System\Currencysymbolposition;

use Hitkaipe\CurrencySymbolPosition\Model\System\CurrencySymbolPosition;
use Magento\Backend\App\Action;

class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Hitkaipe_CurrencySymbolPosition::symbols_position';

    /**
     * Save custom Currency symbol position
     *
     * @return void
     */
    public function execute(): void
    {
        $symbolsDataArray = $this->getRequest()->getParam('custom_currency_symbol_position', null);

        try {
            $this->_objectManager->create(CurrencySymbolPosition::class)
                ->setPositionData($symbolsDataArray);
            $this->messageManager->addSuccess(__('You applied the custom currency symbol positions.'));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl($this->getUrl('*')));
    }
}
