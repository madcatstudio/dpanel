<?php

namespace Tests\Feature;

use App\WebApp;
use App\Domain;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageWebAppsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_create_a_webapp_for_a_domain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $this->assertEquals(0,  $domain->webapps()->count());

        $this->json('POST', '/webapps', [
            'domain_id' => $domain->id,
            'name' => 'Wordpress',
            'username' => 'wp-username',
            'password' => 'weo2o3ks',
            'details' => 'Lorem ipsum.',
        ])->assertStatus(201);

        $this->assertEquals(1,  $domain->webapps()->count());
    }

    /** @test */
    function authenticated_user_can_edit_a_webapp()
    {
        $this->signIn();

        $webapp = factory(WebApp::class)->create([
            'domain_id' => 1,
            'name' => 'Wordpress',
            'username' => 'wp-username',
            'password' => 'weo2o3ks',
            'details' => 'Lorem ipsum.',
        ]);
        $this->assertEquals('Wordpress', $webapp->name);

        $this->json('PATCH', '/webapps/' . $webapp->id, [
            'domain_id' => 3,
            'name' => 'Drupal',
            'username' => 'new-drupal-username',
            'password' => 'p23sdd',
            'details' => 'Dolor amet',
        ])->assertStatus(201);

        $this->assertEquals(3, $webapp->fresh()->domain_id);
        $this->assertEquals('Drupal', $webapp->fresh()->name);
        $this->assertEquals('new-drupal-username', $webapp->fresh()->username);
        $this->assertEquals('p23sdd', $webapp->fresh()->password);
        $this->assertEquals('Dolor amet', $webapp->fresh()->details);
    }

    /** @test */
    function authenticated_user_can_delete_a_webapp()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $webapp = factory(WebApp::class)->create(['domain_id' => $domain->id]);
        $this->assertEquals(1, $domain->webapps()->count());
        $this->assertDatabaseHas('web_apps', ['domain_id' => $domain->id]);

        $this->json('DELETE', '/webapps/' . $webapp->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('web_apps', ['domain_id' => $domain->id]);
        $this->assertEquals(0, $domain->webapps()->count());
    }
}
