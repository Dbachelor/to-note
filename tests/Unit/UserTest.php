<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function checkIfUsersExist(): void
    {
        $noUserCount = 0;
        
        $this->assertEquals($noUserCount, User::all()->count(), 'if failed: run php artisan db:seed --class=UserSeeder');
    }
}
