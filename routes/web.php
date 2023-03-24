<?php


use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

/**
 * Pages
 */
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'Pages\PageController', 'method'=>'indexAction'),[], [], "", [], ["GET"]));

/**
 * Rest Api
 */
$routes->add('comment_get', new Route('/api/comment/get', ['controller' => 'Rest\CommentController', 'method'=>'showAction'], []));
$routes->add('comment_post', new Route('/api/comment/save', ['controller' => 'Rest\CommentController', 'method'=>'insertAction'], []));



