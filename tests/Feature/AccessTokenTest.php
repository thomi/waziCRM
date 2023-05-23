<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AccessTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_validates_user_information()
    {
        collect(['username', 'full_name', 'email_address', 'phone_number', 'password', 'password_confirmation'])
            ->each(function ($field) {

                $params = $this->validParams();
                $response = $this->postJson(
                    route('token.create'),
                    array_merge($params, [$field => ''])
                );

                // $response->dump();

                $response->assertStatus(422)
                    ->assertJson(['error' => true]);
            });
    }

    /** @test */
    public function test_stores_user_information_and_issues_token()
    {
        $response = $this->postJson(route('token.create'),
            $this->validParams());

        $response->assertStatus(201)
            ->assertJson(['data' => true])
            ->assertJsonPath('data.user.name', 'Clark Kent');
    }

    /** @test */
    public function test_validates_user_credentials()
    {
        collect(['email_address', 'password'])
            ->each(function ($field) {

                $params = $this->validLoginParams();
                $response = $this->postJson(
                    route('token.store'),
                    array_merge($params, [$field => ''])
                );

                // $response->dump();

                $response->assertStatus(422)
                    ->assertJson(['error' => true]);
            });
    }

    /** @test */
    public function test_issues_token_to_user()
    {
        $this->postJson(route('token.create'),
            $this->validParams());

        $response = $this->postJson(
            route('token.store'),
            $this->validLoginParams()
        );

        //$response->dump();

        $response->assertStatus(200)
            ->assertJson(['data' => true])
            ->assertJsonPath('data.user.name', 'Clark Kent');
    }

    /** @test */
    public function test_revokes_specified_token_from_user()
    {
        $response = $this->deleteJson(route('token.delete'));

        $response->dump();

        $response->assertStatus(401)
            ->assertJson(['error' => true])
            ->assertJsonPath('error.message','permission denied to perform this action.');
    }

    /**
     * Valid params for creating a User Resource.
     *
     * @param  array  $overrides new params
     * @return array  Valid params for updating or creating a resource
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'username' => 'superman',
            'full_name' => 'Clark Kent',
            'email_address' => 'kent@dailyplanet.org',
            'phone_number' => '0701213456',
            "password" => 'passcode',
            "password_confirmation" => 'passcode'
        ], $overrides);
    }

    /**
     * Valid params for issuing an accessToken.
     *
     * @param  array  $overrides new params
     * @return array  Valid params for updating or creating a resource
     */
    private function validLoginParams($overrides = [])
    {
        return array_merge([
            'email_address' => 'kent@dailyplanet.org',
            'password' => 'passcode'
        ], $overrides);
    }
}
