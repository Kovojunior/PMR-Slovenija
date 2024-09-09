<!-- $heading, zaradi "heading" => "Latest Listings" v return view() znotraj web.php -->
{{--<h1><?php echo $heading; ?></h1>--}}
{{--<?php foreach($listings as $listing): ?>--}}
{{--    <h2><?php echo $listing["title"]; ?></h2>--}}
{{--    <p><?php echo $listing["description"]; ?></p>--}}
{{--<?php endforeach; ?>--}}

{{--@extends("components.layout")--}}

{{-- wrappa celo spletno stran v sekcijo content, ime section("ime"), mora biti isto kot v layout.blade.php pri @yield("ime")!! --}}
{{--@section("content")--}}

{{-- nimamo več @extends in @section, saj lahko layout iz components dobimo z <x-layout> --}}
<x-layout>
    {{-- includa datoteko _hero.php iz partials/_hero.php --}}
    @include("partials._hero")
    @include("partials._search")
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        {{--@if(count($listings) == 0)--}}
        {{--    <p>No listings found!</p>--}}
        {{--@endif--}}

        {{--@php--}}
        {{--    $test = 1;--}}
        {{--@endphp--}}
        {{--{{$test}}--}}

        @php
            //    dd($listings["listings"]);
        @endphp

        @unless(count($listings) == 0)
            {{--@foreach($listings["listings"] as $listing)--}}
            {{-- v aa href dodamo opis Listinga s podanim idjem --}}
            @foreach($listings as $listing)
                {{--            <h2>--}}
                {{--                <a href="/listings/{{$listing["id"]}}">{{$listing["title"]}}"></a>--}}
                {{--            </h2>--}}
                {{--            <p>{{$listing["description"]}}</p>--}}
                {{-- dostopamo do kartice listing-card --}}
                {{-- če želimo vstavit samo navaden string, lahko damo <x-listing-card listing="hello" />, ker pa želimo vstavit spremenljivko, damo :listing="$ime_spr" --}}
                <x-listing-card :listing="$listing"/>
            @endforeach

        @else
            <p>No listings found!</p>
        @endunless
    </div>
    {{-- na dno strani doda številke za izbiranje strani --}}
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
{{--@endsection--}}
</x-layout>
