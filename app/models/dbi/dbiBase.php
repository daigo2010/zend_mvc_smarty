<?php
require_once('Zend/Config/Xml.php');
require_once('Zend/Db.php');
class dbiBase 
{
  protected $config;
  protected $_db;

  public function __construct()
  {
    $this->config = new Zend_Config_Xml(dirname(APP_DIR) . '/config/config.xml', 'production');
    $this->_db = Zend_Db::factory($this->config->database);
  }
}
