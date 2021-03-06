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

/**
 * Integer nbr msg trait.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model\Attribute
 */
trait IntegerNbrMsgTrait {

    /**
     * Nbr msg.
     *
     * @var int
     */
    private $nbrMsg;

    /**
     * Get the nbr msg.
     *
     * @return int Returns the nbr msg.
     */
    public function getNbrMsg() {
        return $this->nbrMsg;
    }

    /**
     * Set the nbr msg.
     *
     * @param int $nbrMsg The nbr msg.
     * @throws InvalidArgumentException Throws an invalid argument exception if the nbr msg is less than 1.
     */
    public function setNbrMsg($nbrMsg) {
        if (null === $nbrMsg || $nbrMsg < 1) {
            throw new InvalidArgumentException("The \"nbr msg\" must be greater than 0");
        }
        $this->nbrMsg = $nbrMsg;
        return $this;
    }
}
