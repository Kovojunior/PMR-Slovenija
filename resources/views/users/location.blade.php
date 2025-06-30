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
    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}" type="text/css">
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
            <div class="container-fluid">
                <div class="main-body">
                    {{-- EDIT LOCATION FORM --}}
                    <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                            <div class="mt-3">
                                                <h4>{{$user->name}}</h4>
                                                <p class="text-secondary mb-1"><i class="fa-solid fa-map-location-dot mr-2"></i>{{$user->lat_lng}}</p>
                                                <p class="text-secondary mb-1"><i class="fa-solid fa-table-cells-large mr-2"></i>{{$user->grid}}</p>
                                                <p class="text-secondary mb-2"><i class="fa-solid fa-city mr-2"></i>{{$user->city}}</p>

                                                {{-- SUBMIT AND BACK BUTTONS --}}
                                                <button type="submit" class="btn btn-primary">Update Location</button>
                                                <a href="/users/{{auth()->id()}}/user-profile" class="btn btn-danger text-center">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-map-location-dot"></i> Location (Lat,Lng)</h6>
                                            <input type="text" id="lat_lng" name="lat_lng" class="text-secondary form-control border border-primary" readonly>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-table-cells-large"></i> Location Grid</h6>
                                            <input type="text" id="grid" name="grid" class="text-secondary form-control border border-primary" placeholder="JN75IV">

                                            {{-- MY GRID ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("grid")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="ml-2 mb-1"><i class="fa-solid fa-city"></i> City</h6>
                                            <input type="text" id="city" name="city" class="text-secondary form-control border border-primary" placeholder="Ljubljana">

                                            {{-- MY GRID ERROR DISPLAY --}}
                                            <div class="input-group">
                                                @error("city")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-between text-left">
                                            {{--MY LOCATION FIELD --}}
                                            <div class="form-group col-sm-12 flex-column d-flex">

                                                {{-- MAP --}}
                                                <div id="map" class="map" style="height: 600px;"></div>
                                                {{-- END OF MAP --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- END OF EDIT LOCATION FORM --}}
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
@php
    $mapZoom = $mapZoom ?? 9; // Privzeta vrednost je 9
    $markerDraggable = $markerDraggable ?? true; // Privzeta vrednost je true
@endphp
<script>
    let userLocation = "{{ $user->lat_lng ? $user->lat_lng : '46.1,14.7' }}".split(',').map(Number);
    let mapZoom = {{ $mapZoom }};
    let markerDraggable = {{ $markerDraggable ? 'true' : 'false' }};
</script>
<script src="{{ asset('/js/user_location.js') }}"></script>


