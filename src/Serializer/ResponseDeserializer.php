<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Serializer;

use DateTime;
use WBW\Library\Core\Argument\Helper\ArrayHelper;
use WBW\Library\SMSMode\API\ResponseInterface;
use WBW\Library\SMSMode\Model\AbstractResponse;
use WBW\Library\SMSMode\Model\DeliveryReport;
use WBW\Library\SMSMode\Model\Response\AccountBalanceResponse;
use WBW\Library\SMSMode\Model\Response\AddingContactResponse;
use WBW\Library\SMSMode\Model\Response\CheckingSMSMessageStatusResponse;
use WBW\Library\SMSMode\Model\Response\CreatingAPIKeyResponse;
use WBW\Library\SMSMode\Model\Response\CreatingSubAccountResponse;
use WBW\Library\SMSMode\Model\Response\DeletingSMSResponse;
use WBW\Library\SMSMode\Model\Response\DeletingSubAccountResponse;
use WBW\Library\SMSMode\Model\Response\DeliveryReportResponse;
use WBW\Library\SMSMode\Model\Response\RetrievingSMSReplyResponse;
use WBW\Library\SMSMode\Model\Response\SendingSMSBatchResponse;
use WBW\Library\SMSMode\Model\Response\SendingSMSMessageResponse;
use WBW\Library\SMSMode\Model\Response\SendingTextToSpeechSMSResponse;
use WBW\Library\SMSMode\Model\Response\SendingUnicodeSMSResponse;
use WBW\Library\SMSMode\Model\Response\SentSMSMessageListResponse;
use WBW\Library\SMSMode\Model\Response\TransferringCreditsResponse;
use WBW\Library\SMSMode\Model\SentSMSMessage;
use WBW\Library\SMSMode\Model\SMSReply;

/**
 * Response deserializer.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Serializer
 */
class ResponseDeserializer {

    /**
     * Deserialize an account balance response.
     *
     * @param string $rawResponse The response.
     * @return AccountBalanceResponse Returns the account balance response.
     */
    public static function deserializeAccountBalanceResponse($rawResponse) {

        $model = new AccountBalanceResponse();
        if (1 === preg_match("/^[0-9]{2,4} \|/", trim($rawResponse))) {
            static::deserializeResponse($model, $rawResponse);
            return $model;
        }

        $model->setRawResponse($rawResponse);
        if (1 === preg_match("/^[0-9]{1,}\.[0-9]{1,}$/", trim($rawResponse))) {
            $model->setAccountBalance(floatval(trim($rawResponse)));
        }

        return $model;
    }

    /**
     * Deserialize an adding contact response.
     *
     * @param string $rawResponse The raw response.
     * @return AddingContactResponse Returns the adding contact response.
     */
    public static function deserializeAddingContactResponse($rawResponse) {

        $model = new AddingContactResponse();
        static::deserializeResponse($model, $rawResponse);

        return $model;
    }

    /**
     * Deserialize a checking SMS message status response.
     *
     * @param string $rawResponse The raw response.
     * @return CheckingSMSMessageStatusResponse Returns the checking SMS message status response.
     */
    public static function deserializeCheckingSMSMessageStatusResponse($rawResponse) {

        $model = new CheckingSMSMessageStatusResponse();
        static::deserializeResponse($model, $rawResponse);

        return $model;
    }

    /**
     * Deserialize a creating API key response.
     *
     * @param string $rawResponse The raw response.
     * @return CreatingAPIKeyResponse Returns the creating API key response.
     */
    public static function deserializeCreatingAPIKeyResponse($rawResponse) {

        $decodedResponse = json_decode(trim($rawResponse), true);

        $model = new CreatingAPIKeyResponse();
        $model->setRawResponse($rawResponse);

        if (false === array_key_exists("accessToken", $decodedResponse)) {
            $model->setException($decodedResponse);
        }

        $creationDate = DateTime::createFromFormat(ResponseInterface::RESPONSE_DATE_FORMAT, ArrayHelper::get($decodedResponse, "creationDate"));
        $expiration   = DateTime::createFromFormat(ResponseInterface::RESPONSE_DATE_FORMAT, ArrayHelper::get($decodedResponse, "expiration"));

        $model->setId(ArrayHelper::get($decodedResponse, "id"));
        $model->setAccessToken(ArrayHelper::get($decodedResponse, "accessToken"));
        $model->setAccount(ArrayHelper::get($decodedResponse, "account"));
        $model->setCreationDate(false !== $creationDate ? $creationDate : null);
        $model->setExpiration(false !== $expiration ? $expiration : null);
        $model->setState(ArrayHelper::get($decodedResponse, "state"));

        return $model;
    }

    /**
     * Deserialize a creating sub-account response.
     *
     * @param string $rawResponse The raw response.
     * @return CreatingSubAccountResponse Returns the creating sub-account response.
     */
    public static function deserializeCreatingSubAccountResponse($rawResponse) {

        $model = new CreatingSubAccountResponse();
        static::deserializeResponse($model, $rawResponse);

        return $model;
    }

    /**
     * Deserialize a deleting SMS response.
     *
     * @param string $rawResponse The raw response.
     * @return DeletingSMSResponse Returns the deleting SMS response.
     */
    public static function deserializeDeletingSMSResponse($rawResponse) {

        $model = new DeletingSMSResponse();
        static::deserializeResponse($model, $rawResponse);

        return $model;
    }

    /**
     * Deserialize a deleting su-account response.
     *
     * @param string $rawResponse The raw response.
     * @return DeletingSubAccountResponse Returns the deleting sub-account response.
     */
    public static function deserializeDeletingSubAccountResponse($rawResponse) {

        $model = new DeletingSubAccountResponse();
        static::deserializeResponse($model, $rawResponse);

        return $model;
    }

    /**
     * Deserialize a delivery report.
     *
     * @param string $rawResponse The raw response.
     * @return DeliveryReport Returns the delivery report.
     */
    protected static function deserializeDeliveryReport($rawResponse) {

        $model = new DeliveryReport();
        $model->setRawResponse($rawResponse);

        $responses = explode(" ", preg_replace("/ {1,}/", " ", trim($rawResponse)));
        if (count($responses) < 2) {
            return $model;
        }

        $model->setCode(intval(trim($responses[1])));
        $model->setNumero(trim($responses[0]));

        return $model;
    }

    /**
     * Deserialize a delivery report response.
     *
     * @param string $rawResponse The raw response.
     * @return DeliveryReportResponse Returns the delivery report response.
     */
    public static function deserializeDeliveryReportResponse($rawResponse) {

        $model = new DeliveryReportResponse();
        if (1 === preg_match("/^[0-9]{2,4} \|/", trim($rawResponse))) {
            static::deserializeResponse($model, $rawResponse);
            return $model;
        }

        $model->setRawResponse($rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        foreach ($responses as $current) {
            $model->addDeliveryReport(static::deserializeDeliveryReport($current));
        }

        return $model;
    }

    /**
     * Deserialize a response.
     *
     * @param AbstractResponse $model The response.
     * @param string $rawResponse The raw response.
     * @return void
     */
    protected static function deserializeResponse(AbstractResponse $model, $rawResponse) {

        $model->setRawResponse($rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (count($responses) < 2) {
            return;
        }

        $model->setCode(intval(trim($responses[0])));
        $model->setDescription(trim($responses[1]));
    }

    /**
     * Deserialize a retrieving SMS reply response.
     *
     * @param string $rawResponse The raw response.
     * @return RetrievingSMSReplyResponse Returns the retrieving SMS reply response.
     */
    public static function deserializeRetrievingSMSReplyResponse($rawResponse) {

        $model = new RetrievingSMSReplyResponse();
        if (1 === preg_match("/^[0-9]{2,4} \|/", trim($rawResponse))) {
            static::deserializeResponse($model, $rawResponse);
            return $model;
        }

        $model->setRawResponse($rawResponse);

        $responses = explode("\n", trim($rawResponse));
        foreach ($responses as $current) {
            $model->addSMSReply(static::deserializeSMSReply($current));
        }

        return $model;
    }

    /**
     * Deserialize a SMS reply.
     *
     * @param string $rawResponse The raw response.
     * @return SMSReply Returns the SMS reply.
     */
    protected static function deserializeSMSReply($rawResponse) {

        $model = new SMSReply();
        $model->setRawResponse($rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (count($responses) < 6) {
            return $model;
        }

        $receptionDate = DateTime::createFromFormat(ResponseInterface::RESPONSE_DATETIME_FORMAT, trim($responses[1]));

        $model->setResponseID(trim($responses[0]));
        if (false !== $receptionDate) {
            $model->setReceptionDate($receptionDate);
        }
        $model->setFrom(trim($responses[2]));
        $model->setText(trim($responses[3]));
        $model->setTo(trim($responses[4]));
        $model->setMessageID(trim($responses[5]));

        return $model;
    }

    /**
     * Deserialize a sending SMS batch response.
     *
     * @param string $rawResponse The raw response.
     * @return SendingSMSBatchResponse Returns the sending SMS batch response.
     */
    public static function deserializeSendingSMSBatchResponse($rawResponse) {

        $model = new SendingSMSBatchResponse();
        static::deserializeResponse($model, $rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (ResponseInterface::RESPONSE_CODE_0 === $model->getCode() && 3 === count($responses)) {
            $model->setCampagneID(trim($responses[2]));
        }

        return $model;
    }

    /**
     * Deserialize a sending SMS message response.
     *
     * @param string $rawResponse The raw response.
     * @return SendingSMSMessageResponse Returns the sending SMS message response.
     */
    public static function deserializeSendingSMSMessageResponse($rawResponse) {

        $model = new SendingSMSMessageResponse();
        static::deserializeResponse($model, $rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (ResponseInterface::RESPONSE_CODE_0 === $model->getCode() && 3 === count($responses)) {
            $model->setSmsID(trim($responses[2]));
        }

        return $model;
    }

    /**
     * Deserialize a sending text-to-speech SMS response.
     *
     * @param string $rawResponse The raw response.
     * @return SendingTextToSpeechSMSResponse Returns the sending text-to-speech SMS response.
     */
    public static function deserializeSendingTextToSpeechSMSResponse($rawResponse) {

        $model = new SendingTextToSpeechSMSResponse();
        static::deserializeResponse($model, $rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (ResponseInterface::RESPONSE_CODE_0 === $model->getCode() && 3 === count($responses)) {
            $model->setSmsID(trim($responses[2]));
        }

        return $model;
    }

    /**
     * Deserialize a sending unicode SMS response.
     *
     * @param string $rawResponse The raw response.
     * @return SendingUnicodeSMSResponse Returns the sending unicode SMS response.
     */
    public static function deserializeSendingUnicodeSMSResponse($rawResponse) {

        $model = new SendingUnicodeSMSResponse();
        static::deserializeResponse($model, $rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (ResponseInterface::RESPONSE_CODE_0 === $model->getCode() && 3 === count($responses)) {
            $model->setSmsID(trim($responses[2]));
        }

        return $model;
    }

    /**
     * Deserialize a sent SMS message.
     *
     * @param string $rawResponse The raw response.
     * @return SentSMSMessage Returns the sent SMS message.
     */
    protected static function deserializeSentSMSMessage($rawResponse) {

        $model = new SentSMSMessage();
        $model->setRawResponse($rawResponse);

        $responses = explode(ResponseInterface::RESPONSE_DELIMITER, trim($rawResponse));
        if (count($responses) < 6) {
            return $model;
        }

        $sendDate = DateTime::createFromFormat(ResponseInterface::RESPONSE_DATETIME_FORMAT, trim($responses[1]));

        $model->setSmsID(trim($responses[0]));
        if (false !== $sendDate) {
            $model->setSendDate($sendDate);
        }
        $model->setMessage(trim($responses[2]));
        $model->setNumero(trim($responses[3]));
        $model->setCostCredits(floatval(trim($responses[4])));
        $model->setRecipientCount(intval(trim($responses[5])));

        return $model;
    }

    /**
     * Deserialize a sent SMS message list response.
     *
     * @param string $rawResponse The raw response.
     * @return SentSMSMessageListResponse Returns the sent SMS message list response.
     */
    public static function deserializeSentSMSMessageListResponse($rawResponse) {

        $model = new SentSMSMessageListResponse();
        if (1 === preg_match("/^[0-9]{2,4} \|/", trim($rawResponse))) {
            static::deserializeResponse($model, $rawResponse);
            return $model;
        }

        $model->setRawResponse($rawResponse);

        $responses = explode("\n", trim($rawResponse));
        foreach ($responses as $current) {
            $model->addSentSMSMessage(static::deserializeSentSMSMessage($current));
        }

        return $model;
    }

    /**
     * Deserialize a transferring credits response.
     *
     * @param string $rawResponse The raw response.
     * @return TransferringCreditsResponse Returns the transferring credits response.
     */
    public static function deserializeTransferringCreditsResponse($rawResponse) {

        $model = new TransferringCreditsResponse();
        static::deserializeResponse($model, $rawResponse);

        return $model;
    }
}
