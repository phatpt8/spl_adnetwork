<?php
class Advertiser_BannerController extends Zend_Controller_Action{

    public function addAction() {
        $this->view->headTitle()->append('Advertiser Page');
        $this->_helper->layout->setLayout('advertiser');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            if ($this->_request->isPost()) {
                $title = trim(strip_tags($this->_request->getParam('title', '')));
                $image = trim(strip_tags($this->_request->getParam('image', '')));
                $clickUrl = trim(strip_tags($this->_request->getParam('clickUrl', '')));
                $mediaFile = trim(strip_tags($this->_request->getParam('mediafile', '')));
                $format = trim(strip_tags($this->_request->getParam('format', '')));
                $price = trim(strip_tags($this->_request->getParam('price', '')));
                $placement = trim(strip_tags($this->_request->getParam('placement', '')));
                $method = trim(strip_tags($this->_request->getParam('method', '')));
                list($width, $height) = explode('x',$placement);
                if (trim($title)==='' &&
                    trim($clickUrl)==='' &&
                    trim($format)==='' &&
                    trim($price)==='' &&
                    trim($method)==='' &&
                    trim($width)==='' &&
                    trim($height)==='') {
                    return false;
                }

                $uploadImgPath = '/upload/image/';
                $uploadMp4Path = '/upload/media/';

                if (!is_dir(ROOT_PATH . $uploadImgPath)) {
                    mkdir(ROOT_PATH . $uploadImgPath, 0777, true);
                }

                if (!is_dir(ROOT_PATH . $uploadMp4Path)) {
                    mkdir(ROOT_PATH . $uploadMp4Path, 0777, true);
                }

                $upload = new Zend_File_Transfer_Adapter_Http();

                $files = $upload->getFileInfo();
                $originalImage = pathinfo($upload->getFileName('uploadimage'));
                $originalVideo = pathinfo($upload->getFileName('uploadmediafile'));
                $upload->addValidator('FilesSize', false, 1048576 * 5);
                $upload->addValidator('Extension', false, 'jpeg,jpg,png,gif,mp4,webm');

                foreach ($files as $file => $info) {
                    if ($upload->isUploaded($file)) {
                        if ($upload->isValid($file))
                        {
                            if ($file == 'uploadimage') {
                                $imageUniqueName =  'img-' . uniqid() . '.' . $originalImage['extension'];
                                $upload->addFilter('Rename', ROOT_PATH . $uploadImgPath . $imageUniqueName);
                                $imageUrl = UPLOADED_IMAGE_URL . $imageUniqueName;
                            } elseif ($file == 'uploadmediafile') {
                                $mediaUniqueName = 'vid-' . uniqid() . '.' . $originalVideo['extension'];
                                $upload->addFilter('Rename', ROOT_PATH . $uploadMp4Path . $mediaUniqueName);
                                $mediaUrl = UPLOADED_MEDIA_URL .  $mediaUniqueName;
                            }
                            if ($upload->receive($file)) {
                                try {
                                    echo $file;
                                } catch(Zend_File_Transfer_Exception $e) {
                                    $this->redirect(SITE_URL . '/advertiser/index?err=uploadFailed' . 'Bad data: '.$e->getMessage());
                                }
                            }
                        } else {
                            $this->redirect(SITE_URL . '/advertiser/index?err=uploadFailed-' . 'Bad data: '.implode(',', $upload->getMessages()));
                        }
                    }
                }

                $encodeImgUrl = urlencode(trim($image) != '' ? $image : $imageUrl);
                $encodeMediaUrl = urlencode(trim($mediaFile) != '' ? $mediaFile : $mediaUrl);

                $info = array(
                    'title' => $title,
                    'file' => $encodeImgUrl,
                    'url' => $clickUrl,
                    'mediaFile' => $encodeMediaUrl
                );

                $strInfo = json_encode($info);
                $result = Admin_Model_Banner::createNewBanner($id, $price, $format, $width, $height, $method, $strInfo);
                if ($result) {
                    sleep(3);
                    $this->redirect(SITE_URL . '/advertiser/index?status=addSuccess');
                } else {
                    $this->redirect(SITE_URL . '/advertiser/index?err=addFailed');
                }
            }

            $this->view->headScript()->appendFile(STATIC_URL . '/js/library/jquery.form.js');
        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }

    public function editAction() {
        $this->view->headTitle()->append('Edit Banner');
        $this->_helper->layout->setLayout('advertiser');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            if ($this->_request->isGet()) {
                $val = $this->_request->getParams();
                $this->view->assign(array(
                    'editBanner' => $val
                ));
            }
            if ($this->_request->isPost()) {
                $bannerId = trim(strip_tags($this->_request->getParam('id', '')));
                $title = trim(strip_tags($this->_request->getParam('title', '')));
                $image = trim(strip_tags($this->_request->getParam('image', '')));
                $mediaFile = trim(strip_tags($this->_request->getParam('mediafile', '')));
                $clickUrl = trim(strip_tags($this->_request->getParam('clickUrl', '')));
                $format = trim(strip_tags($this->_request->getParam('format', '')));
                $price = trim(strip_tags($this->_request->getParam('price', '')));
                $placement = trim(strip_tags($this->_request->getParam('placement', '')));
                $method = trim(strip_tags($this->_request->getParam('method', '')));
                list($width, $height) = explode('x',$placement);

                $uploadImgPath = '/upload/image/';
                $uploadMp4Path = '/upload/media/';

                if (!is_dir(ROOT_PATH . $uploadImgPath)) {
                    mkdir(ROOT_PATH . $uploadImgPath, 0777, true);
                }

                if (!is_dir(ROOT_PATH . $uploadMp4Path)) {
                    mkdir(ROOT_PATH . $uploadMp4Path, 0777, true);
                }

                $upload = new Zend_File_Transfer_Adapter_Http();

                $files = $upload->getFileInfo();
                $uImage = $upload->getFileName('uploadimage');
                $uVideo = $upload->getFileName('uploadmediafile');
                $imageUrl = "";
                $mediaUrl = "";


                if (!empty($uImage)) {
                    $originalImage = pathinfo($upload->getFileName('uploadimage'));
                }
                if (!empty($uVideo)) {
                    $originalVideo = pathinfo($upload->getFileName('uploadmediafile'));
                }
                $upload->addValidator('FilesSize', false, 1048576 * 5);
                $upload->addValidator('Extension', false, 'jpeg,jpg,png,gif,mp4,webm');

                foreach ($files as $file => $info) {
                    if ($upload->isUploaded($file)) {
                        if ($upload->isValid($file))
                        {
                            if ($file == 'uploadimage') {
                                $imageUniqueName =  'img-' . uniqid() . '.' . $originalImage['extension'];
                                $upload->addFilter('Rename', ROOT_PATH . $uploadImgPath . $imageUniqueName);
                                $imageUrl = UPLOADED_IMAGE_URL . $imageUniqueName;
                            } elseif ($file == 'uploadmediafile') {
                                $mediaUniqueName = 'vid-' . uniqid() . '.' . $originalVideo['extension'];
                                $upload->addFilter('Rename', ROOT_PATH . $uploadMp4Path . $mediaUniqueName);
                                $mediaUrl = UPLOADED_MEDIA_URL .  $mediaUniqueName;
                            }
                            sleep(4);
                            if ($upload->receive($file)) {
                                try {

                                } catch(Zend_File_Transfer_Exception $e) {
                                    $this->redirect(SITE_URL . '/advertiser/index?err=uploadFailed' . 'Bad data: '.$e->getMessage());
                                }
                            }
                        } else {
                            $this->redirect(SITE_URL . '/advertiser/index?err=uploadFailed-' . 'Bad data: '.implode(',', $upload->getMessages()));
                        }
                    }
                }

                $encodeImgUrl = urlencode(trim($image) != '' ? $image : $imageUrl);
                $encodeMediaUrl = urlencode(trim($mediaFile) != '' ? $mediaFile : $mediaUrl);

                $info = array(
                    'title' => $title,
                    'file' => $encodeImgUrl,
                    'url' => $clickUrl,
                    'mediaFile' => $encodeMediaUrl
                );

                $strInfo = json_encode($info);

                $result = Admin_Model_Banner::updateBannerInfo($bannerId, $price, $format, $width, $height, $method, $strInfo, $id);
                if ($result == "1") {
                    $this->redirect(SITE_URL . '/advertiser/index?status=editSuccess');
                } else {
                    $this->redirect(SITE_URL . '/advertiser/index?err=editFailed');
                }

            }

        } else {
            $this->redirect(SITE_URL . '/user/login');
        }


    }

    public function updatestatusAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $bannerid = trim($this->_request->getParam('id', null));
            $status = trim($this->_request->getParam('status', null));
            $result = Admin_Model_Banner::updateBannerStatus($bannerid, $status);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/advertiser/index');
            } else {
                $this->redirect(SITE_URL . '/advertiser/index?err=updatestatusFailed');
            }
        }
    }

    public function analyzeAction() {
        $this->view->headTitle()->append('Analyze Banner');
        $this->_helper->layout->setLayout('advertiser');
        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;


            $arrBid = array();
            $result = Admin_Model_Banner::getAdvertiserBanners($id);
            foreach ($result as $key => $banner) {
                array_push($arrBid, $banner["BannerId"]);
            }

            $arrTrueview = Admin_Model_Banner::getBannerTrueviewAnalyze(join(",", $arrBid));
            foreach ($result as $key => $banner) {
                $result[$key]["Trueview"] = "0";
                foreach($arrTrueview as $trueview) {
                    if ($trueview["BannerId"] == $banner["BannerId"]) {
                        $result[$key]["Trueview"] = $trueview["Trueview"];
                    }
                }
            }
            $arrClick = Admin_Model_Click::getBannerClickCount(join(",", $arrBid));
            foreach ($result as $key => $banner) {
                $result[$key]["Click"] = "0";
                foreach($arrClick as $click) {
                    if ($click["BannerId"] == $banner["BannerId"]) {
                        $result[$key]["Click"] = $click["Click"];
                    }
                }
            }
            $this->view->bannerData = $result;

            $this->view->headScript()->appendFile(STATIC_URL . '/js/library/jquery.countTo.js');
        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }
}