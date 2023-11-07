<?php
require_once 'imodel.php';
class Model {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
}
