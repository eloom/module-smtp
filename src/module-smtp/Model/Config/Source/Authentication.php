<?php
/**
* 
* SMTP para Magento 2
* 
* @category     elOOm
* @package      Modulo SMTP
* @copyright    Copyright (c) 2022 elOOm (https://eloom.tech)
* @version      2.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\Smtp\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Authentication implements ArrayInterface {
	
	public function toOptionArray() {
		$options = [
			[
				'value' => '',
				'label' => __('None')
			],
			[
				'value' => 'plain',
				'label' => __('Plain')
			],
			[
				'value' => 'login',
				'label' => __('Login')
			],
			[
				'value' => 'crammd5',
				'label' => __('Cram-MD5')
			],
		];
		
		return $options;
	}
}
