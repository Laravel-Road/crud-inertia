<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group contacts
 * @group contactItem
 */
class ContactItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function canUpdateContact()
    {
        $user = User::factory()->withPersonalTeam()->create();
        $contact = Contact::factory()->create();
        $contactFake = Contact::factory()->make();

        $this->actingAs($user)
            ->put(route('contacts.update', $contact), $contactFake->toArray())
            ->assertStatus(303);

        $this->assertDatabaseHas('contacts', $contactFake->getAttributes());
    }

    /**
     * @test
     */
    public function canDestroyContact()
    {
        $user = User::factory()->withPersonalTeam()->create();
        $contact = Contact::factory()->create();

        $this->actingAs($user)
            ->delete(route('contacts.destroy', $contact))
            ->assertStatus(303);

        $this->assertDatabaseMissing('contacts', $contact->getAttributes());
    }
}
