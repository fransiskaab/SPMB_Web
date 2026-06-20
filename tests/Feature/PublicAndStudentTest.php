<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Kelas;
use App\Models\PaketPendaftaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicAndStudentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic classes and packages for test views
        $kelas = Kelas::create(['nama_kelas' => 'Kelas A', 'jenjang' => 'RA']);
        PaketPendaftaran::create([
            'kelas_id' => $kelas->id,
            'nama_paket' => 'Paket Hemat',
            'jenis_kelamin' => 'L',
            'nominal_biaya' => 1000000,
        ]);
    }

    /**
     * Test that all public landing pages load successfully.
     */
    public function test_public_pages_load_successfully(): void
    {
        $pages = [
            '/',
            '/profil',
            '/fasilitas',
            '/informasi-pendaftaran',
            '/paket-pendaftaran',
            '/kontak',
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
        }
    }

    /**
     * Test that register page loads and registers a student successfully.
     */
    public function test_student_can_register_self_and_redirect_to_dashboard(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $registerData = [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $submitResponse = $this->post('/register', $registerData);

        // Assert redirect to student dashboard
        $submitResponse->assertRedirect(route('student.dashboard'));
        
        // Assert user exists and has role 'calon_murid'
        $user = User::where('email', 'budi@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('calon_murid', $user->role);
        
        // Assert authenticated
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test role based middleware route protection.
     */
    public function test_unauthenticated_guests_are_blocked_from_dashboards(): void
    {
        // Guests trying to view student area should redirect to login
        $this->get('/student/dashboard')->assertRedirect('/login');

        // Guests trying to view admin area should redirect to login
        $this->get('/admin')->assertRedirect('/login');
    }

    /**
     * Test that students cannot access admin pages.
     */
    public function test_students_cannot_access_admin_dashboard(): void
    {
        $student = User::create([
            'name' => 'Calon Murid',
            'email' => 'murid@sipmb.test',
            'password' => bcrypt('password'),
            'role' => 'calon_murid',
        ]);

        $response = $this->actingAs($student)->get('/admin');
        
        // Assert Forbidden
        $response->assertStatus(403);
    }

    /**
     * Test that admin can access users management dashboard.
     */
    public function test_admin_can_access_users_management(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin_test@sipmb.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
    }

    /**
     * Test that a deactivated user cannot log in.
     */
    public function test_deactivated_user_cannot_login(): void
    {
        $deactivatedUser = User::create([
            'name' => 'Nonaktif User',
            'email' => 'nonaktif@sipmb.test',
            'password' => bcrypt('password'),
            'role' => 'staff',
            'is_active' => false,
        ]);

        $response = $this->post('/login', [
            'email' => 'nonaktif@sipmb.test',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
