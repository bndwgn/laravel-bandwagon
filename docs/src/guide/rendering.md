# Frontend

## Rendering the component

To render the component just add the component to any or all desired pages like so:
```html
<x-bandwagon>
```
This component will be published into your codebase when you run the vendor publish command during installation:
```sh
php artisan vendor:publish --provider="Bndwgn\Bandwagon\BandwagonServiceProvider"
```
You can find the blade in `resources\views\vendor\bandwagon\renderer.blade.php`. This blade view has some styling, the rendering of a Vue component and the necessary javascript to render said Vue component.

## Styling the component
While bandwagon comes with some very basic default styling, every HTML tag rendered has a prop you can pass in to override the default classes. For example you could pass the following into the component to override the styling of the title field:

```php
<x-bandwagon-renderer class-title="font-sans font-lg text-gray-700" />
```
which would override the title class with some tailwind styles.

### Styles override

| Prop name | Description |
| --------- | ----------- |
| class-snackbar | This is the wrapping div for the whole component |
| class-message | This is the message div that has the three lines of text within it |
| class-title | This is the title line of the message |
| class-subtitle | This is the subtitle line of the message | 
| class-time | This is the amount of time since the event occured |

You can see a slightly dumbed down (for simplicity's sake) version of the full component being rendered to understand what you are styling here:

```vue
    <div :class="this.classSnackbar">
        <div :class="this.classMessage">
            <p :class="this.classTitle">{{ title }}</p>
            <p :class="this.classSubtitle">{{ subtitle }}</p>
            <p :class="this.classTime">{{ timeAgo() }}</p>
        </div>
    </div>
```