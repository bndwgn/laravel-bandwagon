<style>
.bandwagon-snackbar {
    visibility: hidden;
    min-width: 250px;
    max-width: 350px;
    margin-left: 0px;
    background-color: transparent;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 20px;
    bottom: 20px;
}
.bandwagon-snackbar.bandwagon-show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s {{ (config('bandwagon.display') - 0.5) }}s;
    animation: fadein 0.5s, fadeout 0.5s {{ (config('bandwagon.display') - 0.5) }}s;
}

.bandwagon-message {
    border-radius: .5rem;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
    padding: .8rem;
}

.bandwagon-text {
    margin: .1rem;
    font-family: sans-serif;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.bandwagon-title {
    text-align: left;
}

.bandwagon-title {
    color: #000;
    text-align: left;
    font-weight: 600;
}

.bandwagon-subtitle {
    color: #555;
    text-align: left;
}

.bandwagon-time {
    color: #888;
    text-align: right;
    font-size: 12px;
    margin-top: .3rem;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 20px; opacity: 1;}
}
  
@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 20px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 20px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 20px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}
</style>
<div id="bandwagon">
    <bandwagon-renderer 
        class-snackbar="{{ $classSnackbar }}"
        class-message="{{ $classMessage }}"
        class-title="{{ $classTitle }}"
        class-subtitle="{{ $classSubtitle }}"
        class-time="{{ $classTime }}"
    />
</div>
<script>
    window.Bandwagon = @json($bandwagonScriptVariables);
</script>
<script src="{{asset('vendor/bandwagon/app.js')}}"></script>