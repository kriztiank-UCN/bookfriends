<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

// runs before each test, the $this->user property is available in every test
beforeEach(function () {
  $this->user = User::factory()->create();
});

it('only allows authenticated users to post')
  // ->expectGuest()->toBeRedirectedFor('/books', 'post');
  ->post('/books')
  ->assertStatus(302);

it('creates a book', function () {
  // $user = User::factory()->create(); // moved to beforeEach
  $this->actingAs($this->user)

    ->post('/books', [
      'title' => 'A book',
      'author' => 'An author',
      'status' => 'WANT_TO_READ'
    ]);

  $this->assertDatabaseHas('books', [
    'title' => 'A book',
    'author' => 'An author',
  ])
    ->assertDatabaseHas('book_user', [
      'user_id' => $this->user->id,
      'status' => 'WANT_TO_READ',
    ]);
});

it('requires a book title, author and status')
  // fn () => is a php shorthand function
  ->tap(fn () => $this->actingAs($this->user))
  ->post('/books')
  ->assertSessionHasErrors(['title', 'author', 'status']);

  it('requires a valid status')
    ->tap(fn () => $this->actingAs($this->user))
    ->post('/books', [
        'status' => 'EATING'
    ])
    ->assertSessionHasErrors(['status']);