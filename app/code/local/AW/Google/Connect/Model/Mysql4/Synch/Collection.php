<?php


class AW_Google_Connect_Model_Mysql4_Synch_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('googleconnect/synch');
    }

    public function getSynchByCookie($cookie)
    {
        static $return = array();

        if (!array_key_exists($cookie, $return)) {
            $items = $this->addFilter('googleconnect_cookie', $cookie)
                ->setOrder($this->getResource()->getIdFieldName(), 'DESC')
                ->getItems();

            $return[$cookie] = (empty($items) ? null : array_shift($items));
        }

        return $return[$cookie];
    }

    public function getSynchByGoogleId($id)
    {
        static $return = array();

        if (!array_key_exists($id, $return)) {
            $items = $this->addFilter('google_id', $id)
                ->setOrder($this->getResource()->getIdFieldName(), 'DESC')
                ->getItems();

            $return[$id] = (empty($items) ? null : array_shift($items));
        }

        return $return[$id];
    }

    public function getSynchByAccessToken($token)
    {
        static $return = array();

        if (!array_key_exists($token, $return)) {
            $items = $this->addFilter('access_token', $token)
                ->setOrder($this->getResource()->getIdFieldName(), 'DESC')
                ->getItems();

            $return[$token] = (empty($items) ? null : array_shift($items));
        }

        return $return[$token];
    }
}