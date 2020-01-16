<?php

namespace Tests\Feature\Http\Requests;

use App\Mail\FeedbackArrived;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{

    // a non auth user -> 404
    public function test_if_visitor_is_a_guest_and_route_is_FORBIDDEN_then_404()
    {
        $adminGetRouteNames = $this->getAdminRoutes(); // except /maker the login

        foreach ($adminGetRouteNames as $routeName) {
            $response = $this->get(route($routeName));        
            $response->assertNotFound();
        }
    }    

    // an auth user but is not admin and accesses other admin pages -> 404
    public function test_if_an_auth_user_but_NON_ADMIN_accesses_admin_pages_then_404()
    {
        $adminGetRouteNames = $this->getAdminRoutes(); // except /maker the login

        $user = factory(User::class)->create();
        foreach ($adminGetRouteNames as $routeName) {
            $response = $this->actingAs($user)
                             ->get($routeName);        
            $response->assertStatus(404);
        }

    }

    public function test_if_anyone_tries_to_access_admin_section_by_guessing_then_404() 
    {
        $guesses = [
            '/admin', '/administrator', '/creator'
        ];

        foreach ($guesses as $guess) {
            $response = $this->get($guess);
            $response->assertStatus(404);
        }

    }

    public function test_if_anyone_tries_to_access_admin_section_by_real_admin_slug_then_see_admin_login_page() 
    {
        $adminSlug = '/'.config('admin.slug');

            $response = $this->get($adminSlug);
            $response->assertStatus(200);

    }

    // actual admin can access admin pages
    public function test_real_admin_can_access_admin_pages() 
    {
        $adminGetRouteNames = $this->getAdminRoutes(); // except /maker the login

        $user = User::first();

        foreach ($adminGetRouteNames as $routeName) {
            $this->withoutExceptionHandling();
            $response = $this->actingAs($user)
                             ->get(route($routeName));        

            $response->assertStatus(200);
        }
    }

    public function test_real_admin_when_logged_in_tries_to_access_login_page_then_redirect()
    {

        $user = User::first();

        $response = $this->actingAs($user)
                         ->get(route('admin.login.view'));        
        $response->assertStatus(302); // redirect

    }

    // Assets
    public function test_if_anyone_tries_to_access_public_assets_or_log_viewer_or_anything_suspicious_then_404() 
    {
        $guesses = [
            '/js', '/css', '/vendor',
            '/admin', '/img', '/svg',
            '/assets', '/scss', '/less',
            '/fonts', '/javascript', '/pages',
            '/log', '/logs', '/log-viewer',
            '/query?*', '/query?get=2', '/query?get[]=here',
            '/img/home.webp', '/query?get=2', '/query?get[]=here',
        ];

        foreach ($guesses as $guess) {
            $response = $this->get($guess);
            $response->assertStatus(404);
        }

    }

    // HELPERS
    protected function getAdminRoutes() : array
    {
        return [
            /*'admin.password.request',*/ 'admin.dashboard',
            'admin.post.create', 'admin.post.index'
        ];
    }    

}
