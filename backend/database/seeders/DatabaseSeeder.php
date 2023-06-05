<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->importUser();
        $this->importMessage();
    }

    public function importUser() {
        $user = new User;
        $user->name = "Dương";
        $user->phone = "0123456789";
        $user->password = bcrypt('123456');
        $user->status = "0";
        $user->room = "0";
        $user->save();

        $user = new User();
        $user->name = "Quyền";
        $user->phone = "0123456788";
        $user->password = bcrypt('123456');
        $user->status = "0";
        $user->room = "0";
        $user->save();
    }

    public function importMessage() {
        $message = new  Message;
        $message->room = "0";
        $message->user_id = 1;
        $message->content = "alo";
        $message->save();

        $message = new  Message;
        $message->room = "0";
        $message->user_id = 2;
        $message->content = "blo";
        $message->save();
    }
}
