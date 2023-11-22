<?php

use App\Models\Pivot\BookUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('only allows authenticated users')

  ->get('/books/create')
  ->assertStatus(302);

  it('shows the available statuses on the form', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/books/create')
        ->assertSeeTextInOrder(BookUser::$statuses);
});