<?php
class IndexController extends Zend_Controller_Action
{
  public function indexAction()
  {
    $this->view->assign('a', 'test6');
    echo "test2";
  }
}
