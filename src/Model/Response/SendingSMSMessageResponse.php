<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Model\Response;

use WBW\Library\SMSMode\Model\Attribute\StringSmsIDTrait;
use WBW\Library\SMSMode\Model\AbstractResponse;

/**
 * Sending SMS message response.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model\Response
 */
class SendingSMSMessageResponse extends AbstractResponse {

    use StringSmsIDTrait;
}
