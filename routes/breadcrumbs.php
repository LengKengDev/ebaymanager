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
