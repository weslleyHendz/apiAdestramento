<?php
// Include CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');

// Include action.php file
include_once '../db.php';
// Create object of Users class
$user = new Database();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// get id from url
$id = intval($_GET['id'] ?? '');

// Get all or a single user from database
if ($api == 'GET') {
    if ($id != null) {
        $data = $user->getDog($id);
    } else {
        $data = $user->getDog();
    }
    echo json_encode($data);
}

// Add a new user into database
if ($api == 'POST') {
    parse_str(file_get_contents('php://input'), $post_input);

    if (isset($post_input['name'])) {
        $name = $user->test_input($post_input['name']);
    } else {
        $name = '';
    }
    if (isset($post_input['phone'])) {
        $phone = $user->test_input($post_input['phone']);
    } else {
        $phone = '';
    }
    if (isset($post_input['age'])) {
        $age = $user->test_input($post_input['age']);
    } else {
        $age = '';
    }
    if (isset($post_input['idTutor'])) {
        $idTutor = $user->test_input($post_input['idTutor']);
    } else {
        $idTutor = '';
    }
    if (isset($post_input['breed'])) {
        $breed = $user->test_input($post_input['breed']);
    } else {
        $breed = '';
    }
    if (isset($post_input['sex'])) {
        $sex = $user->test_input($post_input['sex']);
    } else {
        $sex = '';
    }
    if ($user->insertDog($name,$phone,$age,$idTutor,$breed,$sex)) {
        echo $user->message('Dog added successfully!', false);
    } else {
        echo $user->message('Failed to add an Dog!', true);
    }
}

// Update an user in database
if ($api == 'PUT') {

    parse_str(file_get_contents('php://input'), $post_input);
    $data = $user->getDog($id);

    if (isset($post_input['name'])) {
        var_dump($post_input['name']);
        $name = $user->test_input($post_input['name']);
    } else {
        $name = $data[0]['name'];
    }
    if (isset($post_input['phone'])) {
        $phone = $user->test_input($post_input['phone']);
    } else {
        $phone = $data[0]['phone'];
    }
    if (isset($post_input['age'])) {
        $age = $user->test_input($post_input['age']);
    } else {
        $age = $data[0]['age'];
    }
    if (isset($post_input['idTutor'])) {
        $idTutor = $user->test_input($post_input['idTutor']);
    } else {
        $idTutor = $data[0]['idTutor'];
    }
    if (isset($post_input['breed'])) {
        $breed = $user->test_input($post_input['breed']);
    } else {
        $breed = $data[0]['breed'];
    }
    if (isset($post_input['sex'])) {
        $sex = $user->test_input($post_input['sex']);
    } else {
        $sex = $data[0]['sex'];
    }

    if ($id != null) {
        if ($user->updateDog($name, $phone, $age, $idTutor, $breed, $sex, $id)) {
            echo $user->message('Dog updated successfully!', false);
        } else {
            echo $Dog->message('Failed to update an dog!', true);
        }
    } else {
        echo $user->message('Dog not found!', true);
    }
}

// Delete an user from database
if ($api == 'DELETE') {
    if ($id != null) {
        if ($user->deleteDog($id)) {
            echo $user->message('Dog deleted successfully!', false);
        } else {
            echo $user->message('Failed to delete an dog!', true);
        }
    } else {
        echo $user->message('Dog not found!', true);
    }
}
