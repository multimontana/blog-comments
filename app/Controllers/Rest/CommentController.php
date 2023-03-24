<?php

namespace App\Controllers\Rest;

use App\Core\Controller;
use App\Models\Comment;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Routing\RouteCollection;

class CommentController
{
    use Controller;

    /**
     * @param RouteCollection $routes
     */
    #[NoReturn] public function showAction(RouteCollection $routes)
    {
        $comment = new Comment();
        $this->sendSuccess(["data" => $comment->findAll()]);
    }

    /**
     * @param RouteCollection $routes
     */
    #[NoReturn] public function insertAction(RouteCollection $routes)
    {
        $comment = new Comment();
        if ($comment->validate($_POST)) {
            $inserted = $comment->insert($_POST);
            $this->sendSuccess(["data" => is_array($inserted) ? "Success" : "Something Went Wrong"]);
        } else {
            $this->sendError(["data" => [
                "errors" => $comment->errors
            ]]);
        }
    }
}
