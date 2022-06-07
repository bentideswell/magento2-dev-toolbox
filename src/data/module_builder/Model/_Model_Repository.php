<?php
%php_file_header%
namespace %namespace%\Model;

use %namespace%\Model\%model%;
use %namespace%\Model\ResourceModel\%model%\Collection;

class %model%Repository
{
    /**
     *
     */
    private $cache = [];
    
    /**
     * @var %model%Factory
     */
    protected $%model.strtolower%Factory;

    /**
     * @var \%namespace%\Model\ResourceModel\%model%
     */
    protected $resourceModel;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     *
     */
    public function __construct(
        \%namespace%\Model\ResourceModel\%model% $resourceModel,
        \%namespace%\Model\%model%Factory $%model.strtolower%Factory,
        \%namespace%\Model\ResourceModel\%model%\CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->resourceModel = $resourceModel;
        $this->%model.strtolower%Factory = $%model.strtolower%Factory;
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \%namespace%\Model\%model% $%model.strtolower%
     * @return %model%
     * @throws CouldNotSaveException
     */
    public function save(%model% $%model.strtolower%)
    {
        if ($%model.strtolower%->getStoreId() === null) {
            $%model.strtolower%->setStoreId(
                $this->storeManager->getStore()->getId()
            );
        }

        try {
            $this->resourceModel->save($%model.strtolower%);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __(
                    'Could not save the %model.strtolower%: %1',
                    $exception->getMessage()
                ),
                $exception
            );
        }

        return $%model.strtolower%;
    }

    /**
     * @param string $%model.strtolower%Id
     * @return %model%
     */
    public function getById($%model.strtolower%Id)
    {
        if (!isset($this->cache[$%model.strtolower%Id])) {
            $this->cache[$%model.strtolower%Id] = $this->%model.strtolower%Factory->create()->load($%model.strtolower%Id);
        }

        if (!$this->cache[$%model.strtolower%Id] || !$this->cache[$%model.strtolower%Id]->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(
                __('The %model.strtolower% with the "%1" ID doesn\'t exist.', $%model.strtolower%Id)
            );
        }

        return $this->cache[$%model.strtolower%Id];
    }

    /**
     * @param \%namespace%\Model\%model% $%model.strtolower%
     * @return bool
     */
    public function delete(%model% $%model.strtolower%)
    {
        try {
            $this->resourceModel->delete($%model.strtolower%);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __(
                    'Could not delete the %model.strtolower%: %1',
                    $exception->getMessage()
                )
            );
        }

        return true;
    }

    /**
     * @param string $%model.strtolower%Id
     * @return bool
     */
    public function deleteById($%model.strtolower%Id)
    {
        return $this->delete(
            $this->getById($%model.strtolower%Id)
        );
    }
}
