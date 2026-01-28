# TingTing Laravel API Package

A robust Laravel package for integrating with the [TingTing AI-powered telephony system](https://tingting.io). Send programmed voice calls and SMS in Nepali with ease.

## Features

- **Authentication**: JWT Login, Refresh, Static API Token support, and User Details.
- **Phone Numbers**: List active broker and account-assigned phone numbers.
- **Campaign Management**: Full CRUD for campaigns, run campaigns, and add specific voice assistance.
- **Contact Management**: Add individual or bulk contacts, manage custom attributes, and update information.
- **OTP Services**: Send OTPs via voice/text and retrieve logs of sent OTPs.

## Installation

Add the repository to your `composer.json`:

```json
"repositories": [
    {
        "type": "path",
        "url": "../TingTingAPI"
    }
],
"require": {
    "tingting/laravel": "*"
}
```

Then run:

```bash
composer update tingting/laravel
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag="tingting-config"
```

Configure your credentials in `.env`:

```env
TINGTING_BASE_URL=https://app.tingting.io/api/v1/
TINGTING_API_TOKEN=your_static_api_token
TINGTING_EMAIL=your_email
TINGTING_PASSWORD=your_password
```

## Available Methods

The package provides a `TingTing` facade with the following capabilities:

### Authentication
- `login(string $email, string $password)`
- `refreshToken(string $refresh)`
- `generateApiKeys()` (Generate static token)
- `getApiKeys()` (Retrieve static token)
- `userDetail()`
- `setToken(string $token)` (Manual token override)
- `setApiToken(string $token)` (Alias for setToken)

### Phone Numbers
- `activeBrokerPhones()`
- `activeUserPhones()`

### Campaigns
- `listCampaigns()`
- `createCampaign(array $data)`
- `updateCampaign(int $id, array $data)`
- `deleteCampaign(int $id)`
- `runCampaign(int $id)`
- `addVoiceAssistance(int $id, array $data)`

### Contact Management
- `addIndividualContact(int $campaignId, array $data)`
- `addBulkContacts(int $campaignId, mixed $bulkData)`
- `listContacts(int $campaignId)`
- `deleteContact(int $contactId)`
- `getContactAttributes(int $contactId)`
- `editContactAttributes(int $contactId, array $attributes)`
- `updateContactNumber(int $contactId, string $number)`

### OTP Services
- `sendOtp(array $data)`
- `listSentOtps()`

## Basic Usage

```php
use TingTing\Laravel\Facades\TingTing;

// User Detail Example
$user = TingTing::userDetail();

// Send OTP Example
$response = TingTing::sendOtp([
    'number' => '9800000000',
    'message' => 'तपाईको रिसेटिंग कोड १२३४ हो',
    'sms_send_options' => 'voice',
    'otp_length' => 4,
    'otp_options' => 'generated',
]);
```

For more detailed examples, see the [Walkthrough](file:///home/rajeeb-shakya/.gemini/antigravity/brain/584028be-610c-4cd9-90c2-128de4114e41/walkthrough.md).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
