<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Model\Request;

use WBW\Library\SMSMode\Model\Attribute\StringSmsIDTrait;
use WBW\Library\SMSMode\Model\AbstractRequest;

/**
 * Delivery report request.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model\Request
 */
class DeliveryReportRequest extends AbstractRequest {

    use StringSmsIDTrait;

    /**
     * Delivery report resource path.
     *
     * @var string
     */
    const DELIVERY_REPORT_RESOURCE_PATH = "/http/1.6/compteRendu.do";

    /**
     * {@inheritdoc}
     */
    public function getResourcePath() {
        return self::DELIVERY_REPORT_RESOURCE_PATH;
    }
}
