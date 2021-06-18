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

namespace Eloom\Smtp\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;
use Laminas\Mail\Transport\SmtpOptions;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
	
	const XML_PATH_SMTP_HOST = 'system/smtp/host';
	const XML_PATH_SMTP_PROTOCOL = 'system/smtp/protocol';
	const XML_PATH_SMTP_USERNAME = 'system/smtp/username';
	const XML_PATH_SMTP_PASSWORD = 'system/smtp/password';
	const XML_PATH_SMTP_PORT = 'system/smtp/port';
	
	private $encryptor;
	
	public function __construct(Context $context, EncryptorInterface $encryptor) {
		$this->encryptor = $encryptor;
		parent::__construct($context);
	}
	
	public function getSmtpHost($storeId) {
		return $this->scopeConfig->getValue(self::XML_PATH_SMTP_HOST, ScopeInterface::SCOPE_STORE, $storeId);
	}
	
	private function getSmtpUsername($storeId = null) {
		return $this->scopeConfig->getValue(self::XML_PATH_SMTP_USERNAME, ScopeInterface::SCOPE_STORE, $storeId);
	}
	
	private function getSmtpPassword($storeId = null) {
		$value = $this->scopeConfig->getValue(self::XML_PATH_SMTP_PASSWORD, ScopeInterface::SCOPE_STORE, $storeId);
		return $this->encryptor->decrypt($value);
	}
	
	private function getSmtpPort($storeId) {
		return $this->scopeConfig->getValue(self::XML_PATH_SMTP_PORT, ScopeInterface::SCOPE_STORE, $storeId);
	}
	
	private function getSmtpProtocol($storeId) {
		return $this->scopeConfig->getValue(self::XML_PATH_SMTP_PROTOCOL, ScopeInterface::SCOPE_STORE, $storeId);
	}
	
	public function getTransportConfig($storeId) {
		$config = [
			'port' => $this->getSmtpPort($storeId),
			'auth' => 'login',
			'username' => $this->getSmtpUsername($storeId),
			'password' => $this->getSmtpPassword($storeId),
			'ssl' => $this->getSmtpProtocol($storeId)
		];
		
		return $config;
	}
	
	public function getSmtpOptions($storeId) {
		return new SmtpOptions([
				'host' => $this->getSmtpHost($storeId),
				'port' => $this->getSmtpPort($storeId),
				'connection_class' => 'login',
				'connection_config' =>
					[
						'username' => $this->getSmtpUsername($storeId),
						'password' => $this->getSmtpPassword($storeId),
						'ssl' => $this->getSmtpProtocol($storeId)
					]
			]
		);
	}
}