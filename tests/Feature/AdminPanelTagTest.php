<?php


use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPanelTagTest extends TestCase
{
    use RefreshDatabase;

    private $userAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userAdmin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'role_id' => '0',
        ]);

        $this->userReader = User::factory()->create([
            'name' => 'reader',
            'email' => 'reader@mail.com',
            'role_id' => '1',
        ]);
    }

    public function test_login_admin_page()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_tags_index_page_success()
    {
        $tags = Tag::factory(3)->create();
        $response = $this->actingAs($this->userAdmin)->get('/admin/tags');
        $response->assertOk();

        $tagsTitles = $tags->pluck('title')->toArray();

        $response->assertSeeText($tagsTitles);
        $response->assertViewHas('tags', $tags);
    }

    public function test_tags_create_page_success()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin/tags/create');
        $response->assertOk();
    }

    public function test_tags_create_storage_success()
    {
        $data = [
            'title' => 'tag title',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/tags/create', $data);
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

        $response = $this->actingAs($this->userAdmin)->post('/admin/tags/create', $data);
        $response->assertInvalid([
            'title' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_failed_tags_validation_unique_storage()
    {
        $data = [
            'title' => 'category title',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/tags/create', $data);
        $response = $this->actingAs($this->userAdmin)->post('/admin/tags/create', $data);

        $response->assertInvalid([
            'title' => 'Такой тег уже есть',
        ]);
    }

    public function test_tags_update_page_success()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/tags/{$tagId}/edit");
        $response->assertOk();

//        $tagTitle = $tag->pluck('title')->toArray();

        $response->assertSee($tag->title);
        $response->assertViewHas('tag', $tag);
    }

    public function test_tags_update_success()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $data = [
            'title' => 'title update',
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/tags/{$tagId}", $data);
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

        $response = $this->actingAs($this->userAdmin)->patch("admin/tags/{$tagId}", $data);

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

        $response = $this->actingAs($this->userAdmin)->patch("admin/tags/{$tagId}", $data);

        $response->assertInvalid([
            'title' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_tags_show_and_render()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/tags/{$tagId}");

        $response->assertViewIs('admin.tags.show');

        $response->assertViewHas('tag', $tag);
        $response->assertSee($tag->title);
    }

    public function test_deleted_tags_only_auth_user()
    {
        $this->withoutExceptionHandling();

        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $response = $this->actingAs($this->userAdmin)->delete("admin/tags/{$tagId}");

        $response->assertRedirect('admin/tags');

        $this->assertSoftDeleted($tag);
    }

    public function test_deleted_post_NOT_auth_user()
    {
        $tag = Tag::factory()->create();
        $tagId = $tag->id;

        $response = $this->delete("admin/tags/{$tagId}");

        $response->assertRedirect();

        $this->assertDatabaseHas('tags', [
            'id' => $tagId,
        ]);
    }

    public function test_failed_login_admin_page()
    {
        $response = $this->get('/admin');

        $response->assertRedirect();
    }

    public function test_failed_login_reader_to_admin_page()
    {
        $response = $this->actingAs($this->userReader)->get('/admin');

//        $response->assertRedirect();
        $response->assertNotFound();
    }

    public function test_failed_login_reader_to_admin_tag_page()
    {
        $response = $this->actingAs($this->userReader)->get('/admin/tags');

        $response->assertNotFound();
    }

    public function test_failed_tags_index_page()
    {
        $response = $this->get('/admin/tags');

        $response->assertRedirect();
    }

    public function test_failed_tags_create_storage()
    {
        $data = [
            'title' => 'tag title',
        ];

        $response = $this->post('/admin/tags/create', $data);

        $response->assertRedirect('login');

    }
/*
    public function test_unauthorized_login_admin_page()
    {
        $response = $this->get('/admin');

        $response->assertUnauthorized();
    }
*/

}
