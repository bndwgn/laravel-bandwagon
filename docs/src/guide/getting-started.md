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

## Configuring the package

There are a few simple configurations you can change through `config/bandwagon.php`:

```php 
'poll' => env('BANDWAGON_POLL', 30)`
``` 

`poll` refers to how often (in seconds) the package will poll for new messages 

```php
'display' => env('BANDWAGON_DISPLAY', 8000)
``` 
`display` refers to how long (in seconds) the message will display on the user's screen

```php
'oldest' => env('BANDWAGON_OLDEST', 8000)
``` 
`oldest` refers to how old of an event to display to the user


## Rendering the component

To render the component just add the component to any or all desired pages like so:
```html
<x-bandwagon>
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