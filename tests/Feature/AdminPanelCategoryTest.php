<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\UserAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPanelCategoryTest extends TestCase
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
    }

    public function test_login_admin_page()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_category_index_page_success()
    {
        $categories = Category::factory(3)->create();
        $response = $this->actingAs($this->userAdmin)->get('/admin/categories');
        $response->assertOk();

        $CategoriesTitles = $categories->pluck('title')->toArray();

        $response->assertSeeText($CategoriesTitles);
        $response->assertViewHas('categories', $categories);
    }

    public function test_category_create_page_success()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin/categories/create');
        $response->assertOk();
    }

    public function test_category_create_storage_success()
    {
        $data = [
            'title' => 'category title',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/categories/create', $data);
        $response->assertRedirect('admin/categories');

        $this->assertDatabaseHas('categories', [
            'title' => $data['title'],
        ]);
    }

    public function test_failed_category_validation_required_storage()
    {
        $data = [
            'title' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/categories/create', $data);
        $response->assertInvalid([
            'title' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_failed_category_validation_unique_storage()
    {
        $data = [
            'title' => 'category title',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/categories/create', $data);
        $response = $this->actingAs($this->userAdmin)->post('/admin/categories/create', $data);

        $response->assertInvalid([
            'title' => 'Такая категория уже есть',
        ]);
    }

    public function test_category_update_page_success()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/categories/{$categoryId}/edit");
        $response->assertOk();

//        $CategoriesTitles = $category->pluck('title')->toArray();

        $response->assertSee($category->title);
        $response->assertViewHas('category', $category);
    }
    public function test_category_update_success()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $data = [
            'title' => 'title update',
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/categories/{$categoryId}", $data);
        $response->assertRedirect('admin/categories');

        $categories = Category::all();
        $view = $this->view('admin.categories.index', compact('categories'));

        $view->assertSee($data['title']);

        $this->assertDatabaseHas('categories', [
            'title' => $data['title'],
        ]);
    }

    public function test_failed_category_validation_unique_update()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $data = [
            'title' => $category->title,
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/categories/{$categoryId}", $data);

        $response->assertInvalid([
            'title' => 'Такая категория уже есть',
        ]);
    }

    public function test_failed_category_validation_required_update()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $data = [
            'title' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/categories/{$categoryId}", $data);

        $response->assertInvalid([
            'title' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_category_show_and_render_category()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/categories/{$categoryId}");

        $response->assertViewIs('admin.categories.show');

        $response->assertViewHas('category', $category);
        $response->assertSee($category->title);
    }

    public function test_deleted_category_only_auth_user()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $categoryId = $category->id;

        $response = $this->actingAs($this->userAdmin)->delete("admin/categories/{$categoryId}");

        $response->assertRedirect('admin/categories');

        $this->assertSoftDeleted($category);
    }

    public function test_deleted_post_NOT_auth_user()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $response = $this->delete("admin/categories/{$categoryId}");

        $response->assertRedirect();

        $this->assertDatabaseHas('categories', [
            'id' => $categoryId,
        ]);
    }

    public function test_failed_login_admin_page()
    {
        $response = $this->get('/admin');

        $response->assertRedirect();
    }

    public function test_failed_category_create_page()
    {
        $response = $this->get('/admin/categories/create');

        $response->assertRedirect();
    }

}
