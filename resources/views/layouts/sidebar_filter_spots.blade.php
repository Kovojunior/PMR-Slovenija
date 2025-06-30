<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion w-100" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-brands fa-hubspot"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Spots</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Filter area
    </div>

    <!-- Buttons -->
    <div class="panel-body filter-buttons">
        <button class="btn btn-success" type="submit" id="ApplyFilters">Apply</button>
        <button class="btn btn-danger" type="button" id="ClearSelections">Clear</button>
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
           aria-expanded="true" aria-controls="collapseOne">
            {{--            <i class="fa-regular fa-address-book"></i>--}}
            <span>QSO type</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select desired QSO type:</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="qso_type[]" value="PMR446">PMR446</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="qso_type[]" value="CB">CB</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="qso_type[]" value="Ham">Ham radio</label></div>
                </div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
           aria-expanded="true" aria-controls="collapseSix">
            <span>Spot type</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select a spot type:</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_type[]" value="portable">Portable</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_type[]" value="mobile">Mobile</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_type[]" value="qth">Home location (QTH)</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_type[]" value="alert">Alert</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_type[]" value="other">Other</label></div>
                </div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
           aria-expanded="true" aria-controls="collapseThree">
            {{--            <i class="fa-solid fa-map-pin"></i>--}}
            <span>Mode</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Filter by modes</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_mode[]" value="fm">FM</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_mode[]" value="am">AM</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_mode[]" value="ssb">SSB</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_mode[]" value="digital">Digital</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="spot_mode[]" value="other">Other</label></div>
                </div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
           aria-expanded="true" aria-controls="collapseFour">
            {{--            <i class="fa-solid fa-map-pin"></i>--}}
            <span>Show</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select what to show:</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="callsign[]" value="inactive">Show inactive</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="callsign[]" value="mine">Mine only</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="callsign[]" value="callsign">By Callsign:</label>
                        <input type="text" class="form-control" id="callsign_input">
                    </div>
                </div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
           aria-expanded="true" aria-controls="collapseFive">
            {{--            <i class="fa-solid fa-map-pin"></i>--}}
            <span>Date</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Filter by date:</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox">
                        <label><input class="mr-2" type="checkbox" name="date[]" value="today" class="format-checkbox">Today</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="mr-2" type="checkbox" name="date[]" value="this_week" class="format-checkbox">This week</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="mr-2" type="checkbox" name="date[]" value="this_month" class="format-checkbox">This month</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="mr-2" type="checkbox" name="date[]" value="this_year" class="format-checkbox">This year</label>
                    </div>
                    <!-- Checkbox za izbiro datuma -->
                    <div class="checkbox">
                        <label>
                            <input class="mr-2" type="checkbox" id="choose-date-checkbox" name="date[]" value="choose_date">Choose date
                        </label>
                    </div>
                    <!-- Dve polji za izbiro datuma (skrito dokler ni checkbox izbran) -->
                    <div id="date-range-picker" style="display: none;">
                        <label for="start-date">Start Date:</label>
                        <input type="text" id="start-date" name="start_date" placeholder="Select start date">

                        <label for="end-date">End Date:</label>
                        <input type="text" id="end-date" name="end_date" placeholder="Select end date">
                    </div>
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex mt-3">
        <div class="rotate-n-15">
            <i class="fa-solid fa-square-poll-vertical fa-3x mb-2"></i>
        </div>
        <p class="text-center mb-2">Currently showing <strong id="spot-count" style="font-size: 0.9rem">{{$total}}</strong> spots on the map!</p>
        <a class="btn btn-light btn-sm" href="/tools/spots/create">Submit yours!</a>
    </div>

    <!-- Sidebar Return Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <i class="fa-solid fa-arrow-rotate-left fa-3x mb-2"></i>
        <p class="text-center mb-2" style="font-size: 0.9rem">Want to <strong>return to the general tool area?</strong></p>
        <a class="btn btn-info btn-sm" href="/tools">Return</a>
    </div>
</ul>
