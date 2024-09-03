<?php
namespace Gautam\Mod5\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Context;

class Redirect extends Action
{
    protected $resultRedirectFactory;
    protected $productRepository;

    public function __construct(
        Context $context,
        RedirectFactory $resultRedirectFactory,
        ProductRepositoryInterface $productRepository
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        // Specify the product ID to which you want to redirect
        $productId = 1; // Example product ID

        try {
            // Load the product by ID
            $product = $this->productRepository->getById($productId);

            // Get the product URL
            $productUrl = $product->getProductUrl();

            // Redirect to the product page
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setUrl($productUrl);
            return $resultRedirect;
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            // Handle the error when the product doesn't exist
            $this->messageManager->addErrorMessage(__('Product does not exist.'));
            return $this->_redirect('/');
        }
    }
}
