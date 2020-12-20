# Configuration

## Key values

There are a few simple configurations you can change through `config/bandwagon.php` that will all impact what and how messages are displayed to the end user:

```php 
'poll' => env('BANDWAGON_POLL', 30)`
``` 

`poll` refers to how often (in seconds) the package will poll for new messages.

```php
'display' => env('BANDWAGON_DISPLAY', 8000)
``` 
`display` refers to how long (in seconds) the message will stay on the user's screen.

```php
'oldest' => env('BANDWAGON_OLDEST', 86400)
``` 
`oldest` refers to how old of an event to display to the user. This value is in seconds and defaults to 1 day. What that means is when a user goes to a page where we are displaying bandwagon events, when they first come to the page there will be a poll to get the most recent event that has occured in under one day, if one is found it will be displayed.

```php
'enabled' => env('BANDWAGON_ENABLED', true)
``` 
`enabled` is a master switch for whether or not bandwagon does anything. If this is disabled no Bandwagon events will be recorded and no messages will be displayed to the user.

## Cleanup

For cleaning up old events there are a few keys that are used:
```php
'cleanup' => [
    'enabled' => env('BANDWAGON_CLEANUP_ENABLED', true),
    'olderthan' => env('BANDWAGON_CLEANUP_OLDER_THAN', 86400),
],
```
These keys are for use with cleaning up old Bandwagon Events. Events are stored in the database and will continue to grow with time, depending on your needs you may want to clear ones that will not be part of a query.  Any events that are older than the `oldest` config setting will never be used or displayed to a user. It is recommended that you keep your 
`olderthan` config the same or larger than the `oldest` key.

## Routes

These two values are for the api endpoint that exposes bandwagon events to the client.
```php
'domain' => env('BANDWAGON_DOMAIN', null),
'path' => env('BANDWAGON_PATH', 'bandwagon'),
```
`path` refers to the path prefix for the endpoint. `domain` refers to domain value passed to `Route::group`.