<?php
%php_file_header%
namespace %namespace%\Controller\Adminhtml\%model%\FileUploader;

class Save extends \Magento\Backend\App\Action
{
    /**
     *
     */
    protected $fileProcessor;

    /**
     * Authorization level
     */
    const ADMIN_RESOURCE = '%module_name%::resource';

    /**
     * @param Context $context
     * @param FileProcessor $fileProcessor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \%namespace%\Model\%model%\FileProcessor $fileProcessor
    ) {
        parent::__construct($context);
        $this->fileProcessor = $fileProcessor;
    }

    /**
     * @inheritDoc
     * @since 100.1.0
     */
    public function execute()
    {
        $result = $this->fileProcessor->uploadFile(key($_FILES));
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);
    }
}
