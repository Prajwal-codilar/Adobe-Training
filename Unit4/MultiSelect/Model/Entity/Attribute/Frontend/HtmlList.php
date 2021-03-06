<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\MultiSelect\Model\Entity\Attribute\Frontend;

/**
 * Class HtmlList
 * HtmlList extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
 */
class HtmlList extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{

    /**
     * * param \Magento\Framework\DataObject $object
     *
     * @param \Magento\Framework\DataObject $object
     * @return mixed|string
     */
    public function getValue(\Magento\Framework\DataObject $object)
    {
        if ($this->getConfigField('input') != 'multiselect') {
            return parent::getValue($object);
        }
        return $this->getValuesAsHtmlList($object);
    }

    /**
     * * param \Magento\Framework\DataObject $object
     *
     * @param \Magento\Framework\DataObject $object
     * @return string
     */
    private function getValuesAsHtmlList(\Magento\Framework\DataObject $object)
    {
        $options = $this->getOptions($object);
        $escapedOptions = array_map('htmlspecialchars', $options);
        return sprintf(
            '<ul><li>%s</li></ul>',
            implode('</li><li>', $escapedOptions)
        );
    }

    /**
     * * param \Magento\Framework\DataObject $object
     *
     * @param \Magento\Framework\DataObject $object
     * @return array|bool|mixed
     */
    private function getOptions(\Magento\Framework\DataObject $object)
    {
        $optionId = $object->getData($this->getAttribute()->getAttributeCode());
        $option = $this->getOption($optionId);
        return $this->isSingleValue($option) ? [$option] : $option;
    }

    /**
     * * param  $option
     *
     * @param bool $option
     * @return bool
     */
    private function isSingleValue($option)
    {
        return !is_array($option);
    }
}
