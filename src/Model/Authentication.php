<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Model;

use WBW\Library\SMSMode\Model\Attribute\StringAccessTokenTrait;

/**
 * Authentication.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model
 */
class Authentication {

    use StringAccessTokenTrait;

    /**
     * Pass.
     *
     * @var string
     */
    private $pass;

    /**
     * Pseudo.
     *
     * @var string
     */
    private $pseudo;

    /**
     * Constructor.
     *
     * @param string $pseudo The pseudo.
     * @param string $pass The pass.
     */
    public function __construct($pseudo = null, $pass = null) {
        $this->setPass($pass);
        $this->setPseudo($pseudo);
    }

    /**
     * Get the pass.
     *
     * @return string Returns the pass.
     */
    public function getPass() {
        return $this->pass;
    }

    /**
     * Get the pseudo.
     *
     * @return string Returns the pseudo.
     */
    public function getPseudo() {
        return $this->pseudo;
    }

    /**
     * Set the pass.
     *
     * @param string $pass The pass.
     * @return Authentication Returns this authentication.
     */
    public function setPass($pass) {
        $this->pass = $pass;
        return $this;
    }

    /**
     * Set the pseudo.
     *
     * @param string $pseudo The pseudo.
     * @return Authentication Returns this authentication.
     */
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
        return $this;
    }
}
