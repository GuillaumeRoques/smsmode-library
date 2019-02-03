<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Model;

use UnexpectedValueException;
use WBW\Library\SMSMode\Traits\DateEnvoiTrait;
use WBW\Library\SMSMode\Traits\MessageTrait;

/**
 * Sending text-to-speech SMS request.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Model
 */
class SendingTextToSpeechSMSRequest extends AbstractRequest {

    use DateEnvoiTrait;
    use MessageTrait;

    /**
     * Language "de-DE".
     *
     * @var string
     */
    const LANGUAGE_DE = "de-DE";

    /**
     * Language "en-GB".
     *
     * @var string
     */
    const LANGUAGE_EN = "en-GB";

    /**
     * Language "es-ES".
     *
     * @var string
     */
    const LANGUAGE_ES = "es-ES";

    /**
     * Language "fr-FR".
     *
     * @var string
     */
    const LANGUAGE_FR = "fr-FR";

    /**
     * Sending text-to-speech SMS request.
     *
     * @var string
     */
    const SENDING_TEXT_TO_SPEECH_SMS_RESOURCE_PATH = "/http/1.6/sendVoiceMessage.do";

    /**
     * Lnaguage.
     *
     * @var string
     */
    private $language;

    /**
     * Numero.
     *
     * @var string[]
     */
    private $numero;

    /**
     * Title.
     *
     * @var string
     */
    private $title;

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->setNumero([]);
    }

    /**
     * Add a numero.
     *
     * @param string $numero The numero.
     * @return SendingTextToSpeechSMSRequest Returns this sending text-to-speech SMS request.
     * @throws UnexpectedValueException Throws an unexpected value exception if the numero is invalid.
     */
    public function addNumero($numero) {
        static::checkNumero($numero);
        $this->numero[] = $numero;
        return $this;
    }

    /**
     * Get the language.
     *
     * @return string Returns the language.
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Get the numero.
     *
     * @return string[] Returns the numero.
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * {@inheritdoc}
     */
    public function getResourcePath() {
        return self::SENDING_TEXT_TO_SPEECH_SMS_RESOURCE_PATH;
    }

    /**
     * Get the title.
     *
     * @return string Returns the title.
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set the language.
     *
     * @param string $language The language.
     * @return SendingTextToSpeechSMSRequest Returns this sending text-to-speech request.
     * @throws UnexpectedValueException Throws an unexpected value exception if the language is invalid.
     */
    public function setLanguage($language) {
        if (false === in_array($language, [self::LANGUAGE_FR, self::LANGUAGE_EN, self::LANGUAGE_DE, self::LANGUAGE_ES])) {
            throw new UnexpectedValueException(sprintf("The language \"%s\" is invalid", $language));
        }
        $this->language = $language;
        return $this;
    }

    /**
     * Set the numero.
     *
     * @param string[] $numero The numero.
     * @return SendingTextToSpeechSMSRequest Returns this sending text-to-speech request.
     */
    protected function setNumero(array $numero) {
        $this->numero = $numero;
        return $this;
    }

    /**
     * Set the title.
     *
     * @param string $title The title.
     * @return SendingTextToSpeechSMSRequest Returns this sending text-to-speech request.
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
}
