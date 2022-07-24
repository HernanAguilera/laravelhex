<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $url = '/api/auth/login';
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_existent_user_with_correct_data()
    {
        $password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);
        $data = [
            'email' => $user->email,
            'password' => $password
        ];
        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('user', $content);
        $this->assertArrayHasKey('authorisation', $content);
        $this->assertArrayHasKey('token', $content['authorisation']);
        $response->assertStatus(200);
    }

    public function test_login_existent_user_with_wrong_password()
    {
        $password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $wrong_password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);
        $data = [
            'email' => $user->email,
            'password' => $wrong_password
        ];
        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_login_existent_user_with_wrong_email()
    {
        $password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $wrong_email = $this->faker->email();
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);
        $data = [
            'email' => $wrong_email,
            'password' => $password
        ];
        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_login_existent_user_with_wrong_email_and_password()
    {
        $password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $wrong_email = $this->faker->email();
        $wrong_password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);
        $data = [
            'email' => $wrong_email,
            'password' => $wrong_password
        ];
        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_login_inexistent_user()
    {
        $email = $this->faker->email();
        $password = $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $data = [
            'email' => $email,
            'password' => $password
        ];

        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);

    }
}
