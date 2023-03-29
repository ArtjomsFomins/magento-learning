<?php

/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Artjoms Fomins <info@magebit.com>
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

declare(strict_types=1);

namespace Magebit\Faq\Model\Question\Source;

use Magebit\Faq\Model\Question;

/**
 * Class converting int status to text
 */
class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    protected Question $emp;

    /**
     * @param Question $emp
     */
    public function __construct(Question $emp)
    {
        $this->emp = $emp;
    }

    /**
     * @inheritDoc
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->getOptionArray();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }

    /**
     * Function than return numbers and corresponding them text
     *
     * @return array
     */
    public static function getOptionArray()
    {
        return [1 => __('Enabled'), 0 => __('Disabled')];
    }
}
