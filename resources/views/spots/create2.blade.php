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
    <link rel="stylesheet" href="{{ asset('/css/spots_create.css') }}" type="text/css">

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
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row mt-3">
                    <!-- Form data -->
                    <div class="col-xl-3 col-lg-3">
                        <form method="POST" action="/spots" class="form-card" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Spot form</h6>

                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-success ml-auto">Create a spot</button>

                                        <div class="dropdown no-arrow ml-3">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                 aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body p-1 m-1">
                                    <ul class="list-group list-group-flush">
                                        {{-- Types of Spots: normal pmr, sota pmr, ??? --}}
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa fa-user"></i> Activation callsign (nickname)</h6>
                                            <span class="form-control-label ml-2 font-italic text-secondary"> Get user profile from database:
                                            <a href="#" onclick="getUserProfile()" class="text-info ml-2">GET</a></span>

                                            <input type="text" id="activation_callsign" name="activation_callsign" class="text-secondary form-control border border-primary" placeholder="S57KZ" value="{{old("activation_callsign")}}">
                                            {{-- activation_callsign ERROR DISPLAY --}}
                                            <p id="activation_callsign_error"></p>
                                            <div class="input-group">
                                                @error("activation_callsign")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-map-location-dot"></i> Location (Lat,Lng)</h6>
                                            <input type="text" id="location" name="location" class="text-secondary form-control border border-primary" value="{{old("location")}}" readonly>
                                            <div class="input-group">
                                                @error("location")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-wave-square"></i> Frequency/channel</h6>
                                            <input type="text" id="frequency" name="frequency" class="text-secondary form-control border border-primary" placeholder="446.00625" value="{{old("frequency")}}">
                                            <input type="hidden" id="Qso_type" name="Qso_type" value="">
                                            <div id="freqError"></div>
                                            {{-- MY GRID ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("frequency")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-signal"></i> Mode</h6>
                                            <select class="form-select text-primary form-control border border-primary" name="mode" id="mode" aria-label="mode">
                                                <option value="" {{ old('mode') == "" ? 'selected' : '' }}>Select mode</option>
                                                <option value="fm" {{ old('mode') == "fm" ? 'selected' : '' }}>FM</option>
                                                <option value="am" {{ old('mode') == "am" ? 'selected' : '' }}>AM</option>
                                                <option value="ssb" {{ old('mode') == "ssb" ? 'selected' : '' }}>SSB</option>
                                                <option value="digital" {{ old('mode') == "digital" ? 'selected' : '' }}>Digital</option>
                                                <option value="other" {{ old('mode') == "other" ? 'selected' : '' }}>Other</option>
                                            </select>
                                            {{-- MODE ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("mode")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-regular fa-clock"></i> Time window</h6>
                                            <select class="form-select text-primary form-control border border-primary" name="time" id="time" aria-label="time">
                                                <option value="" {{ old('time') == "" ? 'selected' : '' }}>Select time window</option>
                                                <option value="15min" {{ old('time') == "15min" ? 'selected' : '' }}>15 minutes or less</option>
                                                <option value="1h" {{ old('time') == "1h" ? 'selected' : '' }}>An hour</option>
                                                <option value="1day" {{ old('time') == "1day" ? 'selected' : '' }}>A day</option>
                                                <option value="infinite" {{ old('time') == "infinite" ? 'selected' : '' }}>Infinite</option>
                                                <option value="alert" {{ old('time') == "alert" ? 'selected' : '' }}>Alert in advance (TODO: koledar za izbor)</option>
                                            </select>

                                            {{-- TIME ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("time")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <!-- Skrit koledar za izbiro datuma in ure -->
                                            <div id="calendar-container" style="display: none; margin-top: 10px;">
                                                <label for="alert_date">Choose alert date and time:</label>
                                                <input type="datetime-local" id="alert_date" name="alert_date" class="form-control border border-primary">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-brands fa-hubspot"></i> Spot type</h6>
                                            <select class="form-select text-primary form-control border border-primary" name="type" id="type" aria-label="type">
                                                <option value="" {{ old('type') == "" ? 'selected' : '' }}>Select spot type</option>
                                                <option value="portable" {{ old('type') == "portable" ? 'selected' : '' }}>Portable (+ pmr SOTA/POTA)</option>
                                                <option value="mobile" {{ old('type') == "mobile" ? 'selected' : '' }}>Mobile</option>
                                                <option value="qth" {{ old('type') == "qth" ? 'selected' : '' }}>Qth</option>
                                                <option value="other" {{ old('type') == "other" ? 'selected' : '' }}>Other</option>
                                            </select>
                                            {{-- TYPE ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("type")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-note-sticky"></i> Comments</h6>
                                            <input type="text" id="comments" name="comments" class="text-secondary form-control border border-primary" placeholder="Notes..." value="{{old("comments")}}">
                                            {{-- MY CITY ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("comments")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Map and profile section -->
                    <div class="col-xl-9 col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Map (click to select location)</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                 aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body p-1">
                                        {{-- MAP --}}
                                        <div id="map" class="map" style="height: 50vh;"></div>
                                        {{-- END OF MAP --}}
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <!-- Profiles Row -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="card shadow mb-4">--}}
{{--                                    <!-- Card Header - Dropdown -->--}}
{{--                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                                        <h6 class="m-0 font-weight-bold text-primary">Spotter profile (you)</h6>--}}
{{--                                        <div class="dropdown no-arrow">--}}
{{--                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"--}}
{{--                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"--}}
{{--                                                 aria-labelledby="dropdownMenuLink">--}}
{{--                                                <div class="dropdown-header">Dropdown Header:</div>--}}
{{--                                                <a class="dropdown-item" href="#">Action</a>--}}
{{--                                                <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                                <div class="dropdown-divider"></div>--}}
{{--                                                <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Card Body -->--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="d-flex flex-column align-items-center text-center">--}}
{{--                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="96">--}}
{{--                                            <div class="mt-3">--}}
{{--                                                <h4>{{auth()->user()->name}}</h4>--}}
{{--                                                <p class="text-secondary mb-1"><i class="fa-solid fa-map-location-dot mr-2"></i>{{auth()->user()->lat_lng}}</p>--}}
{{--                                                <p class="text-secondary mb-1"><i class="fa-solid fa-table-cells-large mr-2"></i>{{auth()->user()->grid}}</p>--}}
{{--                                                <p class="text-secondary mb-2"><i class="fa-solid fa-city mr-2"></i>{{auth()->user()->city}}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Activator profile overview</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                 aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Profile picture" class="rounded-circle" width="96">
                                                    <div class="mt-3">
                                                        <h4 id="profile_name" class="text-secondary"></h4>
                                                        <div class="mb-1">
                                                            <p class="text-secondary mb-0" id="profile_grid"></p>
                                                        </div>
                                                        <div class="mb-2">
                                                            <p class="text-secondary mb-0" id="profile_city"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-12">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <p class="text-dark mt-4">Last 3 spots</p>
                                                    <table id="spotsTable" class="table table-sm">
                                                        <thead>
                                                        <tr class="text-primary">
                                                            <th scope="col">#</th>
                                                            <th scope="col">date</th>
                                                            <th scope="col">band.</th>
                                                            <th scope="col">type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- Dinamično dodane vrstice -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-sm-12">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <p class="text-dark mt-4">Last 3 contacts</p>
                                                    <table id="contactsTable" class="table table-sm">
                                                        <thead>
                                                        <tr class="text-primary">
                                                            <th scope="col">#</th>
                                                            <th scope="col">called</th>
                                                            <th scope="col">date</th>
                                                            <th scope="col">range (km)</th>
                                                            <th scope="col">type</th>
                                                            <th scope="col">event</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- Dinamično dodane vrstice -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                            </div>--}}
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

<!-- Custom scripts for PMR Slovenija-->
<script src="{{ asset('/js/spots_create.js') }}"></script>
<script>

</script>
