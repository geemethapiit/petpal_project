<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('provider/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('provider/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('provider/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('provider/images/favicon.png') }}" />
  <style>
            .custom-search-input {
            background-color: #d3d3d3; 
            border: 1px solid #ced4da;
            color: #000000; 
            border-radius: 0.25rem;
        }
        .custom-search-input::placeholder {
            color: black; 
            opacity: 1; 
        }
            </style>
</head>
<body>
  <div class="container-scroller d-flex">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">

          <div class="d-flex align-items-center justify-content-between">
            <a href="https://www.bootstrapdash.com/product/spica-admin/"><i class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white mr-0"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Navigation</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('providerdashboard')}}">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            <div class="badge badge-info badge-pill">2</div>
          </a>
        </li>
        <li class="nav-item sidebar-category">
          <p>Components</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-palette menu-icon"></i>
            <span class="menu-title">UI Elements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('viewpetpage')}}">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Pets</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/charts/chartjs.html">
            <i class="mdi mdi-chart-pie menu-icon"></i>
            <span class="menu-title">Records</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/tables/basic-table.html">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Appoinments</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/icons/mdi.html">
            <i class="mdi mdi-emoticon menu-icon"></i>
            <span class="menu-title">Feedbacks</span>
          </a>
        </li>
  


      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <li class="nav-item">
              <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">
                  Welcome back, {{ request()->query('business_name') }} 
              </h4>
          </li>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h4 class="mb-0 font-weight-bold d-none d-xl-block" id="currentDate"></h4>
            </li>
            <li class="nav-item dropdown me-1">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-calendar mx-0"></i>
                <span class="count bg-info">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>

              </div>
            </li>
            <li class="nav-item dropdown me-2">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-email-open mx-0"></i>
                <span class="count bg-danger">1</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Here..." aria-label="search" aria-describedby="search">
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <span class="nav-profile-name">Eleanor Richardson</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a>
                <form method="POST" action="{{ route('serviceProvider.logout') }}">
                  @csrf
                  <button class="dropdown-item" type="submit">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
              </div>
            </li>
     
          </ul>
        </div>
      </nav>
 <!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container">
            <h4 class="card-title mb-4">Our Pets</h4>

            <!-- Search Input -->
            <div class="mb-3">
                <input type="text" id="search" class="form-control custom-search-input" placeholder="Search by Name or Registration Number" onkeyup="filterPets()">
            </div>

            <div class="row" id="petsContainer">
                @foreach($pets as $pet)
                <div class="col-lg-4 col-md-6 mb-4 pet-card" data-name="{{ strtolower($pet->name) }}" data-regnum="{{ strtolower($pet->registration_number) }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pet->name }}</h5>
                            <p><strong>Registration Number:</strong> {{ $pet->registration_number }}</p>
                            <p><strong>Type:</strong> {{ $pet->type }}</p>
                            <p><strong>Breed:</strong> {{ $pet->breed }}</p>
                            <p><strong>Age:</strong> {{ $pet->age }} years</p>
                            <p><strong>Color:</strong> {{ $pet->color }}</p>
                            <p><strong>Gender:</strong> {{ $pet->gender }}</p>
                            <p><strong>Special Notes:</strong> {{ $pet->special_notes }}</p>
                            <a href="{{ route('pets.show', $pet->pet_id) }}" class="btn btn-info btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Button to Add Records -->
            <div class="mt-3">
                <a href="{{ route('addPet') }}" class="btn btn-primary">Add Pet Record</a>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial -->
</div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="{{ asset('provider/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('provider/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('provider/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('provider/js/off-canvas.js') }}"></script>
  <script src="{{ asset('provider/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('provider/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="{{ asset('provider/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{ asset('provider/js/dashboard.js') }}"></script>

  <script>
  // JavaScript to get today's date and format it
  document.addEventListener('DOMContentLoaded', function () {
    const dateElement = document.getElementById('currentDate');
    const today = new Date();

    // Options for date formatting
    const options = { month: 'short', day: 'numeric', year: 'numeric' };

    // Format date to "Sep 26, 2024" format
    const formattedDate = today.toLocaleDateString('en-US', options);

    // Set the formatted date inside the h4 element
    dateElement.textContent = formattedDate;
  });

  
document.getElementById('search').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent form submission
        filterPets(); // Call your filter function
    }
});

function filterPets() {
    const input = document.getElementById("search");
    const filter = input.value.toLowerCase();
    const petsContainer = document.getElementById("petsContainer");
    const petCards = petsContainer.getElementsByClassName("pet-card");

    for (let i = 0; i < petCards.length; i++) {
        const petCard = petCards[i];
        const petName = petCard.getAttribute("data-name");
        const petRegNum = petCard.getAttribute("data-regnum");

        if (petName.includes(filter) || petRegNum.includes(filter)) {
            petCard.style.display = "";
        } else {
            petCard.style.display = "none";
        }
    }
}
    </script>
  <!-- End custom js for this page-->
</body>

</html>