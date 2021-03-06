<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit6\ProductSeries\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

/**
 * Class ProductSeriesAttr
 * ProductSeriesAttr implements DataPatchInterface
 */
class ProductSeriesAttr implements DataPatchInterface
{
    /**
     * @var EavSetup
     */
    protected EavSetup $eavSetup;

    /**
     * @var ModuleDataSetupInterface
     */
    protected ModuleDataSetupInterface $moduleDataSetup;

    /**
     * ProductSeriesAttr constructor.
     * @param EavSetup $eavSetup
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(EavSetup $eavSetup, ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->eavSetup = $eavSetup;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * * ruturn DataPatchInterface|void
     *
     * @return DataPatchInterface|void
     * @throws LocalizedException|\Zend_Validate_Exception
     */
    public function apply()
    {
        $entityTypeId = $this->eavSetup->getEntityTypeId('catalog_product');
        $attributeSetId = $this->eavSetup->getAttributeSetId($entityTypeId, 'Bag');
        $attributeGroupId = $this->eavSetup->getAttributeGroupId($entityTypeId, $attributeSetId, 'Product Details');
        $attributeCode = 'product_series';
        $properties = [
            'type' => 'varchar',
            'label' => 'Product Series',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'user_defined' => 1,
            'required' => 0,
            'visible_on_front' => 1,
            'is_used_in_grid' => 1,
            'is_visible_in_grid' => 1,
            'is_filterable_in_grid' => 1
        ];

        $this->eavSetup->addAttribute($entityTypeId, $attributeCode, $properties);
        $this->eavSetup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, $attributeCode);
    }

    /**
     * * return array|string[]
     *
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * * return  array|string[]
     *
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
