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

@if (\Request::is('rtl'))
  <html dir="rtl" lang="ar">
@else
  <html lang="en" >
@endif

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
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/dataTables.dataTables.min.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/jquery-3.7.1.js"></script>
  <script src="../assets/js/dataTables.min.js"></script>
  <script>
    new DataTable("#example", {
        search: {
            return: true
        }
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
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
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
</body>

</html>
