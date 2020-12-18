# Cleaning up old events

Every time an event is created using the the `Bandwagon::createEvent()` command a record is stored in the database in a table called `bandwagon_events`. Depending on how many events are being fired you will most likely want to cleanup this table from time to time. Additionally the `bandwagon.php` config key `oldest` dictates the oldest event to display to users, thus rendering any events older than `oldest` useless for this packages purposes.

## Console command

Out of the box you are provided with the following console command:
```sh
php artisan bandwagon:cleanup
```
This command will remove all events older than what is specified in the `bandwagon.php` config. You can see the specific key here:
```php
// config/bandwagon.php

'cleanup' => [
    'enabled' => env('BANDWAGON_CLEANUP_ENABLED', true),
    'olderthan' => env('BANDWAGON_CLEANUP_OLDER_THAN', 86400),
],
```
This will find any events older than `time() - config('bandwagon.cleanup.olderthan')`
and delete them from the database to keep a maintainable size to this table. Feel free to adjust it as you would like but keep in mind it is best practice to make this value equal to or higher than the `oldest` key found in `bandwagon.php`.