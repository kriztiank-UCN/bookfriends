<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

// it('redirects authenticated user', function () {
//     expect(User::factory()->create())->toBeRedirectedFor('/auth/register');
// });

// high order test one-liner syntax
it('shows the register page')->get('/auth/register')->assertStatus(200);

it('has errors if the details are not provided')
    ->post('/register')
    ->assertSessionHasErrors(['name', 'email', 'password']);

// Simulates a post action to the database
it('registers the user')
    // tap() is a function that allows us to tap into the test
    // fn () => is a php shorthand function
    ->tap(fn () => $this->post('/register', [
        'name' => 'Kristian',
        'email' => 'kriztiank@gmail.com',
        'password' => 'Password'
    ])
    // Is it true?
    ->assertRedirect('/'))
    ->assertDatabaseHas('users', [
        'email' => 'kriztiank@gmail.com'
    ])
    ->assertAuthenticated();
