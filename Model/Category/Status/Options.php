<?php
/**
 * Replace category status code with a label in the Categories grid
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Model\Category\Status;

class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Grid display options.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => __('Disabled')],
            ['value' => '1', 'label' => __('Enabled')]
        ];
    }
}
