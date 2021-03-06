# Firing events

[[toc]]

## Publishing a new event

To use the example of sharing a purchase with people who are on the purchase page of your application you would just add the following:
```php
Bandwagon::createEvent(
    "Someone from ${$user->state}",
    "purchased the ${$product->displayName} plan",
    $request->ip(),
    route('product', $product->id)
); 
```
There are four parameters that are taken in by the `Bandwagon::createEvent(String $title, String $subtitle, String $ip, String $url)` function:

| Property | Required | Description |
| -----------| ------ | ----------- |
| title | true | This is the text that appears on the first line of the message displayed to users. By default this text is slightly more prominent due to css making the font-weight slightly higher and the color slightly darker |
| subtitle | true | This is the second line of text in the message displayed to users, it is more subtle than the first line by default |
| ip | false | This is the ip address of the user who's action caused this event.
| url | false | This will turn the notification into a clickable link that will route your users to a different page.

### Title
The title will be the first line of text in the notification that users will see. By default the first line is darker and a heavier font-weight than the subtitle. This can be customized through altering the css classes passed to the component. A good example of a title line might be "Someone in New York, NY". This is the social proof aspect that is being emphasized, another human being purchased, viewing or used your product.

### Subtitle
The subtitle is slightly less prominent and can also be altered through css, this field is required, if for any reason you would like to not include a second line you can always just pass an empty string. This line is suggested to be the action used by the consumer such as "purchased the annual plan" but can obviously be used in whatever way is desired. 

### IP Address
This field is not required, the purpose of this field is to allow for messages initiated by a user to be filtered out from display to that same user. For example, if there are three users, A, B and C, all three users are on the purchase page of a website, if user B were to make a purchase we would want to display that "Someone in New York, NY made a purchase 1 second ago" to user's A and C but we would not want to display this to user B, who made the purchase. If you would like for user B to see this message as well, you can omit the last parameter, the ip address, from `Bandwagon::createEvent()`.

## URL
This field is not required. This will turn the toast notification into a clickable object to send your users to a different page. A good example of this would be if you were displaying that someone purchased a specific prodct, if the user were to click the notification they would be brought to that specific product page.

## Laravel Event
The `Bandwagon::createEvent()` is a very simple wrapper that behind the scenes just fires a new Laravel Event.

### `Bndwgn\Bandwagon\Events\BandwagonEventCreated`
The `BandwagonEventCreated` event has three public properties on it: 
```php
/**
 * The title for the message displayed to users 
 */
public $title

/**
 * The subtitle for the message displayed to users 
 */
public $subtitle

/**
 * The ip address of the user who generated the event,
 * this is nullable and should only be used if you want
 * to filter this event from being seen by the initiator
 * of this event. 
 */
public $ip

/**
 * This is a url that will make the notification clickable
 */
public $url;
```

## Database

::: danger
If you are upgrading from a version below 0.3.3 you will need to make a new migration to add the `url` column into the `bandwagon_events` table.
:::

These events will then be stored in the database to a table named `bandwagon_events`. These events are stored by an event listener(`Bndwgn\Bandwagon\Listeners\RecordBandwagonEvent`). The databse schema is as follows:

```php
Schema::create('bandwagon_events', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('title');
    $table->string('subtitle');
    $table->string('ip', 50);
    $table->string('url');
    $table->integer('event_at')->unsigned();
    $table->timestamps();

    $table->index('ip');
    $table->index('event_at');
});
```

This table has a corresponding model that is used under the hood `Bndwgn\Bandwagon\Models\BandwagonEvent`.

