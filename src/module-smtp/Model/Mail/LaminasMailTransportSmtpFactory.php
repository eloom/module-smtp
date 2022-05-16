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

use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;

class LaminasMailTransportSmtpFactory {
	
	public function create($smtpOptions) {
		
		return new Smtp($smtpOptions);
	}
}