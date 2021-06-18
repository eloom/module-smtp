<?php
/**
* 
* SMTP para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo SMTP
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\Smtp\Model\Mail;

use Eloom\Smtp\Helper\Data;

class LaminasSmtpTransport {
	
	const ENCODING = 'utf-8';
	
	private $emailSettings;
	
	private $mailTransportSmtpFactory;
	
	public function __construct(Data $emailSettings,
	                            LaminasMailTransportSmtpFactory $laminasMailTransportSmtpFactory) {
		$this->emailSettings = $emailSettings;
		$this->mailTransportSmtpFactory = $laminasMailTransportSmtpFactory;
	}
	
	public function send($message, $storeId) {
		$smtpOptions = $this->emailSettings->getSmtpOptions($storeId);
		$smtp = $this->mailTransportSmtpFactory->create($smtpOptions);
		//$message->setEncoding(self::ENCODING);
		
		$smtp->send($message);
	}
}
