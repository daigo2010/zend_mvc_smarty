<?php
require_once('Smarty.class.php');
require_once('Zend/View/Interface.php');
class Zend_View_Smarty implements Zend_View_Interface
{
  /**
   * Smarty object
   * @var Smarty
   */
  public $_smarty;

  /**
   * @param string $tmplPath
   * @param array $extraParams
   * @return void
   */
  public function __construct($tmplPath = null, $extraParams = array())
  {
      $this->_smarty = new Smarty;
      if (null !== $tmplPath) {
          $this->setScriptPath($tmplPath);
      }

      foreach ($extraParams as $key => $value) {
          $this->_smarty->$key = $value;
      }
  }

  /**
   *
   * @return Smarty
   */
  public function getEngine()
  {
      return $this->_smarty;
  }

  /**
   *
   * @return void
   */
  public function setScriptPath($path)
  {
      if (is_readable($path)) {
          $this->_smarty->template_dir = $path;
          return;
      }
      throw new Exception('');
  }

  /**
   *
   * @return string
   */
  public function getScriptPaths()
  {
      return array($this->_smarty->template_dir);
  }

  /**
   *
   * @param string $path
   * @param string $prefix Unused
   * @return void
   */
  public function setBasePath($path, $prefix = 'Zend_View')
  {
      return $this->setScriptPath($path);
  }

  /**
   * @param string $path
   * @param string $prefix Unused
   * @return void
   */
  public function addBasePath($path, $prefix = 'Zend_View')
  {
      return $this->setScriptPath($path);
  }

  /**
   *
   * @param string $key 
   * @param mixed $val
   * @return void
   */
  public function __set($key, $val)
  {
      $this->_smarty->assign($key, $val);
  }

  /**
   * @return boolean
   */
  public function __isset($key)
  {
      return (null !== $this->_smarty->get_template_vars($key));
  }

  /**
   * @return void
   */
  public function __unset($key)
  {
      $this->_smarty->clear_assign($key);
  }

  /**
   * @return void
   */
  public function assign($spec, $value = null)
  {
      if (is_array($spec)) {
          $this->_smarty->assign($spec);
          return;
      }
      $this->_smarty->assign($spec, $value);
  }

  /**
   *
   * @return void
   */
  public function clearVars()
  {
      $this->_smarty->clear_all_assign();
  }

  public function render($name)
  {
      return $this->_smarty->fetch($name);
  }
}
