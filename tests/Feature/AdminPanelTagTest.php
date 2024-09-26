<?php


use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPanelTagTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();


    }

    public function test_login_admin_page()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function test_tags_index_page_success()
    {
        $tags = Tag::factory(3)->create();
        $response = $this->get('/admin/tags');
        $response->assertOk();

        $tagsTitles = $tags->pluck('title')->toArray();

        $response->assertSeeText($tagsTitles);
        $response->assertViewHas('tags', $tags);
    }

    public function test_tags_create_page_success()
    {
        $response = $this->get('/admin/tags/create');
        $response->assertOk();
    }

    public function test_tags_create_storage_success()
    {
        $data = [
            'title' => 'tag title',
        ];

        $response = $this->post('/admin/tags/create', $data);
        $response->assertRedirect('admin/tags');

        $this->assertDatabaseHas('tags', [
            'title' => $data['title'],
        ]);
    }

    public function test_failed_tags_validation_required_storage()
    {
        $data = [
            'title' => '',
        ];

        $response = $this->post('/admin/tags/create', $data);
        $response->assertInvalid([
            'title' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_failed_tags_validation_unique_storage()
    {
        $data = [
            'title' => 'category title',
        ];

        $response = $this->post('/admin/tags/create', $data);
        $response = $this->post('/admin/tags/create', $data);

        $response->assertInvalid([
            'title' => 'Такой тег уже есть',
        ]);
    }

    public function test_tags_update_success()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $data = [
            'title' => 'title update',
        ];

        $response = $this->patch("admin/tags/{$tagId}", $data);
        $response->assertRedirect('admin/tags');

        $tags = Tag::all();
        $view = $this->view('admin.tags.index', compact('tags'));

        $view->assertSee($data['title']);

        $this->assertDatabaseHas('tags', [
            'title' => $data['title'],
        ]);
    }

    public function test_failed_tags_validation_unique_update()
    {
        $tags = Tag::factory()->create();
        $tagId = $tags->id;

        $data = [
            'title' => $tags->title,
        ];

        $response = $this->patch("admin/tags/{$tagId}", $data);

        $response->assertInvalid([
            'title' => 'Такой тег уже есть',
        ]);
    }

    public function test_failed_tags_validation_required_update()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $data = [
            'title' => '',
        ];

        $response = $this->patch("admin/tags/{$tagId}", $data);

        $response->assertInvalid([
            'title' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_tags_show_and_render()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $response = $this->get("admin/tags/{$tagId}");

        $response->assertViewIs('admin.tags.show');

        $response->assertViewHas('tag', $tag);
        $response->assertSee($tag->title);
    }

    public function test_deleted_tags_only_auth_user()
    {
        $this->withoutExceptionHandling();

        // TODO: only_auth_user add ->actingAs($user)
//        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $response = $this->delete("admin/tags/{$tagId}");

        $response->assertRedirect('admin/tags');

        $this->assertSoftDeleted($tag);
    }
    // TODO: NOT_auth_user
/**
    public function test_deleted_post_NOT_auth_user()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $response = $this->delete("/posts/{$postId}");

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', [
            'id' => $postId,
        ]);
    }
 */
}
