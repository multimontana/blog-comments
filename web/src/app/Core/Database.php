<?php
namespace App\Core;

use JetBrains\PhpStorm\NoReturn;
use PDO;

Trait Database
{
    /**
     * @return PDO
     */
	private function connect(): PDO
    {
        try {
            $connection = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            return new PDO($connection, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * @param $query
     * @param array $data
     * @return bool|array
     */
	#[NoReturn] public function query($query, array $data = []): bool|array
    {

		$con = $this->connect();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);

		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);

			if(is_array($result))
			{
				return $result;
			}
		}
		return false;
	}

}


