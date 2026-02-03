<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Override the test user with specific credentials
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Authenticate as the test user
        $this->actingAs($this->user);
    }

    /** @test */
    public function dashboard_requires_authentication()
    {
        $response = $this->get('/app');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_view_dashboard()
    {
        $response = $this->actingAs($this->user)->get('/app');
        $response->assertStatus(200);
        $response->assertSee('Today');
        $response->assertSee('MRR');
    }

    /** @test */
    public function dashboard_displays_stats_cards()
    {
        $response = $this->actingAs($this->user)->get('/app');
        $response->assertSee('Outstanding invoices');
        $response->assertSee('Low stock');
        $response->assertSee('Payments today');
    }

    /** @test */
    public function dashboard_shows_recent_invoices_section()
    {
        $response = $this->actingAs($this->user)->get('/app');
        $response->assertSee('Recent Invoices');
    }

    /** @test */
    public function dashboard_shows_critical_items_section()
    {
        $response = $this->actingAs($this->user)->get('/app');
        $response->assertSee('Critical items');
    }
}
