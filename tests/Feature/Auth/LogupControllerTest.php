<?php

namespace Tests\Auth\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;

class LogupControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $url = '/api/auth/logup';

    protected function setUp(): void {
        parent::setUp();
    }


    public function test_register_user_with_correct_data()
    {
        $data = [
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}')
        ];

        $response = $this->post($this->url, $data);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('user', $content);
        $this->assertArrayHasKey('authorisation', $content);
        $this->assertArrayHasKey('token', $content['authorisation']);
        $response->assertStatus(201);
    }

    /**
     * @dataProvider getWrongData
     */
    public function test_register_user_with_wrong_data($data, $field_missing) {

        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertArrayHasKey($field_missing, $content['errors']);
        $response->assertStatus(422);
    }

    public function getWrongData() {
        $faker = Factory::create();
        $name = $faker->firstName() . ' ' . $faker->lastName();
        $too_long_name = $faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{256,1000}');
        $email = $faker->email();
        $wrong_format_email = $faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $password = $faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{6,100}');
        $short_password = $faker->regexify('[A-Za-z0-9!"#$%&\'()*+,./:;<=>?@\^_`{|}~-]{1,5}');

        return [
            [
                [
                    'email' => $email,
                    'password' => $password
                ],
                'name'
            ],
            [ // too long name
                [
                    'name' => $too_long_name,
                    'email' => $email,
                    'password' => $password
                ],
                'name'
            ],
            [
                [
                    'name' => $name,
                    'password' => $password
                ],
                'email'
            ],
            [ // wrong email
                [
                    'name' => $name,
                    'email' => $wrong_format_email,
                    'password' => $password
                ],
                'email'
            ],
            [
                [
                    'name' => $name,
                    'email' => $email,
                ],
                'password'
            ],
            [ // too short pasword
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => $short_password
                ],
                'password'
            ],
        ];
    }
}
