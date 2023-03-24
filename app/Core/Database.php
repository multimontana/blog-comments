<?php 
namespace App\Core;


use JetBrains\PhpStorm\NoReturn;
use PDO;

Trait Database
{
    /**
     * @return PDO
     */
	private function connect() :PDO
	{
		$string = "mysql:hostname=".DB_HOST.";dbname=".DB_NAME;

        return new PDO($string,DB_USER,DB_PASS);
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


