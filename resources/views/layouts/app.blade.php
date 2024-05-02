<!--
=========================================================
* File Management Dashboard - v1.0.3
=========================================================


* Copyright © 2024, made with  by Pearl Phuthegelo for a better web.


* Coded by Pearl Phuthegelo

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (env('IS_DEMO'))
        <x-demo-metas></x-demo-metas>
    @endif

    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
      Final Project
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/dataTables.min.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet" />
    <style>
      .custom-btn {
        padding: 5px 15px;
        font-size: 15px;
        margin-right: 10px;
      }
      body {
            background-image: url('assets/img/landboard.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .navbar {
            background-color: #FAF9F9;
            color: #ffffff;
        }
    </style>
    
  </head>

  <body class="g-sidenav-show  bg-gray-100 ">
    @auth
      @yield('auth')
    @endauth
    @guest
      @yield('guest')
    @endguest

    <!-- @if(session()->has('success'))
      <div x-data="{ show: true}"
          x-init="setTimeout(() => show = false, 4000)"
          x-show="show"
          class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
        <p class="m-0">{{ session('success')}}</p>
      </div>
    @endif -->
      <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script>
      new DataTable("#example", {
          search: {
              return: true
          },
          responsive: true,
          paging:  true,
      });
    </script>
    
    @stack('dashboard')
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery UI library -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
      // Function to handle AJAX request for deleting a record
      function deleteRecord(recordId) {
          // Send an AJAX POST request to delete the record
          $.ajax({
              url: '/files/' + recordId,
              method: 'DELETE',
              headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: { id: recordId },
              success: function(data) {
                  // Handle successful deletion
                  console.log(data.message); // Log success message
                  // Update UI or perform any other actions as needed
              },
              error: function(xhr, textStatus, errorThrown) {
                  // Handle errors
                  console.error('There was a problem with your AJAX request:', errorThrown);
              }
          });
      }

      $(document).ready(function() {
          // Initialize confirmation dialog
          $("#confirmation-dialog").dialog({
              autoOpen: false,
              modal: true,
              buttons: {
                  "Delete": function() {
                      // Get the record ID from the data attribute of the parent table row
                      const recordId = $(this).data('record-id');
                      // Close the dialog
                      $(this).dialog("close");
                      // Call deleteRecord function to delete the record
                      deleteRecord(recordId);
                  },
                  "Cancel": function() {
                      // Close the dialog
                      $(this).dialog("close");
                  }
              }
          });

          // Add event listener to delete buttons
          $('.delete-btn').click(function() {
              // Get the record ID from the data attribute of the parent table row
              const recordId = $(this).closest('tr').data('record-id');
              // Set the record ID as data attribute of the confirmation dialog
              $("#confirmation-dialog").data('record-id', recordId);
              // Open the confirmation dialog
              $("#confirmation-dialog").dialog("open");
          });
      });
  </script>
  <script>
    document.querySelectorAll('.assign-user').forEach(function(userLink) {
        userLink.addEventListener('click', function(event) {
            event.preventDefault();

            fetch('/file/assign', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_id: event.target.dataset.userId,
                    file_id: event.target.dataset.fileId
                })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .then(() => location.reload())
            .catch(error => console.error(error));
        });
    });
  </script> 
  <script>
    document.querySelectorAll('.change-status').forEach(function(userLink) {
        userLink.addEventListener('click', function(event) {
            event.preventDefault();

            fetch('/file/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: event.target.dataset.status,
                    file_id: event.target.dataset.fileId
                })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .then(() => location.reload())
            .catch(error => console.error(error));
        });
    });
  </script> 
  </body>
</html>
