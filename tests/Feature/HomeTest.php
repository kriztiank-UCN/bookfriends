<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('greets the user if they are signed out', function () {
    get('/')

    ->assertSee('Bookfriends')

    ->assertSee('Sign up to get started')
    
    ->assertDontSee(['Feed']);
});

it('shows authenticated menu items if the user is signed in', function () {
    // sign in
    $user = User::factory()->create();

    // acting as
    $this->actingAs($user)

    ->get('/')

    // check if we can see the correct menu items
    ->assertSeeText(['Feed', 'My books', 'Add a book', 'Friend', $user->name]);
});

it('shows unauthenticated menu items if the user is not signed in', function () {

    get('/')

    // check if we can see the correct menu items
    ->assertSeeText(['Home', 'Login', 'Register']);
});


