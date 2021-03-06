<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Tests\Model\Request;

use WBW\Library\SMSMode\Model\Request\CheckingSMSMessageStatusRequest;
use WBW\Library\SMSMode\Tests\AbstractTestCase;

/**
 * Checking SMS message status request test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Tests\Model\Request
 */
class CheckingSMSMessageStatusRequestTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $this->assertEquals("/http/1.6/smsStatus.do", CheckingSMSMessageStatusRequest::CHECKING_SMS_MESSAGE_STATUS_RESOURCE_PATH);

        $obj = new CheckingSMSMessageStatusRequest();

        $this->assertEquals(CheckingSMSMessageStatusRequest::CHECKING_SMS_MESSAGE_STATUS_RESOURCE_PATH, $obj->getResourcePath());
        $this->assertNull($obj->getSmsID());
    }
}
