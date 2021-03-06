<?php

/*
 * This file is part of the smsmode-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Tests\Serializer;

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
use WBW\Library\SMSMode\Serializer\ResponseDeserializer;
use WBW\Library\SMSMode\Tests\AbstractTestCase;
use WBW\Library\SMSMode\Tests\Fixtures\Serializer\TestResponseDeserializer;

/**
 * Object deserializer test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Tests\Serializer
 */
class ResponseDeserializerTest extends AbstractTestCase {

    /**
     * Tests the deserializeAccountBalanceResponse() method.
     *
     * @return void
     */
    public function testDeserializeAccountBalanceResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "212.5";

        $obj = ResponseDeserializer::deserializeAccountBalanceResponse($rawResponse);
        $this->assertInstanceOf(AccountBalanceResponse::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals(212.5, $obj->getAccountBalance());
    }

    /**
     * Tests the deserializeAddingContactResponse() method.
     *
     * @return void
     */
    public function testDeserializeAddingContactResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Contact added";

        $obj = ResponseDeserializer::deserializeAddingContactResponse($rawResponse);
        $this->assertInstanceOf(AddingContactResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Contact added", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }

    /**
     * Tests the deserializeCheckingSMSMessageStatusResponse() method.
     *
     * @return void
     */
    public function testDeserializeCheckingSMSMessageStatusResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Sent";

        $obj = ResponseDeserializer::deserializeCheckingSMSMessageStatusResponse($rawResponse);
        $this->assertInstanceOf(CheckingSMSMessageStatusResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Sent", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }

    /**
     * Tests the deserializeCreatingAPIKeyResponse() method.
     *
     * @return void
     */
    public function testDeserializeCreatingAPIKeyResponse() {

        // Initialize a Raw response mock.
        $rawResponse = <<< EOT
{
    "id":"id",
    "accessToken":"accessToken",
    "creationDate":"21012019",
    "state":"state",
    "expiration":"22012019",
    "account":"account"
}
EOT;

        $obj = ResponseDeserializer::deserializeCreatingAPIKeyResponse($rawResponse);
        $this->assertInstanceOf(CreatingAPIKeyResponse::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("accessToken", $obj->getAccessToken());
        $this->assertEquals("account", $obj->getAccount());
        $this->assertEquals("2019-01-21", $obj->getCreationDate()->format("Y-m-d"));
        $this->assertEquals("2019-01-22", $obj->getExpiration()->format("Y-m-d"));
        $this->assertEquals("id", $obj->getId());
        $this->assertEquals("state", $obj->getState());
    }

    /**
     * Tests the deserializeCreatingSubAccountResponse() method.
     *
     * @return void
     */
    public function testDeserializeCreatingSubAccountResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Sub-account created";

        $obj = ResponseDeserializer::deserializeCreatingSubAccountResponse($rawResponse);
        $this->assertInstanceOf(CreatingSubAccountResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Sub-account created", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }

    /**
     * Tests the deserializeDeletingSMSResponse() method.
     *
     * @return void
     */
    public function testDeserializeDeletingSMSResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | SMS message deleted";

        $obj = ResponseDeserializer::deserializeDeletingSMSResponse($rawResponse);
        $this->assertInstanceOf(DeletingSMSResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("SMS message deleted", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }

    /**
     * Tests the deserializeDeletingSubAccountResponse() method.
     *
     * @return void
     */
    public function testDeserializeDeletingSubAccountResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Sub-account deleted";

        $obj = ResponseDeserializer::deserializeDeletingSubAccountResponse($rawResponse);
        $this->assertInstanceOf(DeletingSubAccountResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Sub-account deleted", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }

    /**
     * Tests the deserializeDeliveryReport() method.
     *
     * @return void
     */
    public function testDeserializeDeliveryReport() {

        // Initialize a Raw response mock.
        // $rawResponse = "33600000000 0"; /* A well formed raw response */
        $rawResponse = "  33600000000  0  "; /* A bad formed raw response */

        $obj = TestResponseDeserializer::deserializeDeliveryReport($rawResponse);
        $this->assertInstanceOf(DeliveryReport::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("33600000000", $obj->getNumero());
    }

    /**
     * Tests the deserializeDeliveryReport() method.
     *
     * @return void
     */
    public function testDeserializeDeliveryReportResponse() {

        // Initialize a Raw response mock.
        // $rawResponse = "33600000001 0 | 33600000002 2 | 33600000003 11"; /* A well formed delivery report. */
        $rawResponse = "  33600000001  0  |  33600000002  2  |  33600000003  11  "; /* A bad formed delivery report */

        $obj = ResponseDeserializer::deserializeDeliveryReportResponse($rawResponse);
        $this->assertInstanceOf(DeliveryReportResponse::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertCount(3, $obj->getDeliveryReports());

        $this->assertEquals(0, $obj->getDeliveryReports()[0]->getCode());
        $this->assertEquals("33600000001", $obj->getDeliveryReports()[0]->getNumero());

        $this->assertEquals(2, $obj->getDeliveryReports()[1]->getCode());
        $this->assertEquals("33600000002", $obj->getDeliveryReports()[1]->getNumero());

        $this->assertEquals(11, $obj->getDeliveryReports()[2]->getCode());
        $this->assertEquals("33600000003", $obj->getDeliveryReports()[2]->getNumero());
    }

    /**
     * Tests the deserializeDeliveryReport() method.
     *
     * @return void
     */
    public function testDeserializeDeliveryReportResponseWithException() {

        // Initialize a Raw response mock.
        $rawResponse = "31 | Internal error";

        $obj = ResponseDeserializer::deserializeDeliveryReportResponse($rawResponse);
        $this->assertInstanceOf(DeliveryReportResponse::class, $obj);

        $this->assertEquals(31, $obj->getCode());
        $this->assertEquals("Internal error", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertCount(0, $obj->getDeliveryReports());
    }

    /**
     * Tests the deserializeDeliveryReport() method.
     *
     * @return void
     */
    public function testDeserializeDeliveryReportWithoutArguments() {

        // Initialize a Raw response mock.
        // $rawResponse = "33600000000 0"; /* A well formed raw response */
        $rawResponse = "33600000000"; /* A bad formed raw response */

        $obj = TestResponseDeserializer::deserializeDeliveryReport($rawResponse);
        $this->assertInstanceOf(DeliveryReport::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertNull($obj->getNumero());
    }

    /**
     * Tests the deserializeResponse() method.
     *
     * @return void
     */
    public function testDeserializeResponse() {

        // Set a Sent SMS message response mock.
        $obj = new SendingSMSMessageResponse();

        // Initialize a Raw response mock.
        // $rawResponse = "0 | Sent"; /* A well formed raw response */
        $rawResponse = "0"; /* A bad formed raw response */

        TestResponseDeserializer::deserializeResponse($obj, $rawResponse);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }

    /**
     * Tests the deserializeRetrievingSMSReplyResponse() method.
     *
     * @return void
     */
    public function testDeserializeRetrievingSMSReplyResponse() {

        // Initialize a Raw response mock.
        $rawResponse = <<< EOT
responseID1 | 23012019-18:00 | 33600000001 | text1 | to1 | messageID1
responseID2 | 23012019-19:00 | 33600000002 | text2 | to2 | messageID2
responseID3 | 23012019-20:00 | 33600000003 | text3 | to3 | messageID3
EOT;

        $obj = ResponseDeserializer::deserializeRetrievingSMSReplyResponse($rawResponse);
        $this->assertInstanceOf(RetrievingSMSReplyResponse::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertCount(3, $obj->getSmsReplies());

        $this->assertEquals("33600000001", $obj->getSmsReplies()[0]->getFrom());
        $this->assertEquals("messageID1", $obj->getSmsReplies()[0]->getMessageID());
        $this->assertEquals("2019-01-23 18:00", $obj->getSmsReplies()[0]->getReceptionDate()->format("Y-m-d H:i"));
        $this->assertEquals("responseID1", $obj->getSmsReplies()[0]->getResponseID());
        $this->assertEquals("text1", $obj->getSmsReplies()[0]->getText());
        $this->assertEquals("to1", $obj->getSmsReplies()[0]->getTo());

        $this->assertEquals("33600000002", $obj->getSmsReplies()[1]->getFrom());
        $this->assertEquals("messageID2", $obj->getSmsReplies()[1]->getMessageID());
        $this->assertEquals("2019-01-23 19:00", $obj->getSmsReplies()[1]->getReceptionDate()->format("Y-m-d H:i"));
        $this->assertEquals("responseID2", $obj->getSmsReplies()[1]->getResponseID());
        $this->assertEquals("text2", $obj->getSmsReplies()[1]->getText());
        $this->assertEquals("to2", $obj->getSmsReplies()[1]->getTo());

        $this->assertEquals("33600000003", $obj->getSmsReplies()[2]->getFrom());
        $this->assertEquals("messageID3", $obj->getSmsReplies()[2]->getMessageID());
        $this->assertEquals("2019-01-23 20:00", $obj->getSmsReplies()[2]->getReceptionDate()->format("Y-m-d H:i"));
        $this->assertEquals("responseID3", $obj->getSmsReplies()[2]->getResponseID());
        $this->assertEquals("text3", $obj->getSmsReplies()[2]->getText());
        $this->assertEquals("to3", $obj->getSmsReplies()[2]->getTo());
    }

    /**
     * Tests the deserializeRetrievingSMSReplyResponse() method.
     *
     * @return void
     */
    public function testDeserializeRetrievingSMSReplyResponseWithException() {

        // Initialize a Raw response mock.
        $rawResponse = "32 | Authentication error";

        $obj = ResponseDeserializer::deserializeRetrievingSMSReplyResponse($rawResponse);
        $this->assertInstanceOf(RetrievingSMSReplyResponse::class, $obj);

        $this->assertEquals(32, $obj->getCode());
        $this->assertEquals("Authentication error", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertCount(0, $obj->getSmsReplies());
    }

    /**
     * Tests the deserializeSMSReply() method.
     *
     * @return void
     */
    public function testDeserializeSMSReply() {

        // Initialize a Raw response mock.
        // $rawResponse = "responseID | 23012019-18:00 | 33600000000 | text | to | messageID"; /* A well formed raw response */
        $rawResponse = "  responseID  |  23012019-18:00  |  33600000000  |  text  |  to  |  messageID  "; /* A bad formed raw response */

        $obj = TestResponseDeserializer::deserializeSMSReply($rawResponse);
        $this->assertInstanceOf(SMSReply::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("33600000000", $obj->getFrom());
        $this->assertEquals("messageID", $obj->getMessageID());
        $this->assertEquals("2019-01-23 18:00", $obj->getReceptionDate()->format("Y-m-d H:i"));
        $this->assertEquals("responseID", $obj->getResponseID());
        $this->assertEquals("text", $obj->getText());
        $this->assertEquals("to", $obj->getTo());
    }

    /**
     * Tests the deserializeSMSReply() method.
     *
     * @return void
     */
    public function testDeserializeSMSReplyWithoutArguments() {

        // Initialize a Raw response mock.
        // $rawResponse = "responseID | 23012019-18:00 | 33600000000 | text | to | messageID"; /* A well formed raw response */
        $rawResponse = "responseID | 23012019-18:00 | 33600000000 | text | to"; /* A bad formed raw response */

        $obj = TestResponseDeserializer::deserializeSMSReply($rawResponse);
        $this->assertInstanceOf(SMSReply::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertNull($obj->getFrom());
        $this->assertNull($obj->getMessageID());
        $this->assertNull($obj->getReceptionDate());
        $this->assertNull($obj->getResponseID());
        $this->assertNull($obj->getText());
        $this->assertNull($obj->getTo());
    }

    /**
     * Tests the deserializeSendingSMSBatchResponse() method.
     *
     * @return void
     */
    public function testDeserializeSendingSMSBatchResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Accepted | campagneID";

        $obj = ResponseDeserializer::deserializeSendingSMSBatchResponse($rawResponse);
        $this->assertInstanceOf(SendingSMSBatchResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Accepted", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("campagneID", $obj->getCampagneID());
    }

    /**
     * Tests the deserializeSendingSMSMessageResponse() method.
     *
     * @return void
     */
    public function testDeserializeSendingSMSMessageResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Accepted | smsID";

        $obj = ResponseDeserializer::deserializeSendingSMSMessageResponse($rawResponse);
        $this->assertInstanceOf(SendingSMSMessageResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Accepted", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("smsID", $obj->getSmsID());
    }

    /**
     * Tests the deserializeSendingTextToSpeechSMSResponse() method.
     *
     * @return void
     */
    public function testDeserializeSendingTextToSpeechSMSResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Accepted | smsID";

        $obj = ResponseDeserializer::deserializeSendingTextToSpeechSMSResponse($rawResponse);
        $this->assertInstanceOf(SendingTextToSpeechSMSResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Accepted", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("smsID", $obj->getSmsID());
    }

    /**
     * Tests the deserializeSendingUnicodeSMSResponse() method.
     *
     * @return void
     */
    public function testDeserializeSendingUnicodeSMSResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Accepted | smsID";

        $obj = ResponseDeserializer::deserializeSendingUnicodeSMSResponse($rawResponse);
        $this->assertInstanceOf(SendingUnicodeSMSResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Accepted", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals("smsID", $obj->getSmsID());
    }

    /**
     * Tests the deserializeSentSMSMessage() method.
     *
     * @return void
     */
    public function testDeserializeSentSMSMessage() {

        // Initialize a Raw response mock.
        // $rawResponse = "smsID | 23012019-18:00 | message | 33600000000 | 0.1 | 1"; /* A well formed raw response */
        $rawResponse = "  smsID  |  23012019-18:00  |  message  | 33600000000  |  0.1  |  1  "; /* A bad formed raw response */

        $obj = TestResponseDeserializer::deserializeSentSMSMessage($rawResponse);
        $this->assertInstanceOf(SentSMSMessage::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertEquals(0.1, $obj->getCostCredits());
        $this->assertEquals("message", $obj->getMessage());
        $this->assertEquals("33600000000", $obj->getNumero());
        $this->assertEquals(1, $obj->getRecipientCount());
        $this->assertEquals("2019-01-23 18:00", $obj->getSendDate()->format("Y-m-d H:i"));
        $this->assertEquals("smsID", $obj->getSmsID());
    }

    /**
     * Tests the deserializeSentSMSMessageListResponse() method.
     *
     * @return void
     */
    public function testDeserializeSentSMSMessageListResponse() {

        // Initialize a Raw response mock.
        $rawResponse = <<< EOT
smsID1 | 23012019-18:00 | message1 | 33600000001 | 0.1 | 1
smsID2 | 23012019-19:00 | message2 | 33600000002 | 0.2 | 2
smsID3 | 23012019-20:00 | message3 | 33600000003 | 0.3 | 3
EOT;

        $obj = ResponseDeserializer::deserializeSentSMSMessageListResponse($rawResponse);
        $this->assertInstanceOf(SentSMSMessageListResponse::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertCount(3, $obj->getSentSMSMessages());

        $this->assertEquals(0.1, $obj->getSentSMSMessages()[0]->getCostCredits());
        $this->assertEquals("message1", $obj->getSentSMSMessages()[0]->getMessage());
        $this->assertEquals("33600000001", $obj->getSentSMSMessages()[0]->getNumero());
        $this->assertEquals(1, $obj->getSentSMSMessages()[0]->getRecipientCount());
        $this->assertEquals("2019-01-23 18:00", $obj->getSentSMSMessages()[0]->getSendDate()->format("Y-m-d H:i"));
        $this->assertEquals("smsID1", $obj->getSentSMSMessages()[0]->getSmsID());

        $this->assertEquals(0.2, $obj->getSentSMSMessages()[1]->getCostCredits());
        $this->assertEquals("message2", $obj->getSentSMSMessages()[1]->getMessage());
        $this->assertEquals("33600000002", $obj->getSentSMSMessages()[1]->getNumero());
        $this->assertEquals(2, $obj->getSentSMSMessages()[1]->getRecipientCount());
        $this->assertEquals("2019-01-23 19:00", $obj->getSentSMSMessages()[1]->getSendDate()->format("Y-m-d H:i"));
        $this->assertEquals("smsID2", $obj->getSentSMSMessages()[1]->getSmsID());

        $this->assertEquals(0.3, $obj->getSentSMSMessages()[2]->getCostCredits());
        $this->assertEquals("message3", $obj->getSentSMSMessages()[2]->getMessage());
        $this->assertEquals("33600000003", $obj->getSentSMSMessages()[2]->getNumero());
        $this->assertEquals(3, $obj->getSentSMSMessages()[2]->getRecipientCount());
        $this->assertEquals("2019-01-23 20:00", $obj->getSentSMSMessages()[2]->getSendDate()->format("Y-m-d H:i"));
        $this->assertEquals("smsID3", $obj->getSentSMSMessages()[2]->getSmsID());
    }

    /**
     * Tests the deserializeSentSMSMessageListResponse() method.
     *
     * @return void
     */
    public function testDeserializeSentSMSMessageListResponseWithException() {

        // Initialize a Raw response mock.
        $rawResponse = "32 | Authentication error";

        $obj = ResponseDeserializer::deserializeSentSMSMessageListResponse($rawResponse);
        $this->assertInstanceOf(SentSMSMessageListResponse::class, $obj);

        $this->assertEquals(32, $obj->getCode());
        $this->assertEquals("Authentication error", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertCount(0, $obj->getSentSMSMessages());
    }

    /**
     * Tests the deserializeSentSMSMessage() method.
     *
     * @return void
     */
    public function testDeserializeSentSMSMessageWithoutArguments() {

        // Initialize a Raw response mock.
        // $rawResponse = "smsID | 23012019-18:00 | message | 33600000000 | 0.1 | 1"; /* A well formed raw response */
        $rawResponse = "smsID | 23012019-18:00 | message | 33600000000 | 0.1"; /* A bad formed raw response */

        $obj = TestResponseDeserializer::deserializeSentSMSMessage($rawResponse);
        $this->assertInstanceOf(SentSMSMessage::class, $obj);

        $this->assertNull($obj->getCode());
        $this->assertNull($obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());

        $this->assertNull($obj->getCostCredits());
        $this->assertNull($obj->getMessage());
        $this->assertNull($obj->getNumero());
        $this->assertNull($obj->getRecipientCount());
        $this->assertNull($obj->getSendDate());
        $this->assertNull($obj->getSmsID());
    }

    /**
     * Tests the deserializeTransferringCreditsResponse() method.
     *
     * @return void
     */
    public function testDeserializeTransferringCreditsResponse() {

        // Initialize a Raw response mock.
        $rawResponse = "0 | Transfer done";

        $obj = ResponseDeserializer::deserializeTransferringCreditsResponse($rawResponse);
        $this->assertInstanceOf(TransferringCreditsResponse::class, $obj);

        $this->assertEquals(0, $obj->getCode());
        $this->assertEquals("Transfer done", $obj->getDescription());
        $this->assertEquals($rawResponse, $obj->getRawResponse());
    }
}
