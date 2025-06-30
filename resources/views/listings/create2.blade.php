<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PMR Slovenija - Tool section</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/tools-frontend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/tools-frontend/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for PMR Slovenija -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://openlayers.org/en/v6.5.0/css/ol.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/contacts_create.css') }}" type="text/css">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('layouts.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid p-0">
                <div class="container-fluid px-1 py-5 mx-auto content">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                            <div class="card" style="background-color: #f3f1f4">
                                <h5 class="text-center mb-4">Submit contact log form</h5>

                                {{-- CREATE LOG FORM --}}
                                <form method="POST" action="/listings" class="form-card" enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    <!-- Rest of the form content here -->

                                    {{-- ROW --}}
                                    <div class="row justify-content-between text-left">

                                        {{-- MY CALLSIGN FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">

                                            <label class="form-control-label px-3"><i class="fa fa-user"></i> My Callsign
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input type="text" id="My_Callsign" name="My_Callsign" placeholder="S57KZ" value="{{old("My_Callsign")}}" onblur="validate(1)">
                                            {{-- MY CALLSIGN ERROR DISPLAY --}}
                                            <div>
                                                @error("My_Callsign")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- THEIR CALLSIGN FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-regular fa-user"></i> Their Callsign
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input type="text" id="Their_Callsign" name="Their_Callsign" value="{{old("Their_Callsign")}}" onblur="validate(2)">
                                            {{-- THEIR CALLSIGN ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Their_Callsign")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END OF ROW --}}


                                    {{-- ROW --}}
                                    <div class="row justify-content-between text-left">
                                        {{-- RTS SENT FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-solid fa-signal"></i> RST Sent
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input type="text" id="RST_Sent" name="RST_Sent" placeholder="59" value="{{old("RST_Sent")}}" onblur="validate(3)">
                                            {{-- RTS SENT ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("RST_Sent")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- RTS RECEIVED FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-solid fa-signal"></i> RST Rcvd
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input type="text" id="RST_Rcvd" name="RST_Rcvd" value="{{old("RST_Rcvd")}}" onblur="validate(4)">
                                            {{-- RTS RECEIVED ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("RST_Rcvd")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END OF ROW --}}


                                    {{-- ROW --}}
                                    <div class="row justify-content-between text-left">
                                        {{--MY LOCATION FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-solid fa-map-location-dot"></i> My Grid (location)
                                                <span class="text-danger"> *</span>
                                                <span class="form-control-label ml-1 font-italic text-secondary">Use your location from database</span>
                                                <input class="form-check-input ml-2 mt-2" type="checkbox" value="" id="flexCheckIndeterminate">
                                                <input type="hidden" id="userLatLng" value="{{ auth()->user()->lat_lng }}">
                                            </label>
                                            <input type="text" id="My_Grid" name="My_Grid" value="{{old("My_Grid")}}" onblur="validate(5)" placeholder="46.04813017777806, 14.507444731173871" readonly>

                                            {{-- MAP --}}
                                            <div id="map" class="map" style="height: 285px;"></div>
                                            {{-- END OF MAP --}}

                                            {{-- MY GRID ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("My_Grid")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- THEIR LOCATION FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            {{--                                    <form method="POST" action="{{route('users.get-location')}}"></form>--}}
                                            <label class="form-control-label px-3"><i class="fa-solid fa-map-location-dot"></i> Their Grid (location)
                                                <span class="text-danger"> *</span>
                                                <span class="form-control-label ml-1 font-italic text-secondary"> Get user location from database
                                                <a href="#" onclick="getUserCoordinates()" class="btn btn-secondary btn-sm ml-1" style="height: 25px; margin-top: -2%;">GET</a></span>
                                                {{--                                        <button type="button" class="btn-block btn-primary" onclick="getUserCoordinates()">Get location</button>--}}

                                            </label>
                                            <input type="text" id="Their_Grid" name="Their_Grid" value="{{old("Their_Grid")}}" onblur="validate(6)" readonly>

                                            {{-- SECOND MAP --}}
                                            <div id="map2" class="map" style="height: 285px;"></div>
                                            {{-- END OF SECOND MAP --}}

                                            {{-- THEIR GRID ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Their_Grid")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END OF ROW --}}


                                    {{-- ROW --}}
                                    <div class="row justify-content-between text-left">
                                        {{-- DATE AND TIME FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-regular fa-clock"></i> Date and Time
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input type="datetime-local" id="Date_Time" name="Date_Time" value="{{old("Date_Time")}}" onblur="validate(7)">
                                            {{-- DATE-TIME ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Date_Time")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- FREQUENCY FIELD --}}
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-solid fa-wave-square"></i> Frequency/Channel
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input type="text" id="Freq" name="Freq" placeholder="446.00625/CH1" value="{{old("Freq")}}" onblur="validate(8)">
                                            <div id="freqError"></div>
                                            {{-- FREQUENCY ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Freq")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END OF ROW --}}


                                    {{-- ROW --}}
                                    <div class="row justify-content-between text-left">
                                        {{-- UPLOAD A PICTURE FIELD --}}
                                        <div class="form-group col-6 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-regular fa-image"></i> Upload a Picture</label>
                                            <input type="file" id="Upload_Pic" name="Upload_Pic">
                                            {{-- UPLOAD PICTURE ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Upload_Pic")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- CHOOSE EVENT TYPE FIELD --}}
                                        <div class="form-group col-6 flex-column d-flex mt-1">
                                            <label class="form-control-label px-3"><i class="fa-solid fa-tag"></i> Choose an Event Type</label>
                                            <select class="form-select text-primary form-control border border-primary" name="Event_type" id="Event_type" aria-label="Event_type">
                                                <option value="classic" {{ old('Event_type') == "classic" ? 'selected' : '' }}>Classic</option>
                                                <option value="simplex_window" {{ old('Event_type') == "simplex_window" ? 'selected' : '' }}>Simplex Window</option>
                                                <option value="weekly_net" {{ old('Event_type') == "weekly_net" ? 'selected' : '' }}>Weekly Net</option>
                                                <option value="sota" {{ old('Event_type') == "sota" ? 'selected' : '' }}>(pmr) SOTA</option>
                                            </select>
                                            {{-- EVENT TYPE ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Event_type")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END OF ROW --}}


                                    {{-- ROW --}}
                                    <div class="row justify-content-between text-left">
                                        {{-- ADDITIONAL NOTES FIELD --}}
                                        <div class="form-group col-12 flex-column d-flex">
                                            <label class="form-control-label px-3"><i class="fa-solid fa-note-sticky"></i> Additional Notes
                                            </label>
                                            {{-- Hidden fields --}}
                                            <input type="hidden" id="QSO_Range" name="QSO_Range" value="">
                                            <input type="hidden" id="QSO_Type" name="QSO_Type" value="">
                                            <input type="text" id="Notes" name="Notes">
                                            {{-- !Hidden fields --}}
                                            {{-- ADDITIONAL NOTES ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("Notes")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END OF ROW --}}


                                    {{-- ROW --}}
                                    <div class="row justify-content-end">
                                        {{-- SUBMIT BUTTON --}}
                                        <div class="panel-body filter-buttons col-sm-6">
                                            <button class="btn btn-primary" type="submit" id="ApplyFilters">Apply</button>
                                            <button class="btn btn-danger" type="button" id="ClearSelections" href="#">Cancel</button>   {{-- TO:DO prestavi stran na overview tool area --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- END OF ROW --}}
                                {{-- END OF CREATE LOG FORM --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Footer -->
@include('layouts.footer')
<!-- End of Footer -->
@include('layouts.scroll_modal')

</body>
</html>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/tools-frontend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/tools-frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/tools-frontend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/tools-frontend/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('/tools-frontend/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/tools-frontend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('/tools-frontend/js/demo/chart-pie-demo.js') }}"></script>

<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Custom scripts for PMR Slovenija -->
<script src="{{ asset('/js/contacts_create.js') }}"></script>
