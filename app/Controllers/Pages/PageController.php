<?php 

namespace App\Controllers\Pages;

use App\Core\Controller;
use Symfony\Component\Routing\RouteCollection;

class PageController
{
    use Controller;
	public function indexAction(RouteCollection $routes)
	{
        $this->view("home");
	}
}
