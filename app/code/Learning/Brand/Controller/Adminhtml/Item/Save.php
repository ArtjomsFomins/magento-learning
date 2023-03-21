<?php

namespace Learning\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
use Learning\Brand\Model\Brand;
use Learning\Brand\Model\ResourceModel\Brand\Collection;

/**
* Class Save
*
* @package learning\Brand\Controller\Adminhtml\Brand
*/
class Save extends Action
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory
     */
    protected $attributeFactory;

    private $itemFactory;
    /**
     * @param \Magento\Backend\App\Action\Context                       $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface     $dataPersistor
     * @param \Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory $attributeFactory
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface          $categoryRepository
     */
    public function __construct(
        Context $context,
        ItemFactory $itemFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->attributeFactory = $attributeFactory;
        $this->categoryRepository = $categoryRepository;
        $this->itemFactory = $itemFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /**
         * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
         */

        $this->itemFactory->create()->setData($this->getRequest()->getPostValue()['general'])->save();
        return $this->resultRedirectFactory->create()->setPath('learning/index/index');
        // $resultRedirect = $this->resultRedirectFactory->create();
        // $data = $this->getRequest()->getPostValue();
        // if ($data) {
        //     $id = $this->getRequest()->getParam('id');

        //     $model = $this->_objectManager->create(Brand::class)->load($id);
        //     if (!$model->getId() && $id) {
        //         $this->messageManager->addErrorMessage(__('This Brand no longer exists.'));
        //         return $resultRedirect->setPath('*/*/');
        //     }

        //     $attr = $this->attributeFactory->create()->loadByCode('catalog_product', 'brand');
        //     if ($attr->usesSource()) {
        //         $brandName = $attr->getSource()->getOptionText($data['brand']);
        //         $model->setData('brand_name', $brandName);
        //     }

        //     try {
        //         $model->save();
        //         $this->messageManager->addSuccessMessage(__('You saved the Brand.'));
        //         $this->dataPersistor->clear('learning_brand_brand');

        //         if ($this->getRequest()->getParam('back')) {
        //             return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        //         }
        //         return $resultRedirect->setPath('*/*/');
        //     } catch (LocalizedException $e) {
        //         $this->messageManager->addErrorMessage($e->getMessage());
        //     } catch (\Exception $e) {
        //         $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Brand.'));
        //     }

        //     $this->dataPersistor->set('learning_brand_brand', $data);
        //     return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        // }
        // return $resultRedirect->setPath('*/*/');
    }
}
