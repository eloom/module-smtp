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

namespace Eloom\Smtp\Model\Plugin;

use Eloom\Smtp\Helper\Data;
use Eloom\Smtp\Mail\TransportBuilder;
use Eloom\Smtp\Model\Mail\SmtpTransportAdapter;
use Magento\Framework\Mail\TransportInterface;
use Magento\Framework\Registry;
use Psr\Log\LoggerInterface;

class LinuxSmtpConfig {
	
	private $logger;
	
	private $smtpTransportAdapter;
	
	private $helper;
	
	private $registry;
	
	public function __construct(LoggerInterface $logger,
	                            SmtpTransportAdapter $smtpTransportAdapter,
	                            Data $helper,
	                            Registry $registry) {
		
		$this->logger = $logger;
		$this->smtpTransportAdapter = $smtpTransportAdapter;
		$this->helper = $helper;
		$this->registry = $registry;
	}
	
	public function aroundSendMessage(TransportInterface $subject, \Closure $proceed) {
		$storeId = $this->registry->registry(TransportBuilder::SMTP_STORE_ID);
		try {
			$this->smtpTransportAdapter->send($subject, $storeId);
		} catch (\Exception $e) {
			$this->logger->error("TransportPlugin send exception: " . $e->getMessage());
			return $proceed();
		}
	}
}