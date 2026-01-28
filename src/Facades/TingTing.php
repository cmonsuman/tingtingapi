<?php

namespace TingTing\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \TingTing\Laravel\TingTingClient setToken(string $token)
 * @method static \TingTing\Laravel\TingTingClient setApiToken(string $token)
 * @method static array login(string $email, string $password)
 * @method static array refreshToken(string $refresh)
 * @method static array generateApiKeys()
 * @method static array getApiKeys()
 * @method static array userDetail()
 * @method static array activeBrokerPhones()
 * @method static array activeUserPhones()
 * @method static array listCampaigns()
 * @method static array createCampaign(array $data)
 * @method static array updateCampaign(int $campaignId, array $data)
 * @method static array deleteCampaign(int $campaignId)
 * @method static array runCampaign(int $campaignId)
 * @method static array addVoiceAssistance(int $campaignId, array $data)
 * @method static array addIndividualContact(int $campaignId, array $data)
 * @method static array addBulkContacts(int $campaignId, mixed $bulkData)
 * @method static array listContacts(int $campaignId)
 * @method static array deleteContact(int $contactId)
 * @method static array getContactAttributes(int $contactId)
 * @method static array editContactAttributes(int $contactId, array $attributes)
 * @method static array updateContactNumber(int $contactId, string $number)
 * @method static array sendOtp(array $data)
 * @method static array listSentOtps()
 *
 * @see \TingTing\Laravel\TingTingClient
 */
class TingTing extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'tingting';
    }
}
