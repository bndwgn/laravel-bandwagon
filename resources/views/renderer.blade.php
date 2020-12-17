<style>
#bandwagon-snackbar {
    visibility: hidden;
    min-width: 250px; /* Set a default minimum width */
    max-width: 350px;
    margin-left: 0px; /* Divide value of min-width by 2 */
    background-color: transparent; /* Black background color */
    color: #fff; /* White text color */
    text-align: center; /* Centered text */
    border-radius: 2px; /* Rounded borders */
    padding: 16px; /* Padding */
    position: fixed; /* Sit on top of the screen */
    z-index: 1; /* Add a z-index if needed */
    left: 20px; /* Center the snackbar */
    bottom: 20px; /* 30px from the bottom */
}
#bandwagon-snackbar.show {
    visibility: visible; /* Show the snackbar */
    /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
    However, delay the fade out process for 2.5 seconds */
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
    <bandwagon-renderer />
</div>
<script>
    window.Bandwagon = @json($bandwagonScriptVariables);
</script>
<script src="{{asset('vendor/bandwagon/app.js')}}"></script>