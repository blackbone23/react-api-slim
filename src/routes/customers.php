<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../model/modelcore.php';

$app = new \Slim\App;

$model = new ModelCore;

// var_dump($model);

$model->table_name = "customers";

// Get All Customers
$app->get('/api/customers', function(Request $request, Response $response) use($model){
        
        $data = $model->getAll();
        if(!$data){
            return $response->withJson($data, 200);
        } else {
            return $response->withJson($data, 404);
        }
        

});

// Get Single Customers
$app->get('/api/customer/{id}', function(Request $request, Response $response) use($model){

    $id = $request->getAttribute('id');

    $data = $model->getById($id);

    if(!$data){
        return $response->withJson($data, 200);
    } else {
        return $response->withJson($data, 404);
    }
    
});

// Add Customers
$app->post('/api/customer/add', function(Request $request, Response $response) use($model){
    $params = json_decode($request->getBody());

    $result = $model->add($params);
    
    if(!$data){
        return $response->withJson($data, 200);
    } else {
        return $response->withJson($data, 404);
    }
    
});