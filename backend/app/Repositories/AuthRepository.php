<?php
namespace App\Repositories;

use App\Repositories\Support\BaseRepository;

class AuthRepository extends BaseRepository
{
    function getModel()
    {
        return User::class;
    }

    // public function checkLogin($data) {
    //     $phone = $data['phone'];
    //     $password = $data['password'];

    //     if () {

    //     }
    // }
}


