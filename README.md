# WHMCS AWS SES

This is just a simple plugin to allow you to use AWS SES through API instead of using SMTP.

## Installation

 - Download the source code from the latest release.
 - Upload module source code to /yourwhmcsdir/modules/mail/
 - Go to your WHMCS Admin, then go to System Settings->General Settings->Mail.
 - Click Configure Mail Provider and switch the Mail Provider to AWSMail.
 - Fill in your credentials from AWS
 - Click Test Configuration. If there are no errors, AWS SES will send an email to the current administrator.
 - You can Save it at this time.