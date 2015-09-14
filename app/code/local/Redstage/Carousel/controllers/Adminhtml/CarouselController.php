<?php

class Redstage_Carousel_Adminhtml_CarouselController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $slide = Mage::getModel('carousel/slide');
        if ($id) {
            $slide->load($id);
            if ($slide->getId()) {
                $slideData = Mage::getSingleton('adminhtml/session')->getSlideData();
                if ($slideData) {
                    $slide->setData($slideData)->setSlideId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('carousel')->__('Slide does not exist.'));
            }
        } 

        Mage::register('slide_data', $slide);

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            $slide = Mage::getModel('carousel/slide');

            if (isset($_FILES['image']['name']) && file_exists($_FILES['image']['tmp_name']) && $_FILES['image']['name'] != '') {
                try {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $mediaPath = Mage::getBaseDir('media') . DS . 'carousel-images' . DS;
                    $uploadResult = $uploader->save($mediaPath, $_FILES['image']['name']);
                    $slide->setImage(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'carousel-images/' . $uploadResult['file']);
                } catch (Exception $e) {
                    Mage::getModel('adminhtml/session')->addFailure('Error occurred saving image file.');
                    Mage::getModel('adminhtml/session')->setSlideData($this->getRequest()->getPost());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                    return;
                }
            }

            try {
                $slideData = $this->getRequest()->getPost();
                $slide->setId($this->getRequest()->getParam('id'))
                    ->setActive($slideData['active'])
                    ->setSortOrder($slideData['sort_order'])
                    ->setName($slideData['name'])
                    ->setCaption($slideData['caption'])
                    ->setLink($slideData['link'])
                    ->setStoreId($slideData['store_id']);

                $slide->save();

                Mage::getModel('adminhtml/session')->addSuccess('Slide saved.');
                Mage::getModel('adminhtml/session')->setSlideData(false);

                $this->_redirect('*/*');
                return;
            } catch (Exception $e) {
                Mage::getModel('adminhtml/session')->addFailure('Could not save slide.');
                Mage::getModel('adminhtml/session')->setSlideData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }

        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($slide = Mage::getModel('carousel/slide')->load($id)) {
            try {
                $slide->delete();
                Mage::getModel('adminhtml/session')->addSuccess('Slide deleted.');
                Mage::getModel('adminhtml/session')->setSlideData(false);
                $this->_redirect('*/*');
                return;
            } catch (Exception $e) {
                Mage::getModel('adminhtml/session')->addFailure('Could not delete slide.');
                Mage::getModel('adminhtml/session')->setSlideData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
    }
}
