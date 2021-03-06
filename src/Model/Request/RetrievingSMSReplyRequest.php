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

use DateTime;
use WBW\Library\SMSMode\Model\Attribute\IntegerOffsetTrait;
use WBW\Library\SMSMode\Model\AbstractRequest;

/**
 * Retrieving SMS reply request.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model\Request
 */
class RetrievingSMSReplyRequest extends AbstractRequest {

    use IntegerOffsetTrait;

    /**
     * Retrieving SMS reply resource path.
     *
     * @var string
     */
    const RETRIEVING_SMS_REPLY_RESOURCE_PATH = "/http/1.6/responseList.do";

    /**
     * End date.
     *
     * @var DateTime
     */
    private $endDate;

    /**
     * Start
     *
     * @var int
     */
    private $start;

    /**
     * Start date.
     *
     * @var DateTime
     */
    private $startDate;

    /**
     * Get the end date.
     *
     * @return DateTime Returns the end date.
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getResourcePath() {
        return self::RETRIEVING_SMS_REPLY_RESOURCE_PATH;
    }

    /**
     * Get the start.
     *
     * @return int Returns the start.
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Get the start date.
     *
     * @return DateTime Returns the start date.
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * Set the end date.
     *
     * @param DateTime|null $endDate The end date.
     * @return RetrievingSMSReplyRequest Returns this retrieving SMS reply request.
     */
    public function setEndDate(DateTime $endDate = null) {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * Set the start.
     *
     * @param int $start The start.
     * @return RetrievingSMSReplyRequest Returns this retrieving SMS reply request.
     */
    public function setStart($start) {
        $this->start = $start;
        return $this;
    }

    /**
     * Set the start date.
     *
     * @param DateTime|null $startDate The start date.
     * @return RetrievingSMSReplyRequest Returns this retrieving SMS reply request.
     */
    public function setStartDate(DateTime $startDate = null) {
        $this->startDate = $startDate;
        return $this;
    }
}
