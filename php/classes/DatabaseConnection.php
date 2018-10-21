<?php
    class DatabaseConnection {

		private $db_host =  "mysql:host=localhost;";
		private $db_name = "dbname=ember";
		private $db_user = "root";
		private $db_pass = "";
        protected $dbHolder;

        protected function open_connection() {
            $this->dbHolder = new PDO($this->db_host.$this->db_name, $this->db_user, $this->db_pass);
        }

        protected function close_connection() {
            $this->dbHolder = null;
        }

    }