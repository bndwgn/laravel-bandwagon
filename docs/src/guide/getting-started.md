# Getting Started

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

To render the component just add the component to any or all desired pages like so:
```html
<x-bandwagon-renderer />
```
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
        "Someone in ${$user->state}",
        "Purchased ${$product->displayName}",
        $request->ip()
    ); 
}
 ```
This will create a new Bandwagon record which then any users who are on the purchase page where you render the component (`<x-bandwagon>`) will see.