# Introduction

![preview](./docs/src/.vuepress/public/preview.png)

This is a Laravel package to help promote social proof and legitimacy within your application. With a simple blade component added to any page you can share with potential customers or users that other customers are using and/or paying for your product. A simple pop-up will display in the corner of page with information such as "Someone from New York purchased the business plan 2 minutes ago."

Full documentation can be found at [laravelbandwagon.com](https://www.laravelbandwagon.com)

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

![thumb](./docs/src/.vuepress/public/bandwagon-thumb.gif)

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
        "Someone from ${$user->state}",
        "Purchased the ${$product->displayName} plan",
        $request->ip(),
        route('purchase', $product->id)
    ); 
}
 ```
This will create a new Bandwagon record which then any users who are on the purchase page where you render the component (`<x-bandwagon-renderer />`) will see.

## Credits

- [Alex Harris](https://github.com/chasenyc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
