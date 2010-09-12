<?php
require_once('dbiBase.php');
class IndexDbi extends dbiBase
{
  public function __construct()
  {
    parent::__construct();
  }

  public function select()
  {
    $sql = "SELECT * FROM top_data";

    $rel = $this->_db->query($sql);
    return $rel->fetchAll();
  }
}
