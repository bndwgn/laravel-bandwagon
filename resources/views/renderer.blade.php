<div id="bandwagon">
    <bandwagon-renderer
        :display="{{ $display }}" 
        :poll="{{ $refresh }}"
        :prefix="{{ $prefix }}" 
    />
</div>
<script src="{{asset('vendor/bandwagon/app.js')}}"></script>