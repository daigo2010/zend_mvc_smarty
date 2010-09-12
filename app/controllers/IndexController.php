<?php
class IndexController extends Zend_Controller_Action
{
  public function indexAction()
  {
require_once(APP_DIR . "models/dbi/IndexDbi.php");
$dbi = new IndexDbi();
$rs = $dbi->select();
var_dump($rs);

    $this->view->assign('a', 'test6');
    echo "test2";
  }
}
