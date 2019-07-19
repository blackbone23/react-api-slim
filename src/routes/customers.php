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
        if($data){
            return $response->withJson($data, 200);
        } else {
            return $response->withJson($data, 404);
        }
        

});

// Get Single Customers
$app->get('/api/customer/{id}', function(Request $request, Response $response) use($model){

    $id = $request->getAttribute('id');

    $data = $model->getById($id);

    if($data){
        return $response->withJson($data, 200);
    } else {
        return $response->withJson($data, 404);
    }
    
});

// Add Customers
$app->post('/api/customer', function(Request $request, Response $response) use($model){
    $params = json_decode($request->getBody());

    $result = $model->add($params);
    
    if($result == true){
        $data_ress = array(
            "notice" => array(
                "text" => "Customer Added"
            )
        );
        return $response->withJson($data_ress, 200);
    } else {
        return $response->withJson($result, 404);
    }
    
});

// Update Customers
$app->put('/api/customer/{id}', function(Request $request, Response $response) use($model){

    $id = $request->getAttribute('id');

    $params = json_decode($request->getBody());

    $result = $model->update($params, $id);

    if($result == 1){
        $data_ress = array(
            "notice" => array(
                "text" => "Customer Updated"
            )
        );
        return $response->withJson($data_ress, 200);

    } elseif($result == 0) {
        $data_ress = array(
            "notice" => array(
                "text" => "No Data Updated"
            )
        );
        return $response->withJson($data_ress, 200);

    } else {
        return $response->withJson($result, 404);
    }
});

// Delete Customers
$app->delete('/api/customer/{id}', function(Request $request, Response $response) use($model){

    $id = $request->getAttribute('id');

    $result = $model->delete($id);

    if($result == 1){
        $data_ress = array(
            "notice" => array(
                "text" => "Customer Deleted"
            )
        );
        return $response->withJson($data_ress, 200);

    } elseif($result == 0) {
        $data_ress = array(
            "notice" => array(
                "text" => "No Data Deleted"
            )
        );
        return $response->withJson($data_ress, 200);

    } else {
        return $response->withJson($result, 404);
    }
});
