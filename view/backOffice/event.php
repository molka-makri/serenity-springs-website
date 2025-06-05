<?php
include '../../Controller/eventController.php'; // Include the event controller
// Add an event
    // Check if form data is received via POST
    if (isset($_POST['event_name'], $_POST['event_description'], $_POST['event_date'], $_POST['event_location'], $_POST['Event_organizer'])) {
      if (!empty($_POST['event_name']) && !empty($_POST['event_description']) && !empty($_POST['event_date']) && !empty($_POST['event_location']) && !empty($_POST['Event_organizer'])) {
          try {
              // Validate and sanitize inputs
              $eventName = htmlspecialchars($_POST['event_name']);
              $eventDescription = htmlspecialchars($_POST['event_description']);
              $eventDate = new DateTime($_POST['event_date']); // Convert to DateTime
              $eventLocation = htmlspecialchars($_POST['event_location']);
              $eventOrganizer = (int)$_POST['Event_organizer']; // Ensure integer
  
              // Create the event object
              $event = new Event(
                  null, // New event, so ID is null
                  $eventName,
                  $eventDescription,
                  $eventDate, // Format DateTime to string
                  $eventLocation,
                  $eventOrganizer // Assign the organizer ID
              );
  
              // Call the controller to add the event
              $eventController = new eventsController();
              $eventController->addEvent($event);
  
              // Redirect to event page with success
              header('Location: event.php?success=1');
              exit;
  
          } catch (Exception $e) {
              echo "Error while adding event: " . $e->getMessage();
          }
      } else {
          echo "Please fill in all fields correctly.";
      }
  }
  
 // Update an event
if (isset($_POST['event_name1'], $_POST['event_description1'], $_POST['event_date1'], $_POST['event_location1'], $_POST['event_id1'], $_POST['event_organizer1'])) {
  // Ensure at least one field is filled in
  if (!empty($_POST['event_name1']) && !empty($_POST['event_description1']) && !empty($_POST['event_date1']) && !empty($_POST['event_location1']) && !empty($_POST['event_organizer1'])) {

      // Initialize event_date as DateTime or null
      $eventDate = !empty($_POST['event_date1']) ? new DateTime($_POST['event_date1']) : null;

      // Create the updated event object
      $updatedEvent = new Event(
          $_POST['event_id1'],  // Event ID for updating
          $_POST['event_name1'],
          $_POST['event_description1'],
          $eventDate, // DateTime object or null
          $_POST['event_location1'],
          $_POST['event_organizer1']
      );

      // Call the controller to update the event
      $eventController = new eventsController();
      $eventController->updateEvent1($updatedEvent);

      // Redirect to event page with success
      header('Location: event.php?success=1');
      exit; // Ensure no code runs after the redirection
  } else {
      echo "Please fill in all fields to update the event.";
  }
}

  
  // Delete an event
  if (isset($_POST['delete_event_id'])) {
      $deleteEventId = (int)$_POST['delete_event_id'];
  
      if ($deleteEventId > 0) {
          try {
              $eventsController = new eventsController();
              $eventsController->deleteEvent($deleteEventId);
  
              // Redirect to event page after deletion
              header('Location: event.php');
              exit;
          } catch (Exception $e) {
              echo "Error: " . $e->getMessage();
          }
      } else {
          echo "Invalid event ID.";
      }
  }
  
?>

<<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Serentiy Springs - backOffice
    </title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="green">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="green">
            <a href="index.html" class="logo">
              <img
                src="assets/img/kaiadmin/logo_light.png"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <span class="logo-text">Serenity Springs</span>
            <style>
            .logo-text {
              font-size: 20px; /* Adjust the text size */
              font-weight: bold; /* Make the text bold */
              color:  #2c6e2f; /* You can adjust this color as needed */
          }</style>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item">
                <a href="user/index.php">
                    <i class="fas fa-layer-group"></i>
                    <p>Manage Users</p>
                </a>
            </li>
              <li class="nav-item">
                <a href="product.php">
                    <i class="fas fa-layer-group"></i>
                    <p>Manage Product</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="event.php">
                  <i class="fas fa-layer-group"></i>
                  <p>Manage Events</p>
              </a>
          </li>
              <li class="nav-item">
                <a href="organizer.php">
                    <i class="fas fa-layer-group"></i>
                    <p>Manage Organizers</p>
                </a>
            </li>
              <li class="nav-item">
                <a href="service.php">
                    <i class="fas fa-layer-group"></i>
                    <p>Manage Services</p>
                </a>
            </li>
              
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar"></i>
                  <p>Posts and Comments</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="posts/listPosts.php">
                        <span class="sub-item">listPosts</span>
                      </a>
                    </li>
                    <li>
                      <a href="posts/listComments.php">
                        <span class="sub-item">listComments</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#staticsOrders" aria-expanded="false" aria-controls="staticsOrders">
                    <i class="fas fa-layer-group"></i>
                    <p>Manage Orders</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="staticsOrders">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="commande/statistiques_commandes.php">
                                <span class="sub-item">Orders Stats</span>
                            </a>
                        </li>
                        <li>
                            <a href="commande/listPayment.php">
                                <span class="sub-item">payment list</span>
                            </a>
                        </li>
                        <li>
                            <a href="commande/calendarCommandes.php">
                                <span class="sub-item">orders calendar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
              
              
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control"
                  />
                </div>
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="messageDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fa fa-envelope"></i>
                  </a>
                  <ul
                    class="dropdown-menu messages-notif-box animated fadeIn"
                    aria-labelledby="messageDropdown"
                  >
                    <li>
                      <div
                        class="dropdown-title d-flex justify-content-between align-items-center"
                      >
                        Messages
                        <a href="#" class="small">Mark all as read</a>
                      </div>
                    </li>
                    <li>
                      <div class="message-notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/jm_denis.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Jimmy Denis</span>
                              <span class="block"> How are you ? </span>
                              <span class="time">5 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/chadengle.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Chad</span>
                              <span class="block"> Ok, Thanks ! </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/mlane.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Jhon Doe</span>
                              <span class="block">
                                Ready for the meeting today...
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/talha.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Talha</span>
                              <span class="block"> Hi, Apa Kabar ? </span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);"
                        >See all messages<i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="notifDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fa fa-bell"></i>
                    <span class="notification">4</span>
                  </a>
                  <ul
                    class="dropdown-menu notif-box animated fadeIn"
                    aria-labelledby="notifDropdown"
                  >
                    <li>
                      <div class="dropdown-title">
                        You have 4 new notification
                      </div>
                    </li>
                    <li>
                      <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-icon notif-primary">
                              <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> New user registered </span>
                              <span class="time">5 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-success">
                              <i class="fa fa-comment"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Rahmad commented on Admin
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/profile2.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Reza send messages to you
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-danger">
                              <i class="fa fa-heart"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> Farrah liked Admin </span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);"
                        >See all notifications<i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <i class="fas fa-layer-group"></i>
                  </a>
                  <div class="dropdown-menu quick-actions animated fadeIn">
                    <div class="quick-actions-header">
                      <span class="title mb-1">Quick Actions</span>
                      <span class="subtitle op-7">Shortcuts</span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                      <div class="quick-actions-items">
                        <div class="row m-0">
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div class="avatar-item bg-danger rounded-circle">
                                <i class="far fa-calendar-alt"></i>
                              </div>
                              <span class="text">Calendar</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-warning rounded-circle"
                              >
                                <i class="fas fa-map"></i>
                              </div>
                              <span class="text">Maps</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div class="avatar-item bg-info rounded-circle">
                                <i class="fas fa-file-excel"></i>
                              </div>
                              <span class="text">Reports</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-success rounded-circle"
                              >
                                <i class="fas fa-envelope"></i>
                              </div>
                              <span class="text">Emails</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-primary rounded-circle"
                              >
                                <i class="fas fa-file-invoice-dollar"></i>
                              </div>
                              <span class="text">Invoice</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-secondary rounded-circle"
                              >
                                <i class="fas fa-credit-card"></i>
                              </div>
                              <span class="text">Payments</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Admin</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">My Balance</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Serentiy Springs</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="product.php" class="btn btn-primary btn-round">Manage products</a>
                <a href="user" class="btn btn-primary btn-round">Manage users</a>
                <a href="event.php" class="btn btn-primary btn-round">Manage events</a>
                <a href="organizer.php" class="btn btn-primary btn-round">Manage organizer</a>
                <a href="service.php" class="btn btn-primary btn-round">Manage services</a>
                <a href="posts/listPosts.php" class="btn btn-primary btn-round">Manage Posts</a>
                <a href="commande/listPayment.php" class="btn btn-primary btn-round">Manage orders</a>
              </div>
            </div>
            
                
     <div class="container mt-5">
    <h2 class="mb-4">Add Event</h2>
    <form id="addEventForm" action="event.php" method="post">
        <div class="mb-3">
            <label for="eventName" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="eventName" name="event_name" >
        </div>
        <div class="mb-3">
            <label for="eventDescription" class="form-label">Event Description</label>
            <textarea class="form-control" id="eventDescription" name="event_description" rows="3" ></textarea>
        </div>
        <div class="mb-3">
            <label for="eventDate" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="eventDate" name="event_date">
        </div>
        <div class="mb-3">
            <label for="eventLocation" class="form-label">Event Location</label>
            <input type="text" class="form-control" id="eventLocation" name="event_location" >
        </div>
        <div class="mb-3">
    <label for="eventOrganizer" class="form-label">Event Organizer</label>
    <select class="form-select" id="eventOrganizer" name="Event_organizer" >
        <option value="" disabled selected>Select an Organizer</option>
        <?php
        // Fetch organizers from the database
        $organizersController = new organizersController();
        $organizers = $organizersController->getOrganizers();

        if ($organizers && $organizers->rowCount() > 0) {
            while ($organizer = $organizers->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . htmlspecialchars($organizer['Organizer_id']) . "'>" . htmlspecialchars($organizer['Organizer_name']) . "</option>";
            }
        } else {
            echo "<option value='' disabled>No organizers available</option>";
        }
        ?>
    </select>
</div>
        <button type="submit" class="btn btn-primary">Add Event</button>
    </form>
</div>

<div class="container mt-5">
    <h2>Event List</h2>

    <!-- Organizer Filter Dropdown -->
    <form id="filterForm" action="" method="get">
        <div class="mb-3">
            <label for="organizerFilter" class="form-label">Filter by Organizer</label>
            <select id="organizerFilter" name="organizer_id" class="form-select" onchange="document.getElementById('filterForm').submit();">
                <option value="">Show All Events</option>
                <?php
                // Fetch all organizers
                $organizersController = new organizersController();
                $organizers = $organizersController->afficheOrganizers();
                foreach ($organizers as $organizer) {
                    $selected = isset($_GET['organizer_id']) && $_GET['organizer_id'] == $organizer['Organizer_id'] ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($organizer['Organizer_id']) . "' $selected>" . htmlspecialchars($organizer['Organizer_name']) . "</option>";
                }
                ?>
            </select>
        </div>
    </form>

    <?php
    $eventsController = new eventsController();
    $events = isset($_GET['organizer_id']) && !empty($_GET['organizer_id'])
        ? $eventsController->getEventsByOrganizer($_GET['organizer_id'])
        : $eventsController->getEvents(); // Fetch all events or by selected organizer

    if ($events && $events->rowCount() > 0) {
        echo "<div class='card-container'>";
        while ($event = $events->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($event['Event_name']) . "</h5>";
            echo "<p class='card-text'>" . htmlspecialchars($event['Event_description']) . "</p>";
            echo "<p class='card-text'><strong>Date: " . htmlspecialchars($event['Event_date']) . "</strong></p>";
            echo "<p class='card-text'><small class='text-muted'>Location: " . htmlspecialchars($event['Event_location']) . "</small></p>";
            echo "<p class='card-text'><small class='text-muted'>ID: " . htmlspecialchars($event['Event_id']) . "</small></p>";

            // Edit Button
           // Edit button for the event
           echo "<button class='btn btn-secondary btn-edit' onclick=\"showEditForm(
            '" . addslashes($event['Event_id']) . "', 
            '" . addslashes($event['Event_name']) . "', 
            '" . addslashes($event['Event_description']) . "', 
            '" . addslashes($event['Event_date']) . "', 
            '" . addslashes($event['Event_location']) . "', 
            '" . addslashes($event['Event_organizer']) . "')\">Edit</button>";
        

// Edit Form (hidden by default)
echo "<form action='event.php' method='post' class='edit-form' id='editForm-" . htmlspecialchars($event['Event_id']) . "' style='display: none; margin-top: 10px;'>";
echo "<input type='hidden' name='event_id1' value='" . htmlspecialchars($event['Event_id']) . "'>";

// Event Name
echo "<div class='mb-3'>";
echo "<label for='eventName'>Event Name</label>";
echo "<input type='text' class='form-control' name='event_name1' id='name-" . htmlspecialchars($event['Event_id']) . "' value='" . htmlspecialchars($event['Event_name']) . "' required>";
echo "</div>";

// Event Description
echo "<div class='mb-3'>";
echo "<label for='eventDescription'>Event Description</label>";
echo "<textarea class='form-control' name='event_description1' id='description-" . htmlspecialchars($event['Event_id']) . "' required>" . htmlspecialchars($event['Event_description']) . "</textarea>";
echo "</div>";

// Event Date
echo "<div class='mb-3'>";
echo "<label for='eventDate'>Event Date</label>";
echo "<input type='date' class='form-control' name='event_date1' id='date-" . htmlspecialchars($event['Event_id']) . "' value='" . htmlspecialchars($event['Event_date']) . "' required>";
echo "</div>";

// Event Location
echo "<div class='mb-3'>";
echo "<label for='eventLocation'>Event Location</label>";
echo "<input type='text' class='form-control' name='event_location1' id='location-" . htmlspecialchars($event['Event_id']) . "' value='" . htmlspecialchars($event['Event_location']) . "' required>";
echo "</div>";

// Event Organizer (Corrected placement)
echo "<div class='mb-3'>";
echo "<label for='eventOrganizer'>Event Organizer</label>";
echo "<input type='text' class='form-control' name='event_organizer1' id='organizer-" . htmlspecialchars($event['Event_id']) . "' value='" . htmlspecialchars($event['Event_organizer']) . "' required>";
echo "</div>";

echo "<button type='submit' class='btn btn-primary'>Update Event</button>";
echo "</form>";

            // Delete Form
            echo "<form action='event.php' method='post' onsubmit=\"return confirm('Are you sure you want to delete this event?');\">";
            echo "<input type='hidden' name='delete_event_id' value='" . htmlspecialchars($event['Event_id']) . "'>";
            echo "<button type='submit' class='btn btn-danger'>Delete Event</button>";
            echo "</form>";

            echo "</div>"; // Close card-body
            echo "</div>"; // Close card
        }
        echo "</div>";
    } else {
        echo "<p>No events found.</p>";
    }
    ?>
</div>

<script>
function showEditForm(id, name, description, date, location) {
    const form = document.getElementById(`editForm-${id}`);
    if (form.style.display === "none") {
        form.style.display = "block";
        document.getElementById(`name-${id}`).value = name;
        document.getElementById(`description-${id}`).value = description;
        document.getElementById(`date-${id}`).value = date;
        document.getElementById(`location-${id}`).value = location;
        document.getElementById(`organizer-${id}`).value = organizer;
    } else {
        form.style.display = "none";
    }
}
</script>

____________________________________________________________________________________________________________________  


        
        
        
        </div>
        </div>

       
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="assets/js/plugin/gmaps/gmaps.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>
  </body>
</html>
