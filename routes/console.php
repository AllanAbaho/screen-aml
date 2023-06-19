<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('create:admin', function () {
    try {
        $user = new User();
        $user->role = 'Admin';
        $user->email = 'oscar@smithandboltons.com';
        $user->phone = '0700000000';
        $user->password = bcrypt('Admin@123');
        $user->save();
        $this->comment('Admin account created successfully');
    } catch (Exception $e) {
        $this->comment($e->getMessage());
    }
})->purpose('Creating Admin User');
