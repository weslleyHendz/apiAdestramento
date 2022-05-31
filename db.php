<?php
// Include config.php file
include_once 'config.php';

// Create a class Users
class Database extends Config
{
    // Fetch all or a single user from database
    public function getUser($id = 0)
    {
        $sql = 'SELECT * FROM users';
        if ($id != null) {
            $sql .= ' WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $sql = $stmt->fetchAll();
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $sql = $stmt->fetchAll();
        }
        // var_dump($sql);
        return $sql;
    }

    // Insert an user in the database
    public function insertUser($name, $email, $phone, $age)
    {
        $sql = 'INSERT INTO users (name, email, phone, age) VALUES (:name, :email, :phone, :age)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'age' => $age]);
        return true;
    }

    // Update an user in the database
    public function updateUser($name, $email, $phone, $age, $id)
    {
        $sql = 'UPDATE users SET name = :name, email = :email, phone = :phone, age = :age WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'age' => $age, 'id' => $id]);
        return true;
    }

    // Delete an user from database
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
    public function getDog($id = 0)
    {
        $sql = 'SELECT * FROM dogs';
        if ($id != null) {
            $sql .= ' WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $sql = $stmt->fetchAll();
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $sql = $stmt->fetchAll();
        }
        // var_dump($sql);
        return $sql;
    }
    public function insertDog($name, $phone, $age, $idTutor, $breed, $sex)
    {
        $sql = 'INSERT INTO dogs (name, phone, age, idTutor, breed, sex) VALUES (:name, :phone, :age, :idTutor, :breed, :sex)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'phone' => $phone, 'age' => $age,'idTutor' => $idTutor, 'breed' => $breed, 'sex' => $sex
    ]);
        return true;
    }
    public function updateDog($name, $phone, $age, $idTutor, $breed, $sex, $id)
    {
        $sql = 'UPDATE dogs SET name = :name, phone = :phone, age = :age, idTutor = :idTutor, breed = :breed, sex = :sex WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'phone' => $phone, 'age' => $age, 'idTutor' => $idTutor, 'breed' => $breed, 'sex' => $sex,'id' => $id]);
        return true;
    }

    public function deleteDog($id)
    {
        $sql = 'DELETE FROM dogs WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
    
}
