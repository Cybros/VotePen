<?php

namespace Tests\Feature;

use App\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class SubmitTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp(); 
        
        $this->signInViaPassport();
    }

    /** @test */
    public function can_post_a_link()
    {   
        Storage::fake(config('filesystems.default'));

        $channel = create(Channel::class);

        $this->json('POST', '/api/submissions', [
            'type' => 'link',
            'channel_name' => $channel->name,
            'title' => 'Google',
            'url' => 'https://google.com',
        ])
            ->assertStatus(200);
    }

    /** @test */
    public function url_must_be_a_valid_address()
    {
        $channel = create(Channel::class);

        $res = $this->json('POST', '/api/submissions', [
            'type' => 'link',
            'channel_name' => $channel->name,
            'title' => 'Google',
            'url' => 'google.com',
        ])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "url" => [
                        "The url format is invalid.",
                    ],
                ],
            ]);
    }

    /** @test */
    public function url_must_be_active()
    {
        $channel = create(Channel::class);

        $res = $this->json('POST', '/api/submissions', [
            'type' => 'link',
            'channel_name' => $channel->name,
            'title' => 'Google',
            'url' => 'https://without-dns-record.google.com',
        ])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "url" => [
                        "The url is not a valid URL.",
                    ],
                ],
            ]);
    }
}