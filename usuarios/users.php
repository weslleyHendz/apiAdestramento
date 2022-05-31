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
        $data = $user->getUser($id);
    } else {
        $data = $user->getUser();
    }
    echo json_encode($data);
}

// Add a new user into database
if ($api == 'POST') {
    parse_str(file_get_contents('php://input'), $post_input);
    
    if(isset($post_input['name'])){
        $name = $user->test_input($post_input['name']);
    }else{
        $name = '';
    }
    if(isset($post_input['email'])){
        $email = $user->test_input($post_input['email']);
    }else{
        $email = '';
    }
    if(isset($post_input['phone'])){
        $phone = $user->test_input($post_input['phone']);
    }else{
        $phone = '';
    }
    if(isset($post_input['age'])){
        $age = $user->test_input($post_input['age']);
    }else{
        $age = '';
    }
    if ($user->insertUser($name, $email, $phone, $age)) {
        echo $user->message('User added successfully!', false);
    } else {
        echo $user->message('Failed to add an user!', true);
    }
}

// Update an user in database
if ($api == 'PUT') {

    parse_str(file_get_contents('php://input'), $post_input);
    $data = $user->getUser($id);

    if(isset($post_input['name'])){
        $name = $user->test_input($post_input['name']);
    }else{
        $name = $data[0]['name'];
    }
    if(isset($post_input['email'])){
        $email = $user->test_input($post_input['email']);
    }else{
        $email = $data[0]['email'];
    }
    if(isset($post_input['phone'])){
        $phone = $user->test_input($post_input['phone']);
    }else{
        $phone = $data[0]['phone'];
    }
    if(isset($post_input['age'])){
        $age = $user->test_input($post_input['age']);
    }else{
        $age = $data[0]['age'];
    }

    if ($id != null) {
        if ($user->updateUser($name, $email, $phone, $age, $id)) {
            echo $user->message('User updated successfully!', false);
        } else {
            echo $user->message('Failed to update an user!', true);
        }
    } else {
        echo $user->message('User not found!', true);
    }
}

// Delete an user from database
if ($api == 'DELETE') {
    if ($id != null) {
        if ($user->deleteUser($id)) {
            echo $user->message('User deleted successfully!', false);
        } else {
            echo $user->message('Failed to delete an user!', true);
        }
    } else {
        echo $user->message('User not found!', true);
    }
}
