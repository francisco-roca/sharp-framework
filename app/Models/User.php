<?php

namespace App\Models;

class User extends Model {

    const rules = [
        'username' => 'required|alpha_numeric',
        'password' => 'required|min_len,6'
    ];

}