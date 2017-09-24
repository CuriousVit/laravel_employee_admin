<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test to check User model.
     *
     * @return void
     */
    public function testUserModel()
    {
        $users = User::all();
        $this->assertTrue(sizeof($users) > 0); //Make sure that at least one admin exists

        foreach ($users as $user) {
            $this->assertNotNull($user->password);

            $userData = $user->toArray();
            $this->assertArrayNotHasKey('password', $userData); //Make sure that password is not visible
            $this->assertArrayHasKey('id', $userData);
            $this->assertArrayHasKey('name', $userData);
            $this->assertArrayHasKey('email', $userData);
            $this->assertArrayHasKey('created_at', $userData);
            $this->assertArrayHasKey('updated_at', $userData);
        }
    }
}
