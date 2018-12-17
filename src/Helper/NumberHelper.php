<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Helper;

/**
 * Number helper.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Helper
 */
class NumberHelper {

    /**
     * Constructor.
     */
    private function __construct() {
        // NOTHING TO DO.
    }

    /**
     * Decode a number.
     *
     * @param string $number The number.
     * @return string Returns the decoded number.
     */
    public static function decodeNumber($number) {
        $output = preg_replace("/^336/", "06", $number, 1);
        $result = preg_replace("/^337/", "07", $output, 1);
        return $result;
    }

    /**
     * Encode a number.
     *
     * @param string $number The number.
     * @return string Returns the encoded number.
     */
    public static function encodeNumber($number) {
        $output = preg_replace("/^06/", "336", $number, 1);
        $result = preg_replace("/^07/", "337", $output, 1);
        return $result;
    }

}
