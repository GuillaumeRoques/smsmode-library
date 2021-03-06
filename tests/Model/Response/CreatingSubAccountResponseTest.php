<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Tests\Model\Response;

use WBW\Library\SMSMode\Model\Response\CreatingSubAccountResponse;
use WBW\Library\SMSMode\Tests\AbstractTestCase;

/**
 * Creating sub-account response test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Tests\Model\Response
 */
class CreatingSubAccountResponseTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $obj = new CreatingSubAccountResponse();

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
    }
}
