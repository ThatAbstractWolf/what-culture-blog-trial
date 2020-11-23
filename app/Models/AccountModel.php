<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model {

    protected $table = 'accounts';

    protected $allowedFields = ['email', 'firstName', 'lastName', 'password'];

    public function login($email, $password) {

        $hash = md5($password);

        $statement = $this->db->query("SELECT * FROM `account` WHERE email=? AND password=?;", array(
            $email,
            $hash
        ));

        $data = json_decode(json_encode($statement->getResult()), true);

        if (sizeof($data) < 1) return false;

        $data = $data[0];

        unset($data['password']);

        return $data;
    }
}
