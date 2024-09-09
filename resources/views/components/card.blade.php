{{--<div class="bg-gray-50 border border-gray-200 rounded p-6">--}}
{{--    {{$slot}}--}}
{{--</div>--}}
{{-- zdaj smo naredili merge atributov, da ima lahko ta razred več različnih paddingov --}}
{{-- po deafultu uporabi klase "bg-gray-50 border border-gray-200 rounded p-6", vendar merga nove klase, ki jih dodamo --}}
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}
</div>
