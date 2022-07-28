<?php

namespace Tests\Feature\Auth;

use H34\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $url = '/api/auth/reset-password';
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_reset_password_with_existent_user_and_correct_data()
    {
        $password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post($this->url, ['email' => $user->email], [
            'Accept' => 'application/json'
        ]);

        $content = json_decode($response->getContent(), true);

        // dd($content);

        $response->assertStatus(200);
    }
}
