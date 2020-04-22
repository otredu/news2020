<?php
session_start();
set_include_path(dirname(__FILE__) . '/../');

require_once 'env.php';
require_once 'router/Request.php';
require_once 'router/Router.php';
require_once 'libraries/helpers.php';
require_once 'controllers/userManagement.php';
require_once 'controllers/articleManagement.php';

$router = new Router(new Request);

$router->get('/', function($request) {
  viewArticlesController();
});

$router->get('/uutiset', function($request) {
  viewArticlesController();
});

$router->get('/login', function($request) {
  loginController();
});

$router->post('/login', function($request) {
  loginController();
});

$router->get('/logout', function($request) {
  logoutController();
});

$router->get('/uusi_uutinen', function($request) {
  if(isLoggedIn()){
    addArticleController();
  } else {
    loginController();
  }
});

$router->post('/uusi_uutinen', function($request) {
  if(isLoggedIn()){
    addArticleController();
  } else {
    loginController();
  }
});

$router->get('/register', function($request) {
  registerController();
});

$router->post('/register', function($request) {
  registerController();
});

$router->get('/poista_uutinen', function($request) {
  $id = $request->parseId();
  if($id){
    deleteArticleController($id);
  } else {
    viewArticlesController();
  }
});

$router->get('/paivita_uutinen', function($request) {
  $id = $request->parseId();
  if($id){
    editArticleController($id);
  } else {
    viewArticlesController();
  }
});

$router->post('/paivita_uutinen', function($request) {
  $id = $request->parseId();
  if($id){
    updateArticleController($id);
  } else {
    viewArticlesController();
  }
});
