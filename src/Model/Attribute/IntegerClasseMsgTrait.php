<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Model\Attribute;

use InvalidArgumentException;
use WBW\Library\SMSMode\API\SendingSMSBatchInterface;

/**
 * Integer classe msg trait.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model\Attribute
 */
trait IntegerClasseMsgTrait {

    /**
     * Classe msg.
     *
     * @var int
     */
    private $classeMsg;

    /**
     * Enumerates the classe msg.
     *
     * @return array Returns the classe msg enumeration.
     */
    public function enumClasseMsg() {
        return [
            SendingSMSBatchInterface::CLASSE_MSG_SMS,
            SendingSMSBatchInterface::CLASSE_MSG_SMS_PRO,
        ];
    }

    /**
     * Get the classe msg.
     *
     * @return int Returns the classe msg.
     */
    public function getClasseMsg() {
        return $this->classeMsg;
    }

    /**
     * Set the classe msg.
     *
     * @param int $classeMsg The classe msg.
     * @throws InvalidArgumentException Throws an invalid argument exception exception if the classe msg is invalid.
     */
    public function setClasseMsg($classeMsg) {
        if (null !== $classeMsg && false === in_array($classeMsg, $this->enumClasseMsg())) {
            throw new InvalidArgumentException(sprintf("The classe msg \"%s\" is invalid", $classeMsg));
        }
        $this->classeMsg = $classeMsg;
        return $this;
    }
}
