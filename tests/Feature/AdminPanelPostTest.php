<?php


use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Tests\TestCase;

class AdminPanelPostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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


    public function test_post_index_page_success()
    {
        $posts = Post::factory(3)->create();

        $response = $this->actingAs($this->userAdmin)->get('/admin/posts');
        $response->assertOk();

        $postsTitles = $posts->pluck('title')->toArray();

        $response->assertSeeText($postsTitles);
        $response->assertViewHas('posts', $posts);
    }

    public function test_post_create_page_success()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin/posts/create');
        $response->assertOk();
    }

    public function test_post_create_storage_success_only_required()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $data = [
            'title' => 'post title',
            'content' => 'post text',
            'category_id' => $categoryId,
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertRedirect('admin/posts');

        $this->assertDatabaseHas('posts', $data);
    }


    public function test_failed_post_validation_title_required_storage()
    {
        $data = [
            'title' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertInvalid([
            'title' => 'Поле заголовка должно быть заполнено',
        ]);
    }

    public function test_failed_post_validation_content_required_storage()
    {
        $data = [
            'title' => 'First title',
            'content' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertInvalid([
            'content' => 'Поле текста должно быть заполнено',
        ]);
    }

    public function test_failed_post_validation_category_required_storage()
    {
        $data = [
            'title' => 'First title',
            'content' => 'post text',
            'category_id' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertInvalid([
            'category_id' => 'Нужно выбрать категорию',
        ]);
    }

    public function test_failed_post_validation_unique_storage()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $data = [
            'title' => 'post title',
            'content' => 'post text',
//            'preview_image' => '',
//            'main_image' => '',
//            'tag_ids' => '',
            'category_id' => $categoryId,
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);

        $response->assertInvalid([
            'title' => 'Такой заголовок уже есть',
        ]);
    }

    public function test_failed_post_validation_previewimage_size_required_storage()
    {
        $data = [
            'title' => 'First title',
            'content' => 'post text',
            'preview_image' => $this->faker->imageUrl($width = 301, $height = 251),
            'category_id' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertInvalid([
            'preview_image' => 'Размер изображения должен быть не больше 300х250',
        ]);
    }

    public function test_failed_post_validation_previewimage_not_image_required_storage()
    {
        $data = [
            'title' => 'First title',
            'content' => 'post text',
            'preview_image' => File::create('file.txt'),
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertInvalid([
            'preview_image' => 'Файл превью должен быть изображением (jpg, jpeg, png, bmp, gif, svg)',
        ]);
    }

    public function test_failed_post_validation_main_image_not_image_required_storage()
    {
        $data = [
            'title' => 'First title',
            'content' => 'post text',
            'main_image' => File::create('file.txt'),
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/posts/create', $data);
        $response->assertInvalid([
            'main_image' => 'Файл основной картинки должен быть изображением (jpg, jpeg, png, bmp, gif, svg)',
        ]);
    }

    public function test_post_update_page_success()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/posts/{$postId}/edit");
        $response->assertOk();

//        $tagTitle = $post->pluck('title')->toArray();

        $response->assertSee($post->title);
        $response->assertViewHas('post', $post);
    }

    public function test_post_update_success()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $category = Category::factory()->create();
        $categoryId = $category->id;

        $data = [
            'title' => 'post title',
            'content' => 'post text',
            'category_id' => $categoryId,
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/posts/{$postId}", $data);
        $response->assertRedirect('admin/posts');

        $posts = Post::all();
        $view = $this->view('admin.posts.index', compact('posts'));

        $view->assertSee($data['title']);

        $this->assertDatabaseHas('posts', $data);
    }


    public function test_failed_post_validation_required_update()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $data = [
            'title' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/posts/{$postId}", $data);

        $response->assertInvalid([
            'title' => 'Поле заголовка должно быть заполнено',
        ]);
    }

    public function test_post_show_and_render()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/posts/{$postId}");

        $response->assertViewIs('admin.posts.show');

        $response->assertViewHas('post', $post);
        $response->assertSee($post->title);
    }

    public function test_deleted_tags_only_auth_user()
    {
        $this->withoutExceptionHandling();

        // TODO: only_auth_user add ->actingAs($user)
//        $user = User::factory()->create();
        $post = Post::factory()->create();
        $postId = $post->id;

        $response = $this->actingAs($this->userAdmin)->delete("admin/posts/{$postId}");

        $response->assertRedirect('admin/posts');

        $this->assertSoftDeleted($post);
    }

    public function test_deleted_post_NOT_auth_user()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $response = $this->delete("admin/posts/{$postId}");

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', [
            'id' => $postId,
        ]);
    }

    public function test_failed_post_index_page()
    {
        $response = $this->get('/admin/posts');

        $response->assertRedirect();
    }

    public function test_failed_login_reader_to_admin_Post_page()
    {
        $response = $this->actingAs($this->userReader)->get('/admin/posts');

        $response->assertNotFound();
    }

    public function test_failed_post_update_page()
    {
        $post = Post::factory()->create();
        $postId = $post->id;

        $response = $this->get("admin/posts/{$postId}/edit");
        $response->assertRedirect();

    }

}
