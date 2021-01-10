# Getting Started

[[toc]]

## Installation

You can install this package via composer using: 

```sh
composer require bndwgn/laravel-bandwagon
```

The package will automatically register its service provider.
To publish the config file to `config/bandwagon.php` run:

```sh
php artisan vendor:publish --provider="Bndwgn\Bandwagon\BandwagonServiceProvider"
```

## Rendering the component
<br />
<img :src="$withBase('/bandwagon-thumb.gif')" alt="component">

To render the component just add the component to any or all desired pages like so:
```html
<body>
    <!-- html here -->
    <x-bandwagon-renderer />
</body>
```
Just make sure to put the component at the bottom of your body tag, outside of any other `<div>` tags.

## Publishing an event to users

To use the example of sharing a purchase with people who are on the purchase page of your application you would just add the following:
```php
// App/Http/Controllers/PurchaseController.php 
use Bndwgn\Bandwagon\Bandwagon;

public function purchase(Request $request, Product $product)
{
    $user = Auth::user(); 
    // ... logic to charge a customer
    Bandwagon::createEvent(
        "Someone from ${$user->state}",
        "purchased the ${$product->displayName} plan",
        $request->ip(), // nullable
        route('product', $product->id) // nullable
    ); 
}
 ```
::: tip
Leave the ip address param off to make sure even the user who created the event sees the message.
:::

This will create a new Bandwagon record which then any users who are on the purchase page where you render the component (`<x-bandwagon-renderer />`) will see.
