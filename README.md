# Laravel ChainRule

A chainable validation rule builder for Laravel.  
Simplifies writing complex validation rules by chaining methods together in a fluent, readable API .

## Features

- Chain simple rules : `required()`, `nullable()`, `email()`, `string()`, `integer()`, etc.  
- Chain parameterized rules : `between()`, `after()`, etc.  
- Conditional rules :
  - `addIfTrue($condition, $rule)` – adds the rule if the condition is `true`
  - `addIfFalse($condition, $rule)` – adds the rule if the condition is `false`
  - `addIfNull($value, $rule)` – adds the rule if the value is `null`
  - `addIfNotNull($value, $rule)` – adds the rule if the value is not `null`
  - `addIfEmpty($value, $rule)` – adds the rule if the value is empty (`null`, `[]`, `''`, `0`, `false`, or empty object)
  - `addIfNotEmpty($value, $rule)` – adds the rule if the value is not empty
  - `addWhen(callable $callback, $rule)` – adds the rule if the callback returns `true`
- Security helpers:
  - `stripTags(array $allowedHtmlTags)` – validates that the field contains only the given safe tags (all others are rejected).
  - `sanitizeXss(array $allowedHtmlTags)` – blocks malicious content like `<script>`, `onerror=`, `javascript:` links, and `alert()` while allowing safe tags.
- Automatic deduplication  of rules to prevent duplicates when chaining or merging.
- Returns rules as array  (`toArray()`) or string  (`toString()`).

## Installation

Install via Composer:

```bash
composer require kentjerone/laravel-chain-rule
```

## Usage in Form Requests

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

### Conditional Example

```php
$age = 20;

$rules = ChainRule::make()
    ->string()
    ->addIfTrue($age >= 18, 'required')
    ->addIfEmpty([], 'nullable')
    ->addWhen(fn() => $age < 18, 'min:18')
    ->toArray();

// Result: ['string', 'required', 'nullable']
```

### Using ChainRule with Arrays and ChainRule Objects

```php
$rules = ChainRule::make()
    ->string()
    ->addIfNotEmpty(['foo'], 'required')
    ->addIfNotNull(chainRule()->max(255))
    ->toArray();

// Result: ['string', 'required', 'max:255']
```

### Preventing XSS / Unsafe HTML

You can allow only safe HTML while rejecting scripts and malicious attributes:

```php
$rules = ChainRule::make()
    ->sanitizeXss(['b','i','u','p','a'])
    ->toArray();

// ✅ passes: <p>Hello <b>World</b></p>
// ❌ fails: <script>alert(1)</script>
// ❌ fails: <a href="javascript:alert(1)">Click</a>
```

Or allow only specific tags:

```php
$rules = ChainRule::make()
    ->stripTags(['b','i','u'])
    ->toArray();

// ✅ passes: <b>bold</b>
// ❌ fails: <div>not allowed</div>
```

## Helper Method

For convenience, you can use the global `chainRule()` helper instead of `ChainRule::make()`:

```php
use function KentJerone\ChainRule\chainRule;

$rules = chainRule()
    ->string()
    ->required()
    ->email()
    ->toArray();

// Result: ['string', 'required', 'email']
```
## Mass Method

```php
use function KentJerone\ChainRule\chainRule;

//example 1
$rules1 = chainRule()
    ->nullable_string_min_max(1, 255)
    ->toArray();

// Result: ['string', 'nullable', 'min:1', 'max:255']

//example 2
$rules2 = chainRule()
    ->nullable_string()
    ->toArray();

// Result: ['string', 'nullable']
```

## License

MIT
