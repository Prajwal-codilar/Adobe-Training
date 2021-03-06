<?php

namespace Task\Employee\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Employee extends AbstractDb
{

    public const TABLE_NAME = 'prajwal_assignment2';
    public const ID_FIELD_NAME = 'id';
    /**
     * Employee constructor.
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::ID_FIELD_NAME);
    }
}
