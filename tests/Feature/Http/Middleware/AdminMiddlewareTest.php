<?php

namespace Tests\Feature\Http\Requests;

use App\Mail\FeedbackArrived;
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

    public function test_if_guest_accesses_admin_login_without_custom_heaer_then_404()
    {
        $response = $this->get(route('admin.login.view'));        
        $response->assertStatus(404);
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

    // actual admin can access admin pages
    public function test_real_admin_can_access_admin_pages() // manually tested
    {
        $adminGetRouteNames = $this->getAdminRoutes(); // except /maker the login

        $user = User::first();

        foreach ($adminGetRouteNames as $routeName) {
            // $this->withoutExceptionHandling();
            $response = $this->actingAs($user)
                             ->get(route($routeName))->withHeaders(['fere' => '222']);        
                             // dd($response->getContent());
            $response->assertStatus(200);
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
