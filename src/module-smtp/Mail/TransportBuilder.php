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

namespace Eloom\Smtp\Mail;

use Magento\Framework\Mail\Template\TransportBuilder as MageTransportBuilder;
use Magento\Framework\Registry;

class TransportBuilder {
	
	const SMTP_STORE_ID = 'smtp_store_id';
	
	private $registry;
	
	public function __construct(Registry $registry) {
		$this->registry = $registry;
	}
	
	public function beforeSetTemplateOptions(MageTransportBuilder $transportBuilder, $templateOptions) {
		if (null !== $this->registry->registry(self::SMTP_STORE_ID)) {
			$this->registry->unregister(self::SMTP_STORE_ID);
		}
		
		$this->registry->register(self::SMTP_STORE_ID, $templateOptions['store']);
	}
}
