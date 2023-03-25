<?php

namespace App\Core;

use JetBrains\PhpStorm\NoReturn;

trait Controller
{
	public function view($name)
	{
        $filename = APP_ROOT . "/views/pages/".$name.".view.php";

        if(!file_exists($filename)) {

            $filename = APP_ROOT . "/views/404.view.php";
        }
        require_once $filename;
    }

    /**
     * @param $data
     * @param array $httpHeaders
     */
    #[NoReturn] private function sendResponse($data, array $httpHeaders = []) :void
    {
        if (ob_get_contents()) ob_clean();

        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }

    /**
     * @param $data
     */
    #[NoReturn] function sendSuccess($data) :void
    {
        $this->sendResponse(
            json_encode($data),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }

    /**
     * @param $data
     */
    #[NoReturn] function sendError($data)
    {
        $this->sendResponse(
            json_encode($data),
            array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
        );
    }
}
