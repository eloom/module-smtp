<?php
/**
* 
* SMTP para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo SMTP
* @copyright    Copyright (c) 2021 Ã©lOOm (https://www.eloom.com.br)
* @version      1.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\Smtp\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Protocol implements ArrayInterface {
	public function toOptionArray() {
		$options = [
			[
				'value' => '',
				'label' => __('None')
			],
			[
				'value' => 'ssl',
				'label' => __('SSL')
			],
			[
				'value' => 'tls',
				'label' => __('TLS')
			],
		];
		
		return $options;
	}
}
