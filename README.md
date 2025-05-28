# WHMCS AWS SES

This is just a simple plugin to allow you to use AWS SES through API instead of using SMTP.

## Warning

Currently doesn't support sending attachments. So if you need to send attachments, it will need to be rewritten to send as RAW. see <https://docs.aws.amazon.com/ses/latest/APIReference/API_SendRawEmail.html>

## Installation

- Download the source code from the latest release.
- Upload module source code to /yourwhmcsdir/modules/mail/
- Go to your WHMCS Admin, then go to System Settings->General Settings->Mail.
- Click Configure Mail Provider and switch the Mail Provider to AWSMail.
- Fill in your credentials from AWS
- Click Test Configuration. If there are no errors, AWS SES will send an email to the current administrator.
- You can Save it at this time.
