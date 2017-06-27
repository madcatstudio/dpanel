<?php

namespace Tests\Feature;

use App\Domain;
use App\Hosting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageHostingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_see_a_list_of_hostings()
    {
        $this->signIn();

        $firstHosting = factory(Hosting::class)->create();
        $secondHosting = factory(Hosting::class)->create();

        $this->get('/hostings')
            ->assertSee($firstHosting->name)
            ->assertSee($secondHosting->name);
    }

    /** @test */
    function authenticated_user_can_create_hosting()
    {
        $this->signIn();

        $this->json('POST', '/hostings', [
            'name' => 'Forge',
            'username' => 'info@example.com',
            'password' => '85221adw',
            'website' => 'http://forge.laravel.com',
            'details' => 'Sequi condimentum nonummy harum.',
        ])->assertStatus(201);

        $this->assertDatabaseHas('hostings', [
            'name' => 'Forge',
            'username' => 'info@example.com',
            'password' => '85221adw',
            'website' => 'http://forge.laravel.com',
            'details' => 'Sequi condimentum nonummy harum.',
        ]);
    }

    /** @test */
    function authenticated_user_can_edit_a_hosting()
    {
        $this->signIn();

        $hosting = factory(Hosting::class)->create([
            'name' => 'Forge',
            'username' => 'info@example.com',
            'password' => '85221adw',
            'website' => 'http://forge.laravel.com',
            'details' => 'Sequi condimentum nonummy harum.',
        ]);
        $this->assertEquals('Forge', $hosting->name);

        $this->json('PATCH', '/hostings/' . $hosting->id, [
            'name' => 'New Hoster',
            'username' => 'newemail@hoster.com',
            'password' => '23dsds',
            'website' => 'http://www.hoster.org',
            'details' => 'Lorem ipsum dolor azz.',
        ])->assertStatus(201);


        $this->assertEquals('New Hoster', $hosting->fresh()->name);
        $this->assertEquals('newemail@hoster.com', $hosting->fresh()->username);
        $this->assertEquals('23dsds', $hosting->fresh()->password);
        $this->assertEquals('http://www.hoster.org', $hosting->fresh()->website);
        $this->assertEquals('Lorem ipsum dolor azz.', $hosting->fresh()->details);
    }

    /** @test */
    function authenticated_user_can_delete_a_hosting()
    {
        $this->signIn();

        $hosting = factory(Hosting::class)->create();
        $domain = factory(Domain::class)->create(['hosting_id' => $hosting->id]);
        $this->assertDatabaseHas('hostings', ['id' => $hosting->id]);
        $this->assertEquals($hosting->id, $domain->hosting_id);

        $this->json('DELETE', '/hostings/' . $hosting->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('hostings', ['id' => $hosting->id]);
        $this->assertEquals(null, $domain->fresh()->hosting_id);
    }
}
