<?php

class AW_Facebook_Like_FacebookController extends Mage_Core_Controller_Front_Action
{
    public function likeAction()
    {
        $response = new Varien_Object();
        $response->setError(0);

        if ($this->_getHelper()->canGetPoints()) {
            $customer      = Mage::getSingleton('customer/session')->getCustomer();
            $customerId    = $customer->getId();
            $url           = $this->getRequest()->getParam('url');
            $pointsForLike = $this->_getHelper()->getPoints();

            $code = $this->getRequest()->getParam('code');
            if ($this->_getHelper()->getUrlSecretCode($url) !== $code) {
                $response->setError(1);
                $this->getResponse()->setBody($response->toJson());
                return;
            }

            switch ($this->getRequest()->getParam('action')) {
                case 'like':
                    $like_model =  Mage::getModel('facebookilike/like');
                    /*  already liked  */
                    if ($like_model->isAlreadyLiked($customerId, $url)) {
                        $response->setError(1);
                        $response->setMessage($this->__('Already liked'));
                        $this->getResponse()->setBody($response->toJson());
                        return;
                    }

                    /*    delay between retries     */
                    $timeToWait = $this->_getHelper()->getTimeToWait($customerId);
                    if ($timeToWait) {
                        $response->setError(1);
                        $response->setMessage($this->__("Please wait %s seconds", $timeToWait));
                        $this->getResponse()->setBody($response->toJson());
                        return;
                    }

                    /*   N likes per M seconds  */
                    if ($this->_getHelper()->limitLikesPerTimeReached($customerId)) {
                        $response->setError(1);
                        $response->setMessage($this->__("You've already reached the \"like\" limit"));
                        $this->getResponse()->setBody($response->toJson());
                        return;
                    }

                    /* save new like */
                    try {
                        $like = Mage::getModel('facebookilike/like');
                        $like->setCustomerId($customerId)
                            ->setLikeTime(Mage::getModel('core/date')->gmtTimestamp())
                            ->setUrl($this->getRequest()->getParam('url'))
                            ->save();

                        $pointsApi   = Mage::getModel('points/api');
                        $transaction = $pointsApi->addTransaction(
                            $pointsForLike, 'added_by_admin', $customer, null,
                            array('comment' => $this->__("Facebook Like"))
                        );
                        if (!$transaction) {
                            $response->setError(1);
                        } else {
                            $response->setMessage($this->__("You've just got <b>%s</b> point(s)", $pointsForLike));
                        }
                    } catch (Exception $exc) {
                        $response->setError(1);
                    }

                    break;

                case 'unlike':
                    $like = Mage::getModel('facebookilike/like')->getStoredLike($customerId, $url);
                    if ($like->getId()) {
                        try {
                            $like->delete();

                            $pointsApi   = Mage::getModel('points/api');
                            $transaction = $pointsApi->addTransaction(
                                -$pointsForLike, 'added_by_admin', $customer, null,
                                array('comment' => $this->__("Facebook Unlike"))
                            );
                            if (!$transaction) {
                                $response->setError(1);
                            } else {
                                $response->setMessage($this->__("Like and get <b>%s</b> point(s)", $pointsForLike));
                            }
                        } catch (Exception $exc) {
                            $response->setError(1);
                        }
                    }
                    break;
                default:
                    $response->setError(1);
                    break;
            }
        } else {
            $response->setError(1);
        }
        $this->getResponse()->setBody($response->toJson());
    }


    /**
     * @return AW_Facebook_Like_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookilike');
    }
}
