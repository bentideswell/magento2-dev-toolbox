<?php
%php_file_header%
namespace %namespace%\Controller\Adminhtml\%model%;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @const string
     */
    const ADMIN_RESOURCE = '%module_name%::resource';

    /**
     *
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \%namespace%\Model\%model%Repository $%model.strtolower%Repository,
        \%namespace%\Model\%model%Factory $%model.strtolower%Factory,
        \%namespace%\Model\%model%\FileProcessor $fileProcessor,
    ) {
        $this->%model.strtolower%Repository = $%model.strtolower%Repository;
        $this->%model.strtolower%Factory = $%model.strtolower%Factory;
        $this->fileProcessor = $fileProcessor;
        parent::__construct($context);
    }

    /**
     *
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('back')) {
            return;
        }

        $objectId = (int)$this->getRequest()->getPost('%model.strtolower%_id');

        if ($data = $this->getRequest()->getPostValue()) {
            try {
                if (isset($data['image'])) {
                    $data['image'] = $this->fileProcessor->getInsertValue($data['image']);
                }

                $%model.strtolower% = $this->%model.strtolower%Factory->create();
                $%model.strtolower%->setData($data)->unsetData('%model.strtolower%_id');

                if ($objectId) {
                    $%model.strtolower%->setId($objectId);
                }

                $this->%model.strtolower%Repository->save($%model.strtolower%);

                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/edit',
                    [
                        '%model.strtolower%_id' => $%model.strtolower%->getId()
                    ]
                );
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage('No data to save');
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
