<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        factory(User::class, 2)
            ->state('withPosts')->create();
    }

    public function testIndexRespond()
    {
        $response = $this->get(route('post.get'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testRespondCount()
    {
        $response = $this->get(route('post.get'));
        $this->assertCount(Post::all()->count(), json_decode($response->getContent(), true));
    }

    public function testSortNew()
    {
        $response = $this->get(route('post.get', ['sort' => 'new']));
        $this->assertEquals(Post::orderBy('created_at', 'desc')->get()->toArray(), json_decode($response->getContent(),
            true));
    }

    public function testSortOld()
    {
        $response = $this->get(route('post.get', ['sort' => 'old']));
        $this->assertEquals(Post::orderBy('created_at', 'asc')->get()->toArray(), json_decode($response->getContent(),
            true));
    }

    public function testUserBlocked()
    {
        factory(User::class)
            ->state('withPosts')->create(['id' => 1]);
        $blockedUserId = User::where('id', '!=', 1)->get()->random()->id;
        //to simplify I will use current user id = 1
        factory(\App\Models\UserMute::class)->create([
            'user_id' => 1,
            'mute_user_id' => $blockedUserId,
            'expired_at' => Carbon::now()->add(new \DateInterval('P1M'))
        ]);

        $response = $this->get(route('post.get'));
        //dd(Post::where('user_id', '!=', $blockedUserId)->orderBy('created_at', 'desc')->get()->toArray(),json_decode($response->getContent(), true) );
        $this->assertEquals(Post::where('user_id', '!=', $blockedUserId)->orderBy('created_at', 'desc')->get()->toArray(),
            json_decode($response->getContent(), true));
    }
}
