<?php

// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('home'));
});

// Accounts
Breadcrumbs::register('accounts', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Accounts', route('accounts.index'));
});

Breadcrumbs::register('accounts.edit', function ($breadcrumbs, $account) {
    $breadcrumbs->parent('accounts');
    $breadcrumbs->push($account->name, route('accounts.edit', ["account" => $account]));
});

// Users
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Users', route('users.index'));
});

Breadcrumbs::register('users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->email, route('users.show', ['user' => $user]));
});

Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.show', $user);
    $breadcrumbs->push("Edit", route('users.edit', ['user' => $user]));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push("Create a new user", route('users.create'));
});

// Orders
Breadcrumbs::register('orders', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Orders', route('orders.index'));
});


Breadcrumbs::register('orders.create', function ($breadcrumbs) {
    $breadcrumbs->parent('orders');
    $breadcrumbs->push("Create a new order", route('orders.create'));
});

Breadcrumbs::register('orders.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('orders');
    $breadcrumbs->push("Edit order");
});

// Import
Breadcrumbs::register('import', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Import', route('import.create'));
});
