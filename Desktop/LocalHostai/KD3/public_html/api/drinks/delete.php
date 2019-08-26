<?php

require '../../../bootloader.php';



if (!empty($_SESSION['email'])) {

    $modelDrinks = new App\Drinks\Model();

    $drinks = $modelDrinks->get([
        "row_id" => intval($_POST["drink_id"])
    ]);

//var_dump($drink);

    $response = [
        'status' => null,
        'errors' => []
    ];

    if ($drinks) {
        $success = $modelDrinks->delete($drinks[0]);
        if ($success) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'fail';
            $response['errors'][] = 'Could not delete drink';
        }
    } else {
        $response['status'] = 'fail';
        $response['errors'][] = 'Drink does not exist';
    }

    print json_encode($response);
}else{
    var_dump("nepavyko");
}


