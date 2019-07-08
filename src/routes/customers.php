<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../model/modelcore.php';

$app = new \Slim\App;

$model = new ModelCore;

// var_dump($model);

// Get All Customers
$app->get('/api/customers', function(Request $request, Response $response) use($model){
        
        $model->table_name = "customers";

        $data = $model->getAll();
        if(!$data){
            return $response->withJson($data, 200);
        } else {
            return $response->withJson($data, 404);
        }
        

});

