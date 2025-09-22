# Laravel ChainRule

A **chainable validation rule builder** for Laravel.  
Simplifies writing complex validation rules by chaining methods together.

## Features

- Chain simple rules like `required()`, `nullable()`, `email()`, `string()`, etc.
- Chain parameterized rules like `unique()`, `exists()`, `enum()`, `between()`, `after()`, etc.
- Fluent API for building validation rules in a clean, readable way.

## Installation

Install via Composer:

```bash
composer require kentjerone/laravel-chain-rule


### Usage in Form Requests

```php
use KentJerone\ChainRule\ChainRule;
use Illuminate\Validation\Rule;

$request->validate([
    'email' => ChainRule::make()
        ->required()
        ->string()
        ->email()
        ->toArray(),

    'user_id' => ChainRule::make()
        ->required()
        ->integer()
        ->merge([Rule::unique('users', 'id')])
        ->toArray(),
]);
```

```

