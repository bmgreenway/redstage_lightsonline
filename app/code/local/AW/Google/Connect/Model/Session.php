<?php


class AW_Google_Connect_Model_Session extends Mage_Core_Model_Abstract
{
    const PROFILE_DATA = 'profile_data';
    const PROFILE_PRIMARY_EMAIL = 'profile_primary_email';
    const GOOGLE_ID = 'id';
    const EMAILS = 'emails';
    const EMAILS_VALUE = 'value';
    const EMAILS_PRIMARY = 'primary';
    const DISPLAY_NAME = 'displayName';
    const JSON_DATA = 'data';
    const JSON_EMAIL = 'email';
    const JSON_IS_VERIFIED = 'isVerified';
    const JSON_VERIFIED_EMAIL = 'verified_email';
    const JSON_NAME = 'name';
    const JSON_FIRSTNAME = 'given_name';
    const JSON_LASTNAME = 'family_name';
    const OAUTH_COOKIE_NAME = 'googleconnector';

    const COOKIE_LIFETIME = 300000000; //~9.5 years


    static $SCOPES = array(
        'https://www.googleapis.com/auth/userinfo.profile',
        'https://www.googleapis.com/auth/userinfo.email'
    );

    public function connect()
    {
        $this->clearConnection();

        if (!$this->isInited()) {
            return null;
        }
        $client = $this->getClient();

        $state = mt_rand();
        $client->setState($state);
        $this->getSession()->setState($state);

        $authUrl = $client->createAuthUrl();

        return $authUrl;
    }

    public function callback()
    {
        if (!empty($_REQUEST['logout'])) {
            return true;
        }

        if (!($client = $this->getClient()) ||
            (strval($_GET['state']) !== strval($this->getSession()->getState()))
            || !isset($_GET['code'])
        ) {
            return false;
        }

        $this->unsState();

        try {
            $access_token = $client->authenticate();
            $access_token = $client->getAccessToken();
        } catch (Exception $e) {
            Mage::logException($e);
            return false;
        }

        if (!$access_token) {
            return false;
        }

        $this->setAccessToken($access_token);

        return true;
    }

    public function isInited()
    {
        return ($this->getClientId() && $this->getClientSecret() && $this->getRedirectUri());
    }

    public function isConnected()
    {
        return ($this->isInited() && $this->getClient() && $this->getSession()->getAccessToken());
    }

    public function getProfileData()
    {

        if ($profile = $this->_getData(self::PROFILE_DATA)) {
            return $profile;
        } else {
            if ($this->isConnected() && ($client = $this->getClient())) {
                $profile = array();
                try {
                    $service = $this->getApiPlusService();
                    $profile = (array)$service->people->get('me');
                } catch (apiServiceException $e) {
                    Mage::logException($e);
                } catch (Exception $e) {
                    Mage::logException($e);
                }


                // if doesn't exist google plus profile
                if (empty($profile[self::DISPLAY_NAME]) || empty($profile[self::EMAILS])) {
                    $httpRequest = new Google_HttpRequest('https://www.googleapis.com/oauth2/v2/userinfo?alt=json');
                    $httpRequest = $client->getIo()->authenticatedRequest($httpRequest);
                    if ((($decodedResponse = json_decode($httpRequest->getResponseBody(), true)) != false)
                        && (!empty($decodedResponse[self::JSON_EMAIL]) || !empty($decodedResponse[self::JSON_NAME]))
                    ) {
                        $profile = array_merge($profile, $decodedResponse);
                    }
                }
                $this->setData(self::PROFILE_DATA, $profile);
                return $profile;
            }
        }

        return null;
    }

    public function getPrimaryEmail()
    {
        if ($email = $this->_getData(self::PROFILE_PRIMARY_EMAIL)) {
            return $email;
        } else {
            //if exist google plus  profile
            if (($profile_data = $this->getProfileData()) && !empty($profile_data[self::JSON_EMAIL])) {
                $this->setData(self::PROFILE_PRIMARY_EMAIL, $profile_data[self::JSON_EMAIL]);
                return $profile_data[self::JSON_EMAIL];
            } //if doesn't exist plus profile
            else if (!empty($profile_data) && !empty($profile_data[self::EMAILS])
                && (is_array($profile_data[self::EMAILS]) || (!is_array($profile_data[self::EMAILS]) && strpos(strval($profile_data[self::EMAILS]), '@') > 0))
            ) {
                if (is_array($profile_data[self::EMAILS])) {
                    if (count($profile_data[self::EMAILS]) == 1) {
                        $email = array_shift($profile_data[self::EMAILS]);
                        $this->setData(self::PROFILE_PRIMARY_EMAIL, @$email[self::EMAILS_VALUE]);
                        return $email[self::EMAILS_VALUE];
                    }

                    foreach ($profile_data[self::EMAILS] as $email) {
                        if ($email[self::EMAILS_PRIMARY]) {
                            $this->setData(self::PROFILE_PRIMARY_EMAIL, $email[self::EMAILS_VALUE]);
                            return $email[self::EMAILS_VALUE];
                        }
                    }
                } else {
                    $this->setData(self::PROFILE_PRIMARY_EMAIL, strval($profile_data[self::EMAILS]));
                }
            } else {
                $httpRequest = new Google_HttpRequest('https://www.googleapis.com/userinfo/email?alt=json');
                $httpRequest = $this->getClient()->getIo()->authenticatedRequest($httpRequest);
                if ((($decodedResponse = json_decode($httpRequest->getResponseBody(), true)) != false)
                    && (!empty($decodedResponse[self::JSON_DATA][self::JSON_EMAIL]))
                    && (!empty($decodedResponse[self::JSON_DATA][self::JSON_IS_VERIFIED]))
                ) {
                    $this->setData(self::PROFILE_PRIMARY_EMAIL, $decodedResponse[self::JSON_DATA][self::JSON_EMAIL]);
                    return $decodedResponse[self::JSON_DATA][self::JSON_EMAIL];
                }
            }
        }

        return null;

    }

    public function getClient()
    {
        if (!$this->_getData('client')) {
            $client = new Google_Client();
            $client->setClientId($this->getClientId());
            $client->setClientSecret($this->getClientSecret());
            $client->setRedirectUri($this->getRedirectUri());
            $client->setApprovalPrompt('auto');
            $client->setScopes(self::$SCOPES);
            $service = new Google_PlusService($client);
            $this->setApiPlusService($service);
            $this->setData('client', $client);
        }

        $client = $this->_getData('client');
        if ($this->getSession()->getAccessToken()) {
            $client->setAccessToken($this->getSession()->getAccessToken());
        }

        return $client;
    }

    public function getService()
    {
        if (!$this->_getData('service')) {
            $service = new Google_PlusService($this->getClient());
            $this->setData('service', $service);
        }

        return $this->_getData('service');
    }

    public function googlePost($order_to_google)
    {
        return $this;
    }

    public function clearConnection()
    {
        $this->unsClient();
        $this->getSession()->unsApiPlusService();
        $this->getSession()->unsAccessToken();
        $this->unsState();
        $this->unsetData(self::PROFILE_DATA);
        $this->unsetData(self::PROFILE_PRIMARY_EMAIL);
    }


    public function setAccessToken($access_token)
    {
        $this->getSession()->setAccessToken($access_token);
    }

    protected function getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function setApiPlusService($service)
    {
        return $this->getSession()->setApiPlusService($service);
    }

    public function getApiPlusService()
    {
        return $this->getSession()->getApiPlusService();
    }
}
