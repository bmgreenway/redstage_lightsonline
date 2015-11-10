<?php

class AW_Facebook_Like_Model_System_Config_Source_Action
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'like', 'label' => 'like'),
            array('value' => 'recommend', 'label' => 'recommend'),
        );
    }
}
