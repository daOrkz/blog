<?php


use App\Mail\User\SendPassword;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\UserAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class AdminPanelUserTest extends TestCase
{
    use RefreshDatabase;

    private $userAdmin;
    private $users;

    protected function setUp(): void
    {
        parent::setUp();

//        Mail::fake();
//        Queue::fake();

        $this->users = User::factory(5)->create();

        $this->userAdmin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'role_id' => '0',
        ]);

        $this->userReader = User::factory()->create([
            'name' => 'reader',
            'email' => 'reader@mail.com',
            'password' => '123',
            'role_id' => '1',
        ]);
    }

    public function test_login_admin_page()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_index_page_success()
    {
        $users = User::all();

        $response = $this->actingAs($this->userAdmin)->get('/admin/users');
        $response->assertOk();

        $usersName = $this->users->pluck('name')->toArray();

        $response->assertSeeText($usersName);
        $response->assertViewHas('users', $users);
    }

    public function test_create_page_success()
    {
        $response = $this->actingAs($this->userAdmin)->get('/admin/users/create');
        $response->assertOk();
    }

    public function test_create_storage_success()
    {
        Mail::fake();
        Queue::fake();

        $data = [
            'name' => 'admin',
            'email' => 'testuser@mail.com',
            'role_id' => '0',
            'password' => 'password'
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/users/create', $data);
        $response->assertRedirect('admin/users');

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
    }

    public function test_failed_validation_required_storage()
    {
        $data = [
            'email' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/users/create', $data);
        $response->assertInvalid([
            'email' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_failed_validation_unique_storage()
    {
        $user = $this->users[0];
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => 1,
            'password'=> $user->password,
        ];

        $response = $this->actingAs($this->userAdmin)->post('/admin/users/create', $data);
//        $response = $this->actingAs($this->userAdmin)->post('/admin/users/create', $data);

        $response->assertInvalid([
            'email' => 'Такая почта уже есть',
        ]);
    }

    public function test_update_page_success()
    {
        $userId = $this->users[0]->id;

        $response = $this->actingAs($this->userAdmin)->get("admin/users/{$userId}/edit");
        $response->assertOk();

//        $CategoriesTitles = $category->pluck('title')->toArray();

        $response->assertSee($this->users[0]->name);
        $response->assertViewHas('user', $this->users[0]);
    }
    public function test_update_success()
    {
        $this->withoutExceptionHandling();

//        $users = $this->users;
        $user = $this->users[0];
        $userId = $this->users[0]->id;

        $data = [
            'name' => 'name update',
            'email' => $user->email,
            'user_id' => $user->id,
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/users/{$userId}", $data);
        $response->assertRedirect('admin/users');

        $users = User::all();
        $view = $this->view('admin.users.index', compact('users'));

        $view->assertSee($data['name']);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
    }

    public function test_failed_validation_unique_update()
    {
        $user = $this->users[0];
        $userId = $user->id;

        $data = [
            'name' => 'name update',
            'email' => $user->email,
            'user_id' => 1,
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/users/{$userId}", $data);

        $response->assertInvalid([
            'email' => 'Такая почта уже есть',
        ]);
    }

    public function test_failed_validation_required_update()
    {
        $userId = $this->users[0]->id;

        $data = [
            'email' => '',
        ];

        $response = $this->actingAs($this->userAdmin)->patch("admin/users/{$userId}", $data);

        $response->assertInvalid([
            'email' => 'Поле должно быть заполнено',
        ]);
    }

    public function test_show_and_render_category()
    {
        $user = $this->users[0];
        $userId = $this->users[0]->id;


        $response = $this->actingAs($this->userAdmin)->get("admin/users/{$userId}");

        $response->assertViewIs('admin.users.show');

        $response->assertViewHas('user', $user);
        $response->assertSee($user->name);
    }

    public function test_deleted_only_auth_user()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $userId = $user->id;

        $response = $this->actingAs($this->userAdmin)->delete("admin/users/{$userId}");

        $response->assertRedirect('admin/users');

        $this->assertSoftDeleted($user);
    }

    public function test_failed_deleted_NOT_auth_user()
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $response = $this->delete("admin/users/{$userId}");

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $userId,
        ]);
    }

    public function test_failed_login_admin_page()
    {
        $response = $this->get('/admin');

        $response->assertRedirect();
    }

    public function test_failed_login_reader_to_admin_users_page()
    {
        $response = $this->actingAs($this->userReader)->get('/admin/users');

        $response->assertNotFound();
    }

    public function test_failed_create_page()
    {
        $response = $this->get('/admin/users/create');

        $response->assertRedirect();
    }

    public function test_email_class_has_envelope()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Tom',
            'password' => '123',
            'email' => 'test@email.com'
        ];

        $mail = new SendPassword($data);

        $mail->assertHasSubject('Send Password');
        $mail->assertSeeInHtml($data['name']);
        $mail->assertSeeInHtml($data['password']);
        $mail->assertSeeInHtml($data['email']);
    }

    public function test_send_email_to_user()
    {
        $this->withoutExceptionHandling();

        Mail::fake();
        Queue::fake();

        $data = [
            'name' => 'Tom',
            'password' => '123',
            'email' => 'test@email.com'
        ];


        Mail::to($data['email'])->queue(new SendPassword($data));

        Mail::assertQueued(function (SendPassword $mail) use ($data) {
            return $mail->email === $data['email'] &&
                $mail->password === $data['password'] &&
                $mail->name === $data['name'];
        });
    }
}
