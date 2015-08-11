<?php


class AW_Google_Connect_Model_Customer extends Mage_Customer_Model_Customer
{
    protected $_google;

    public function loadByGoogleEmail($customerEmail = null)
    {
        if (is_null($customerEmail)) {
            $customerEmail = $this->getUserEmail();
            if (empty($customerEmail)) {
                return $this;
            }
        }
        return parent::loadByEmail($customerEmail);
    }

    public function create()
    {

        $customerData = $this->getUserInfo();
        $customerEmail = $this->getUserEmail();
        if (empty($customerEmail)) {
            Mage::getSingleton('customer/session')->addException(null, $this->__('Cannot create the customer.'));
        }

        $importData['website'] = Mage::app()->getStore()->getWebsite()->getCode();
        $importData['email'] = $customerEmail;

        if (!empty($customerData[AW_Google_Connect_Model_Session::JSON_FIRSTNAME])
            && !empty($customerData[AW_Google_Connect_Model_Session::JSON_LASTNAME])
        ) {
            $importData['firstname'] = $customerData[AW_Google_Connect_Model_Session::JSON_FIRSTNAME];
            $importData['lastname'] = $customerData[AW_Google_Connect_Model_Session::JSON_LASTNAME];
        } else {
            $customer_name = $customerData[AW_Google_Connect_Model_Session::DISPLAY_NAME];
            $name_parts = explode(' ', $customer_name);
            if (is_array($name_parts)) {
                $parts_count = count($name_parts);
                if ($parts_count == 2) {
                    $importData['firstname'] = $name_parts[0];
                    $importData['lastname'] = $name_parts[1];
                } else if ($parts_count == 3) {
                    if (strpos($name_parts[0], '.')) {
                        $importData['prefix'] = $name_parts[0];
                        $importData['firstname'] = $name_parts[1];
                        $importData['lastname'] = $name_parts[2];
                    } else if (strpos($name_parts[2], '.')) {
                        $importData['firstname'] = $name_parts[0];
                        $importData['lastname'] = $name_parts[1];
                        $importData['suffix'] = $name_parts[2];
                    } else {
                        $importData['firstname'] = $name_parts[0];
                        $importData['middlename'] = $name_parts[1];
                        $importData['lastname'] = $name_parts[2];
                    }
                } else if ($parts_count == 4) {
                    if (strpos($name_parts[3], '.')) {
                        if (strpos($name_parts[0], '.')) {
                            $importData['prefix'] = $name_parts[0];
                            $importData['firstname'] = $name_parts[1];
                            $importData['lastname'] = $name_parts[2];
                        } else {
                            $importData['firstname'] = $name_parts[0];
                            $importData['middlename'] = $name_parts[1];
                            $importData['lastname'] = $name_parts[2];
                        }
                        $importData['suffix'] = $name_parts[3];
                    } else {
                        $importData['prefix'] = $name_parts[0];
                        $importData['firstname'] = $name_parts[0];
                        $importData['middlename'] = $name_parts[1];
                        $importData['lastname'] = $name_parts[2];
                    }
                } else if ($parts_count == 5) {
                    $importData['prefix'] = $name_parts[0];
                    $importData['firstname'] = $name_parts[1];
                    $importData['middlename'] = $name_parts[2];
                    $importData['lastname'] = $name_parts[3];
                    $importData['suffix'] = $name_parts[4];
                } else {
                    $importData['firstname'] = $customer_name;
                    $importData['lastname'] = ' ';
                }
            } else {
                $importData['firstname'] = $customer_name;
                $importData['lastname'] = ' ';
            }
        }

        $convertAdapter = Mage::getModel('customer/convert_adapter_customer');

        $customer = $convertAdapter->getCustomerModel();
        $pass = $customer->generatePassword(8);
        $hash = $customer->hashPassword($pass);
        $importData['password_hash'] = $hash;


        /* @var $convertAdapter Mage_Customer_Model_Convert_Adapter_Customer */
        if (($customerGroups = $convertAdapter->getCustomerGroups()) && !empty($customerGroups) && is_array($customerGroups)) {
            if (array_key_exists('General', $customerGroups)) {
                $importData['group'] = 'General';
                $importData['group_id'] = 'General';
            } else {
                $group_keys = array_keys($customerGroups);
                $importData['group'] = $group_keys[0];
                $importData['group_id'] = $group_keys[0];
            }

        } else {
            $importData['group'] = 'General';
            $importData['group_id'] = 'General';
        }


        try {
            $convertAdapter->saveRow($importData);
        } catch (Exception $e) {
            Mage::getSingleton('customer/session')->addException($e, $this->__('Cannot create the customer.'));
        }

        $this->load($convertAdapter->getCustomerModel()->getId());

        if ($this->getConfirmation()) {
            $this->setConfirmation(null)->save();
            $this->setIsJustConfirmed(true);
        }

        $synch = Mage::getModel('googleconnect/synch')
            ->setData('customer_id', $this->getId())
            ->setData('google_id', $customerData[AW_Google_Connect_Model_Session::GOOGLE_ID])
            ->setData('access_token', $this->getConnection()->getAccessToken())
            ->setData('googleconnect_cookie', $this->getConnection()->getCookie(false))
            ->save();

        if ($this->getHelper()->isEnableNotify()) {

            $emailTemplate = Mage::getModel('core/email_template');
            $emailTemplate->sendTransactional(
                $this->getHelper()->getEmailTemplate(),
                $this->getHelper()->getEmailIdentity(),
                $importData['email'],
                $importData['firstname'] . " " . $importData['lastname'],
                array('email' => $importData['email'], 'pass' => $pass)
            );
        }

        return $this;
    }

    public function login()
    {
        $customer_session = Mage::getSingleton('customer/session');
        /* @var $customer_session Mage_Customer_Model_Session */
        $customer_session->setCustomerAsLoggedIn($this);
    }

    public function getUserInfo()
    {
        $userData = $this->_getData('user_info');
        if (is_null($userData)) {
            if ($connection = $this->getConnection()) {
                $userData = $connection->getProfileData();
            } else {
                $userData = null;
            }
            $this->setData('user_info', $userData);
        }

        return $userData;
    }

    public function getUserEmail()
    {
        $userEmail = $this->_getData('user_email');
        if (is_null($userEmail)) {
            if ($connection = $this->getConnection()) {
                $userEmail = $connection->getPrimaryEmail();
            }
            $this->setData('user_email', $userEmail);
        }

        return $userEmail;
    }

    public function setConnection($google)
    {
        $this->_google = $google;

        return $this;
    }

    public function getConnection()
    {
        return $this->_google;
    }

    /**
     * @return AW_Google_Connect_Helper_Data
     */
    public function getHelper()
    {
        return Mage::helper('googleconnect');
    }
}