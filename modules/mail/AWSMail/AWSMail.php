<?php

namespace WHMCS\Module\Mail;

require __DIR__ . '/vendor/autoload.php';

use WHMCS\Exception\Mail\SendFailure;
use WHMCS\Exception\Module\InvalidConfiguration;
use WHMCS\Mail\Message;
use WHMCS\Module\Contracts\SenderModuleInterface;
use WHMCS\Module\MailSender\DescriptionTrait;
use WHMCS\Database\Capsule;
use Aws\Exception\AwsException;
use Aws\Ses\SesClient;

class AWSMail implements SenderModuleInterface
{
    use DescriptionTrait;
    
    /**
     * Constructor
     *
     * Any instance of a mail module should have the display name at the ready.
     * Therefore it is recommend to ensure these
     * values are set during object instantiation.
     *
     * @see \WHMCS\Module\MailSender\DescriptionTrait::setDisplayName()
     */
    public function __construct()
    {
        $this->setDisplayName('AWSMail');
    }

    /**
     * An array of configuration options for the Mail Provider.
     *
     * @return array
     */
    public function settings()
    {
        return [
            'region' => [
                'FriendlyName' => 'AWS Region',
                'Type' => 'text',
                'Description' => 'Region where your AWS SES service is hosted, e.g., us-east-1.',
            ],
            'access_key' => [
                'FriendlyName' => 'AWS Access Key',
                'Type' => 'text',
                'Description' => 'The access key for the AWS SES service.',
            ],
            'secret_key' => [
                'FriendlyName' => 'AWS Secret Key',
                'Type' => 'password',
                'Description' => 'The secret key for the AWS SES service.',
            ],
        ];
    }

    /**
     * Test the connection to the Mail Provider.
     *
     * @param array $params Module configuration parameters.
     * @throws InvalidConfiguration On error, InvalidConfiguration will be thrown.
     */
    public function testConnection(array $params)
    {
        $client = $this->getAWSClient($params);
        $adminid = $_SESSION['adminid'];
        $adminemail = Capsule::table('tbladmins')->where('id', $adminid)->value('email');
        $sendEmail = $GLOBALS['CONFIG']['CompanyName'] . ' <' . $GLOBALS['CONFIG']['Email'] . '>';
        $subject = 'AWS Email Server Connection Test';
        $plainTextBody = 'When you receive this email, it means that you can connect to this AWS SES server.';
        $htmlBody = '<p>When you receive this email, it means that you can connect to this AWS SES server.</p>';

        // Create a new message
        $result = $client->sendEmail([
            'Source' => $sendEmail,
            'Destination' => [
                'ToAddresses' => [$adminemail],
            ],
            'Message' => [
                'Subject' => [
                    'Data' => $subject,
                ],
                'Body' => [
                    'Text' => [
                        'Data' => $plainTextBody,
                    ],
                    'Html' => [
                        'Data' => $htmlBody,
                    ],
                ],
            ],
        ]);

        return $result;
    }

    /**
     * Send an email.
     *
     * @param array $params Module configuration parameters.
     * @param Message $message The Message object containing details specific to the message.
     *
     * @return void
     * @throws SendFailure
     */
    public function send(array $params, Message $message)
    {
        $client = $this->getAWSClient($params);
        $subject = $message->getSubject();
        $body = $message->getBody();
        $plainTextBody = $message->getPlainText();
        $destinations = [];
        $fromSend = $message->getFromName() . ' <' . $message->getFromEmail() . '>';
        $subject = $message->getSubject();
        $attachments = [];
        $messageArray = [
            'Source' => $fromSend,
            'Message' => [
                'Subject' => [
                    'Data' => $subject,
                ],
                'Body' => [
                    'Text' => [
                        'Data' => $plainTextBody,
                    ],
                    'Html' => [
                        'Data' => $body,
                    ],
                ],
            ],
        ];



        // set replyto if available
        if ($message->getReplyTo()) {
            $destinations['ReplyToAddresses'][] = $message->getReplyTo()['name'] . ' <' . $message->getReplyTo()['email'] . '>';
        }
        
        // Set recipients
        foreach ($message->getRecipients('to') as $to) {
            $destinations['ToAddresses'][] = $to[1] . ' <' . $to[0] . '>';
        }
        foreach ($message->getRecipients('cc') as $to) {
            $destinations['CcAddresses'][] = $to[1] . ' <' . $to[0] . '>';
        }
        foreach ($message->getRecipients('bcc') as $to) {
            $destinations['BccAddresses'][] = $to[1] . ' <' . $to[0] . '>';
        }

        if (!empty($destinations)) {
            $messageArray['Destination'] = $destinations;
        } else {
            throw new SendFailure('No recipients specified for the email.');
        }

        // Set attachments
        foreach ($message->getAttachments() as $attachment) {
            if (array_key_exists('data', $attachment)) {
                $attachments[] = [
                    'ContentDisposition' => 'ATTACHMENT',
                    'Filename' => $attachment['filename'],
                    'RawContent' => base64_encode($attachment['data']),
                ];
            } else {
                $attachments[] = [
                    'ContentDisposition' => 'ATTACHMENT',
                    'Filename' => $attachment['filename'],
                    'RawContent' => base64_encode(file_get_contents($attachment['filepath'])),
                ];
            }
        }

        // Attachments are not directly supported in AWS SES sendEmail API.
        if (!empty($attachments)) {
            // $messageArray['Message']['Attachments'] = $attachments;
        }

        // Send the message and get the result
        try {
            $result = $client->sendEmail($messageArray);
        } catch (AwsException $e) {
            throw new InvalidConfiguration('Failed to send AWS SES email: ' . $e->getMessage());
        }

        return $result;
    }

    /**
     * 
     * @param array $params 
     * @return SesClient 
     */
    private function getAWSClient(array $params)
    {
        try {
            $client = new \Aws\Ses\SesClient([
                'version' => '2010-12-01',
                'region' => $params['region'],
                'credentials' => [
                    'key' => $params['access_key'],
                    'secret' => $params['secret_key'],
                ],
            ]);
            return $client;
        } catch (AwsException $e) {
            throw new InvalidConfiguration('Failed to create AWS SES client: ' . $e->getMessage());
        }
    }
}