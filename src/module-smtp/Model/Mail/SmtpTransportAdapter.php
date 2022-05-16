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

namespace Eloom\Smtp\Model\Mail;

use Eloom\Smtp\Helper\Data;
use Laminas\Mail\Message;
use Magento\Framework\Mail\TransportInterface;

class SmtpTransportAdapter {
	
	private $emailSettings;
	
	private $smtpTransport;
	
	public function __construct(Data $emailSettings,
	                            LaminasSmtpTransport $smtpTransport) {
		$this->emailSettings = $emailSettings;
		$this->smtpTransport = $smtpTransport;
	}
	
	public function send($subject, $storeId) {
		$message = $this->getMessage($subject);
		$this->sendMessage($message, $storeId);
	}
	
	private function getMessage($subject) {
		if (method_exists($subject, 'getMessage')) {
			$message = $subject->getMessage();
		} else {
			$message = $this->useReflectionToGetMessage($subject);
		}
		
		return $message;
	}
	
	private function useReflectionToGetMessage($subject) {
		$reflection = new \ReflectionClass($subject);
		$property = $reflection->getProperty('_message');
		$property->setAccessible(true);
		$message = $property->getValue($subject);
		
		return $message;
	}
	
	private function sendMessage($message, $storeId) {
		$this->smtpTransport->send(Message::fromString($message->getRawMessage())->setEncoding('utf-8'), $storeId);
	}
}
