<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion w-100" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-regular fa-address-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Contacts</div>
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
            <span>Show</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select what to show:</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox">
                        <label>
                            <input class="mr-2" type="checkbox" name="callsign[]" value="mine">Mine only
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input id="by-callsign-checkbox" class="mr-2" type="checkbox" name="callsign[]" value="callsign">By Callsign:
                        </label>
                        <!-- Polje za vnos klicnega znaka, privzeto skrito -->
                        <input type="text" class="form-control" id="callsign_input" style="display: none;" placeholder="Enter callsign">
                    </div>
                </div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
           aria-expanded="true" aria-controls="collapseThree">
{{--            <i class="fa-solid fa-map-pin"></i>--}}
            <span>Event</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Filter by events</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="event[]" value="simplex_window">Simplex Window</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="event[]" value="weekly_net">Weekly Net</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="event[]" value="sota">(pmr) SOTA</label></div>
                    <div class="checkbox"><label><input class="mr-2" type="checkbox" name="event[]" value="classic">Classic</label></div>
                </div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
           aria-expanded="true" aria-controls="collapseFour">
{{--            <i class="fa-solid fa-map-pin"></i>--}}
            <span>Range (CB/PMR446)</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Filter by range:</h6>
                <div class="ml-2 mr-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="range[]" value="local" class="format-checkbox mr-2">Local (<5km)
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="range[]" value="medium" class="format-checkbox mr-2">Medium (<25km)
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="range[]" value="long_range" class="format-checkbox mr-2">Long range (>25km)
                        </label>
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
                    <div id="date-range-picker" class="mr-2" style="display: none;">
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
        <p class="text-center mb-2">Currently showing <strong id="qso-count" style="font-size: 0.9rem">{{$total}}</strong> contacts on the map!</p>
        <a class="btn btn-light btn-sm" href="/tools/contacts/create">Submit yours!</a>
    </div>

    <!-- Sidebar Return Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <i class="fa-solid fa-arrow-rotate-left fa-3x mb-2"></i>
        <p class="text-center mb-2" style="font-size: 0.9rem">Want to <strong>return to the general tool area?</strong></p>
        <a class="btn btn-info btn-sm" href="/tools">Return</a>
    </div>
</ul>
