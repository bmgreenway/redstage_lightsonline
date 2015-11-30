    <?php

    class Redstage_ShellIndexer_Block_Adminhtml_Process extends Enterprise_Index_Block_Adminhtml_Process {
        public function __construct()
        {
        $this->_blockGroup = 'enterprise_index';
        $this->_controller = 'adminhtml_process';
        $this->_headerText = Mage::helper('index')->__('Index Management');

        parent::__construct();

        $this->_removeButton('add');
        $url = Mage::helper("adminhtml")->getUrl("/process/shell");
        $script = "new Ajax.Request('".$url."',{method:'post'});";
         $this->_addButton('Shell ReIndex', array(
                          'label' => Mage::helper('index')->__('Shell Re-Index'),
                          'onclick' => $script,
                          'class' => 'save',
                ), -100);
    }
}
