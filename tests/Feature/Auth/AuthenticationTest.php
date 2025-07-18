<?php

use App\Models\User;

test('login screen can be rendered', function () {
  $response = $this->get('/login');
  $response->assertStatus(200);
});

test('members can authenticate and are redirected to member dashboard', function () {
  $user = User::factory()->create(['role' => 'member']);

  $response = $this->post('/login', [
    'email' => $user->email,
    'password' => 'password',
  ]);

  $this->assertAuthenticated();
  $response->assertRedirect('/member/dashboard');
});

test('users can not authenticate with invalid password', function () {
  $user = User::factory()->create(['role' => 'member']);

  $this->post('/login', [
    'email' => $user->email,
    'password' => 'wrong-password',
  ]);

  $this->assertGuest();
});

test('users can logout', function () {
  $user = User::factory()->create(['role' => 'member']);

  $response = $this->actingAs($user)->post('/logout');

  $this->assertGuest();
  $response->assertRedirect('/'); // adjust this if your logout redirect is different
});
