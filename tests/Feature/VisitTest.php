<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;

class VisitTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $test = $this;

        TestResponse::macro('followRedirects', function ($testCase = null) use ($test) {
            $response = $this;
            $testCase = $testCase ?: $test;

            while ($response->isRedirect()) {
                $response = $testCase->get($response->headers->get('Location'));
            }

            return $response;
        });
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Visit log out pages
     */
    public function testVisitLogOutPages()
    {
        $this->get('/')
            ->assertSee('Please log in');

        $this->get('/employees')
            ->assertSee('/login">Login</a>');
    }

    /**
     * Visit log out Apis
     * (We should have 302 redirect)
     */
    public function testVisitLogOutApis()
    {
        $this->get('/api/employees')
            ->assertStatus(302);
    }

    /**
     * Visit logged in pages
     */
    public function testLoggedInPage()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/')
            ->assertRedirect('/home')
            ->followRedirects()
            ->assertSee('<employees>Loading</employees>')
        ;
    }
}
