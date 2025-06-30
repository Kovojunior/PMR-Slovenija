{{-- naredili smo komponento, da bomo lahko dostopali do $listing, damo @props(["listing"]), torej @props('arrayOfProps') --}}
@props(["listing"])

<!-- Item 1 -->
<x-card>
    <div class="flex">
        {{--                        <img class="hidden w-48 mr-6 md:block" src="images/no-image.png" alt=""/>--}}
        {{--                        ekvivalentno s pomočjo helper classa --}}
        <img class="hidden w-48 mr-6 md:block" src="{{$listing->Upload_Pic ? asset("storage/" . $listing->Upload_Pic) : asset("/images/no-image.png")}}" alt=""/>
        <div>
            <h3 class="text-2xl">
                {{--                                <a href="show.html">{{$listing["title"]}}</a>--}}
                {{--                                collection sintaksa: ime spremenljivke->atribut--}}
                <a href="/listings/{{$listing->id}}">{{$listing->My_Callsign}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->Their_Callsign}}</div>

            {{-- tagi iz listing-tags.blade.php! --}}
            <x-listing-tags :tagsCsv="$listing->Date_Time" />

            <div class="text-lg mt-1">
                <i class="fa-solid fa-wave-square mr-2"></i>{{$listing->Freq}}
            </div>
            <div class="text-lg mt-1">
                <i class="fa-solid fa-location-dot"></i> {{$listing->My_Grid}}
            </div>
            <div class="text-lg mt-1">
                <i class="fa-solid fa-location-dot"></i> {{$listing->Their_Grid}}
            </div>
            <div class="text-lg mt-1">
                <i class="fa-solid fa-location-dot"></i>
            </div>
        </div>
    </div>
</x-card>
