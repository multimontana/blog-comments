<?php
require_once dirname(dirname(__FILE__)). "/config/config.php";
exec("mysql -u" . DB_USER ." -p " . DB_NAME . " < db_structure.sql ");
