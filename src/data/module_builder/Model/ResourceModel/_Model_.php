<?php
%php_file_header%
namespace %namespace%\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;

class %model% extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init('%model_layout_prefix%', '%model_id_field%');
    }
    
    /**
     * @inheritDoc
     */
    protected function _beforeSave(AbstractModel $object)    
    {
        return parent::_beforeSave($object);
    }
    
    /**
     * @inheritDoc
     */
    protected function _afterSave(AbstractModel $object)
    {
        if ($object->getId()) {
            $this->saveStoreIds($object->getId(), (array)$object->getData('store_id'));
        }

        return parent::_afterSave($object);
    }

    /**
     * @inheritDoc
     */
    protected function _beforeLoad(AbstractModel $object)
    {
        return parent::_beforeLoad($object);
    }

    /**
     * @inheritDoc
     */
    protected function _afterLoad(AbstractModel $object)
    {
        $object->setStoreId($this->lookupStoreIds($object->getId()));
        return parent::_afterLoad($object);
    }
    
    /**
     *
     */
    public function lookupStoreIds($%model.strtolower%Id): array
    {
        $connection = $this->getConnection();

        $select = $connection->select()
            ->from(['cps' => $this->getStoreTable()], 'store_id')
            ->join(
                ['cp' => $this->getMainTable()],
                'cps.%model_id_field% = cp.%model_id_field%',
                []
            )
            ->where('cp.%model_id_field% = :%model_id_field%');

        return $connection->fetchCol($select, ['%model_id_field%' => (int)$%model.strtolower%Id]);
    }

    /**
     *
     */
    public function saveStoreIds($%model.strtolower%Id, $storeIds = []): void
    {
        $storeTable = $this->getStoreTable();
        $connection = $this->getConnection();

        $connection->delete($storeTable, $connection->quoteInto('%model_id_field%=?', $%model.strtolower%Id));

        foreach((array)$storeIds as $storeId) {
            $connection->insert($storeTable, ['%model_id_field%' => $%model.strtolower%Id, 'store_id' => $storeId]);
        }
    }

    /**
     * @return string
     */
    public function getStoreTable(): string
    {
        return $this->getTable('%model_layout_prefix%_store');
    }
}
