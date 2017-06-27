<?php

namespace Tests\Feature;

use App\Domain;
use App\Maintainer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageMaintainerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_see_a_list_of_maintainers()
    {
        $this->signIn();

        $firstMaintainer = factory(Maintainer::class)->create();
        $secondMaintainer = factory(Maintainer::class)->create();

        $this->get('/maintainers')
            ->assertSee($firstMaintainer->name)
            ->assertSee($secondMaintainer->name);
    }

    /** @test */
    function authenticated_user_can_create_maintainer()
    {
        $this->signIn();

        $this->json('POST', '/maintainers', [
            'name' => 'Aruba',
            'username' => '252105@aruba.it',
            'password' => '9as2W2as.w',
            'website' => 'http://www.aruba.it',
            'details' => 'Sequi condimentum nonummy harum.',
        ])->assertStatus(201);

        $this->assertDatabaseHas('maintainers', [
            'name' => 'Aruba',
            'username' => '252105@aruba.it',
            'password' => '9as2W2as.w',
            'website' => 'http://www.aruba.it',
            'details' => 'Sequi condimentum nonummy harum.',
        ]);
    }

    /** @test */
    function authenticated_user_can_edit_a_maintainer()
    {
        $this->signIn();

        $maintainer = factory(Maintainer::class)->create([
            'name' => 'Aruba',
            'username' => '252105@aruba.it',
            'password' => '9as2W2as.w',
            'website' => 'http://www.aruba.it',
            'details' => 'Sequi condimentum nonummy harum.',
        ]);
        $this->assertEquals('Aruba', $maintainer->name);

        $this->json('PATCH', '/maintainers/' . $maintainer->id, [
            'name' => 'New Hoster',
            'username' => 'newemail@hoster.com',
            'password' => '23dsds',
            'website' => 'http://www.hoster.org',
            'details' => 'Lorem ipsum dolor azz.',
        ])->assertStatus(201);


        $this->assertEquals('New Hoster', $maintainer->fresh()->name);
        $this->assertEquals('newemail@hoster.com', $maintainer->fresh()->username);
        $this->assertEquals('23dsds', $maintainer->fresh()->password);
        $this->assertEquals('http://www.hoster.org', $maintainer->fresh()->website);
        $this->assertEquals('Lorem ipsum dolor azz.', $maintainer->fresh()->details);
    }

    /** @test */
    function authenticated_user_can_delete_a_maintainer()
    {
        $this->signIn();

        $maintainer = factory(Maintainer::class)->create();
        $domain = factory(Domain::class)->create(['maintainer_id' => $maintainer->id]);
        $this->assertDatabaseHas('maintainers', ['id' => $maintainer->id]);
        $this->assertEquals($maintainer->id, $domain->maintainer_id);

        $this->json('DELETE', '/maintainers/' . $maintainer->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('maintainers', ['id' => $maintainer->id]);
        $this->assertEquals(null, $domain->fresh()->maintainer_id);
    }
}
