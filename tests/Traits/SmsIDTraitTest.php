<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Tests\Traits;

use WBW\Library\SMSMode\Tests\AbstractTestCase;
use WBW\Library\SMSMode\Tests\Fixtures\Traits\TestSmsIDTrait;

/**
 * SMS ID trait test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Tests\Traits
 */
class SmsIDTraitTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $obj = new TestSmsIDTrait();

        $this->assertNull($obj->getSmsID());
    }

    /**
     * Tests the setSmsID() method.
     *
     * @return void
     */
    public function testSetSmsID() {

        $obj = new TestSmsIDTrait();

        $obj->setSmsID("smsID");
        $this->assertEquals("smsID", $obj->getSmsID());
    }
}