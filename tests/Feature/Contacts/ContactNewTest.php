<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group contacts
 * @group contactNew
 */
class ContactNewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function canCreateContact()
    {
        $user = User::factory()->withPersonalTeam()->create();
        $contactFake = Contact::factory()->make();

        $this->actingAs($user)
            ->post(route('contacts.store'), $contactFake->toArray())
            ->assertStatus(303);

        $this->assertDatabaseHas('contacts', $contactFake->getAttributes());
    }

    /**
     * @test
     */
    public function checkRequiredFieldsCreateContact()
    {
        $user = User::factory()->withPersonalTeam()->create();

        $this->actingAs($user)
            ->post(route('contacts.store'), [])
            ->assertSessionHasErrors('name', null, 'contactStore')
            ->assertSessionHasErrors('email', null, 'contactStore')
            ->assertSessionHasErrors('phone', null, 'contactStore')
            ->assertSessionHasErrors('message', null, 'contactStore');
    }

    /**
     * @test
     */
    public function cannotCreateInvalidEmailContact()
    {
        $user = User::factory()->withPersonalTeam()->create();
        $contactFake = Contact::factory()->make(['email' => 'invalid']);

        $this->actingAs($user)
            ->post(route('contacts.store'), $contactFake->toArray())
            ->assertSessionHasErrors('email', null, 'contactStore');
    }
}
