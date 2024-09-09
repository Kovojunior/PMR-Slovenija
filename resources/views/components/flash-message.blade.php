@if(session()->has("message"))
    {{-- z nekaj dodatnimi lastnostmi diva: x-data, x-init, x-show smo s pomočjo AlpineJSa naredili, da okno izgine po 3 sekundah --}}
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
        <p>
            {{session("message")}}
        </p>
    </div>
@endif


