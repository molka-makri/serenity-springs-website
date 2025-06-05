<?php

include '../../../Controller/eventController.php';

// Fetch events from the database
$eventController = new eventsController();
$events = $eventController->getEvents();

$eventDates = [];
if ($events && $events->rowCount() > 0) {
    while ($event = $events->fetch(PDO::FETCH_ASSOC)) {
        // Format event date as YYYY-MM-DD
        $eventDates[] = date('Y-m-d', strtotime($event['Event_date']));
    }
}
?>

<!-- Pass the event dates to JavaScript -->
<script>
  var eventDates = <?php echo json_encode($eventDates); ?>;
</script>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Serenity Springs</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.ico" rel="icon">
  <link href="img/favicon.ico" type="img/x-icon" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
  <style>
       
       .language-btn {
            position: fixed; /* Fixed position on the screen */
            top: 20px; /* Adjust to place it where you want */
            right: 20px; /* Align it to the right side */
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Change button color on hover */
        .language-btn:hover {
            background-color: #45a049;
        }
  </style>
  <style>
    /* General calendar styling */
    .hb-calendar {
        font-family: Arial, sans-serif;
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    


    /* Month navigation styling */
    .hb-months {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #f5f5f5;
        border-bottom: 1px solid #ddd;
    }

    .hb-months a {
        text-decoration: none;
        color:  #4CAF50;
        font-weight: bold;
    }

    .hb-months a:hover {
        text-decoration: underline;
    }

    .hb-current-month {
        color: #333;
        font-size: 18px;
        text-align: center;
        flex-grow: 2;
    }

    /* Days of the week */
    .hb-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        padding: 10px;
        background-color: #fff;
    }

    .hb-day-name {
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    /* Individual days */
    .hb-day {
        padding: 10px;
        margin: 2px;
        border-radius: 4px;
        background-color: #f9f9f9;
        color: #333;
        cursor: pointer;
    }

    .hb-day:hover {
        background-color: #e0e0e0;
    }

    .hb-day.highlight {
        background-color: #FFD700;
        color: #000;
        font-weight: bold;
    }

    /* Empty cells */
    .hb-day:not([class*="hb-day-name"]):empty {
        cursor: default;
        background: none;
    }

    /* Arrows */
    .hb-change-month {
        font-size: 20px;
        z-index: 1;
        cursor: pointer;
    }

    .hb-change-month:hover {
        color: #0056b3; /* Darker blue on hover */
    }
</style>
<style>
 #weather-section {
  background-color: #f9f9f9;
  padding: 20px;
  margin-top: 40px;
  border-radius: 8px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.weather-container {
  align-items: center;
  justify-content: space-between;
  text-align: center;
  cursor: pointer; /* Indicates the icon is clickable */
}

.weather-icon {
  width: 60px;
  height: 60px;
  margin-left: 20px;
  object-fit: contain;
  cursor: pointer;
}

.weather-heading {
  font-size: 24px;
  font-weight: bold;
  color: #2e3b4e;
  margin-bottom: 10px;
}

.weather-detail {
  font-size: 16px;
  color: #555;
  line-height: 1.6;
}

.weather-detail strong {
  color: #333;
}

/* Hide the weather section initially */
.hidden {
  display: none;
}

/* Additional Styling for Responsiveness */
@media (max-width: 768px) {
  .weather-container {
    flex-direction: column;
    align-items: center;
  }

  .weather-icon {
    margin-top: 15px;
  }
}
</style>

</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">
    

      <!--<div id="logo" class="pull-left">
         Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>
        <a href="#intro" class="scrollto"><img src="img/logo.png" alt="" title=""></a>
      </div>-->

      <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li><a href="#about" class="about-title">About our Events</a></li>
        <li><a href="#speakers" class="organizers-title">Organizers</a></li>
        <li><a href="#events" class="program-title">Schedule</a></li>
        <li><a href="#calendar" class="calendar-title">Calendar</a></li>
        <li><a href="#gallery" class="gallery-title">Gallery</a></li>
        <li><a href="#contact" class="contact-title">Contact</a></li>
      </ul>
    </nav>

    <!-- Language Switcher -->
    <div class="language-switcher">
      <button id="enBtn">EN</button>
      <button id="frBtn">FR</button>
    </div>

    <!-- Weather Info Display -->
    <!-- Weather Info Display -->
    
  </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">Serenity<br><span>Springs</span> Events</h1>
      
      <a href="#about" class=" about-title1">About The Event</a>
    </div>
  </section>
  
  

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="about-title2">About our Events</h2>
            <p  class="about-content">Our events are designed to inspire, educate, and connect individuals who are passionate about sustainable farming, innovation, and the future of food production. Whether you're a seasoned professional or just starting out, joining our events offers a unique opportunity to learn from experts, share ideas, and be part of a community dedicated to making a positive impact on the world. Don’t miss out—become a part of the agricultural revolution at Serenity Springs today!</p>
          </div>
          
          
          
        </div>
      </div>
    </section>
    <div id="weather-info" class="weather-container">
  
 
 
  
</div>
    

<script>
  const url = 'http://api.weatherapi.com/v1/current.json?key=0c966ea99c5f4666aa4224142240812&q=Tunis&aqi=no';

async function fetchClimateData() {
  try {
    const response = await fetch(url);
    const data = await response.json(); // Parse the JSON response

    // Extract weather information from the response
    const location = data.location.name; 
    const condition = data.current.condition.text; 
    const tempC = data.current.temp_c; 
    const tempF = data.current.temp_f; 
    const windSpeed = data.current.wind_kph; 
    const windDirection = data.current.wind_dir; 
    const humidity = data.current.humidity; 
    const icon = data.current.condition.icon; 

    // Display the weather data on the page
    document.getElementById('weather-info').innerHTML = `
      <br>
    <h3>Current Weather in ${location}</h3>
      <p><strong>Condition:</strong> ${condition}</p>
      <p><strong>Temperature:</strong> ${tempC}°C / ${tempF}°F</p>
      <p><strong>Wind Speed:</strong> ${windSpeed} km/h (${windDirection})</p>
      <p><strong>Humidity:</strong> ${humidity}%</p>
      <img src="https:${icon}" alt="Weather Icon" class="weather-icon">
    `;
  } catch (error) {
    console.error('Error fetching weather data:', error);
    document.getElementById('weather-info').innerHTML = 'Unable to fetch weather data.';
  }
}

// Call the function to fetch and display the data when the page loads
fetchClimateData();
</script>



    <!--==========================
      Oragnizer Section
    ============================-->
    <section id="speakers" class="wow fadeInUp">
  <div class="container">
    <div class="section-header">
      <h2 class="organizers-title1">Event Organizers</h2>
      <p class="organizers-content">Here are some of our Organizers</p>
    </div>

    <div class="row">
      <?php
      // Create an instance of the organizersController class
      $organizerController = new organizersController();
      $organizers = $organizerController->getorganizers();

      // Check if there are any organizers to display
      if ($organizers && $organizers->rowCount() > 0) {
        $images = [
          
          'img/speakers/2.jpg',
          'img/speakers/3.jpg',
          'img/speakers/4.jpg',
          'img/speakers/5.jpg',
          'img/speakers/6.jpg'
        ];
        $index = 0;

        while ($organizer = $organizers->fetch(PDO::FETCH_ASSOC)) {
          echo '<div class="col-lg-4 col-md-6">';
          echo '<div class="speaker">';
          echo '<img src="' . htmlspecialchars($images[$index % count($images)]) . '" alt="' . htmlspecialchars($organizer['Organizer_name']) . '" class="img-fluid">';
          echo '<div class="details">';
          echo '<h3>' . htmlspecialchars($organizer['Organizer_name']) . '</h3>';
          echo '<p>Email: ' . htmlspecialchars($organizer['Organizer_email']) . '</p>';
          echo '<div class="social">';
          echo '<a href="#"><i class="fa fa-twitter"></i></a>';
          echo '<a href="#"><i class="fa fa-facebook"></i></a>';
          echo '<a href="#"><i class="fa fa-google-plus"></i></a>';
          echo '<a href="#"><i class="fa fa-linkedin"></i></a>';
          echo '</div>'; // social div
          echo '</div>'; // details div
          echo '</div>'; // speaker div
          echo '</div>'; // col div
          
          $index++;
        }
      } else {
        echo '<div class="col-md-12 text-center">';
        echo '<p>No organizers available at the moment.</p>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>


    <!--==========================
      Schedule Section
    ============================-->
    <section id="events" class="wow fadeInUp">
  <div class="container">
    <div class="section-header">
      <h2 class="program-title1">Event Schedule</h2>
      <p class="program-content">Here is our event schedule</p>
    </div>

    <div class="row" id="events-container">
      <?php
      // Create an instance of the eventController class
      $eventController = new eventsController();
      $events = $eventController->getEvents();

      // Check if there are any events to display
      if ($events && $events->rowCount() > 0) {
        while ($event = $events->fetch(PDO::FETCH_ASSOC)) {
          echo '<div class="col-lg-4 col-md-6">';
          echo '<div class="speaker">';
          echo '<img src="img/gallery/1.jpg" alt="' . htmlspecialchars($event['Event_name']) . '" class="img-fluid">';
          echo '<div class="details">';
          echo '<h3>' . htmlspecialchars($event['Event_name']) . '</h3>';
          echo '<p>' . htmlspecialchars($event['Event_description']) . '</p>';
          echo '<p><strong>Date: ' . htmlspecialchars($event['Event_date']) . '</strong></p>';
          echo '<p>Place: ' . htmlspecialchars($event['Event_location']) . '</p>';
          echo '<button class="btn btn-primary participate-btn" data-event-id="' . htmlspecialchars($event['Event_id']) . '" data-event-name="' . htmlspecialchars($event['Event_name']) . '">Participate</button>';
          echo '</div>'; 
          echo '</div>'; 
          echo '</div>'; 
        }
      } else {
        echo '<div class="col-md-12 text-center">';
        echo '<p>No events available at the moment.</p>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>



<!--==========================
      calendrier Section
    ============================-->
    <br>
<br>
<section id="calendar" class="wow fadeInUp">
  <div class="hb-calendar">
    <div class="hb-months">
      <a href="javascript:;" class="hb-change-month hb-prev-month" data-month="12" data-year="2024">&#9664;</a>
      <a href="javascript:;" class="hb-current-month" data-month="12" data-year="2024">
          December <span id="current-year">2024</span>
      </a>
      <a href="javascript:;" class="hb-change-month hb-next-month" data-month="1" data-year="2025">&#9654;</a>
    </div>

    <div class="hb-days">
      <span class="hb-day hb-day-name">Mon</span>
      <span class="hb-day hb-day-name">Tue</span>
      <span class="hb-day hb-day-name">Wed</span>
      <span class="hb-day hb-day-name">Thu</span>
      <span class="hb-day hb-day-name">Fri</span>
      <span class="hb-day hb-day-name">Sat</span>
      <span class="hb-day hb-day-name">Sun</span>
      <!-- Day cells will be inserted dynamically here -->
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const prevButton = document.querySelector('.hb-prev-month');
      const nextButton = document.querySelector('.hb-next-month');
      const monthDisplay = document.querySelector('.hb-current-month');
      const yearDisplay = document.querySelector('#current-year');
      const daysContainer = document.querySelector('.hb-days');

      let currentMonth = 12; // Start with December 2024
      let currentYear = 2024;

      // PHP: Fetch event dates from the database
      // Assuming eventDates is fetched and passed from PHP as a JSON-encoded array
      const eventDates = <?php echo json_encode($eventDates); ?>;

      // Function to generate the days for the current month
      function generateDays(month, year) {
        // Clear previous day cells
        daysContainer.innerHTML = `
          <span class="hb-day hb-day-name">Mon</span>
          <span class="hb-day hb-day-name">Tue</span>
          <span class="hb-day hb-day-name">Wed</span>
          <span class="hb-day hb-day-name">Thu</span>
          <span class="hb-day hb-day-name">Fri</span>
          <span class="hb-day hb-day-name">Sat</span>
          <span class="hb-day hb-day-name">Sun</span>
        `;

        // Calculate the first day of the month (0 = Sunday, 1 = Monday, etc.)
        const firstDay = new Date(year, month - 1, 1).getDay();
        const daysInMonth = new Date(year, month, 0).getDate();

        // Generate empty days for the days before the start of the month
        for (let i = 0; i < firstDay; i++) {
          const emptyDay = document.createElement('span');
          emptyDay.classList.add('hb-day');
          emptyDay.innerHTML = '&nbsp;';
          daysContainer.appendChild(emptyDay);
        }

        // Generate the days of the month
        for (let i = 1; i <= daysInMonth; i++) {
          const day = document.createElement('span');
          day.classList.add('hb-day');
          day.textContent = i;

          // Format the current date to match the event date format (YYYY-MM-DD)
          const currentDate = `${year}-${String(month).padStart(2, '0')}-${String(i).padStart(2, '0')}`;

          // Highlight the day if it matches any event date
          if (eventDates.includes(currentDate)) {
            day.classList.add('highlight');
          }

          daysContainer.appendChild(day);
        }
      }

      // Function to update the month and year display
      function updateMonthDisplay() {
        const monthNames = [
          'January', 'February', 'March', 'April', 'May', 'June',
          'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Update the month and year in the display
        monthDisplay.firstChild.textContent = monthNames[currentMonth - 1];  // Set the correct month
        yearDisplay.textContent = currentYear; // Set the year correctly
      }

      // Handle the "previous month" button click
      prevButton.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 1) {
          currentMonth = 12;
          currentYear--;
        }
        generateDays(currentMonth, currentYear);
        updateMonthDisplay();
      });

      // Handle the "next month" button click
      nextButton.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 12) {
          currentMonth = 1;
          currentYear++;
        }
        generateDays(currentMonth, currentYear);
        updateMonthDisplay();
      });

      // Initialize the calendar with December 2024
      generateDays(currentMonth, currentYear);
      updateMonthDisplay();
    });
  </script>
</section>

<style>
  /* Highlight event dates */
  .hb-day.highlight {
    background-color: #6DBE45; /* Lush green background */
    color: white; /* White text color */
    font-weight: bold; /* Bold text */
    border-radius: 50%; /* Rounded corners for a circular highlight */
    padding: 8px; /* Adds some padding for a better visual effect */
    box-shadow: 0 0 8px rgba(0, 128, 0, 0.5); /* Soft green shadow for depth */
    background-image: linear-gradient(135deg, rgba(0, 128, 0, 0.7) 0%, rgba(107, 190, 69, 0.7) 100%); /* Light gradient */
  }

  /* Optional: Add a subtle texture for an organic feel */
  .hb-day.highlight::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('https://www.transparenttextures.com/patterns/diagonal-stripes.png'); /* Organic diagonal stripes texture */
    opacity: 0.15; /* Subtle texture */
    border-radius: 50%; /* Rounded corners for texture effect */
  }
  
</style>


 
    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery" class="wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check our gallery from the recent events</p>
        </div>
      </div>

      <div class="owl-carousel gallery-carousel">
        <a href="img/gallery/1.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/1.jpg" alt=""></a>
        <a href="img/gallery/2.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/2.jpg" alt=""></a>
        <a href="img/gallery/3.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/3.jpg" alt=""></a>
        <a href="img/gallery/4.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/4.jpg" alt=""></a>
        <a href="img/gallery/5.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/5.jpg" alt=""></a>
        <a href="img/gallery/6.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/6.jpg" alt=""></a>
        <a href="img/gallery/7.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/7.jpg" alt=""></a>
        <a href="img/gallery/8.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/8.jpg" alt=""></a>
      </div>

    </section>

    <!--==========================
      Sponsors Section
    ============================-->
    
    

    <!--==========================
      Buy Ticket Section
    ============================
    <section id="buy-tickets" class="section-with-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h2>Buy Tickets</h2>
          <p>Velit consequatur consequatur inventore iste fugit unde omnis eum aut.</p>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">Standard Access</h5>
                <h6 class="card-price text-center">$150</h6>
                <hr>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                  <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Community Access</li>
                  <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                  <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                </ul>
                <hr>
                <div class="text-center">
                  <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal" data-ticket-type="standard-access">Buy Now</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">Pro Access</h5>
                <h6 class="card-price text-center">$250</h6>
                <hr>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                  <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                  <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                </ul>
                <hr>
                <div class="text-center">
                  <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal" data-ticket-type="pro-access">Buy Now</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Pro Tier 
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">Premium Access</h5>
                <h6 class="card-price text-center">$350</h6>
                <hr>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>Workshop Access</li>
                  <li><span class="fa-li"><i class="fa fa-check"></i></span>After Party</li>
                </ul>
                <hr>
                <div class="text-center">
                  <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal" data-ticket-type="premium-access">Buy Now</button>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Modal Order Form 
      <div id="buy-ticket-modal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buy Tickets</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="#">
                <div class="form-group">
                  <input type="text" class="form-control" name="your-name" placeholder="Your Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="your-email" placeholder="Your Email">
                </div>
                <div class="form-group">
                  <select id="ticket-type" name="ticket-type" class="form-control" >
                    <option value="">-- Select Your Ticket Type --</option>
                    <option value="standard-access">Standard Access</option>
                    <option value="pro-access">Pro Access</option>
                    <option value="premium-access">Premium Access</option>
                  </select>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn">Buy Now</button>
                </div>
              </form>
            </div>
          </div><!-- /.modal-content 
        </div><!-- /.modal-dialog 
      </div><!-- /.modal 

    </section>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Nihil officia ut sint molestiae tenetur.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>A108 Adam Street, NY 535022, USA</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@example.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->
    

  </main>
  <div class="modal fade" id="participateModal" tabindex="-1" aria-labelledby="participateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="participateModalLabel">Event Participation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="participationForm" method="POST" action="../../../view/backOffice/events/participants.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <input type="hidden" name="event_id" id="event_id">
                    <button type="submit" class="btn btn-primary">Validate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Modal Behavior -->
<script>
    // Handle button click to show the participation modal
    document.querySelectorAll('.participate-btn').forEach(button => {
        button.addEventListener('click', function() {
            var eventId = this.getAttribute('data-event-id');
            var eventName = this.getAttribute('data-event-name');

            // Set the event ID and name in the modal's form
            document.getElementById('event_id').value = eventId;

            // Open the modal
            new bootstrap.Modal(document.getElementById('participateModal')).show();
        });
    });
</script>
<!--traduction----->
<script>
    // Function to load JSON data
    function loadLanguage(language) {
      fetch(language + '.json')
        .then(response => response.json())
        .then(data => {
          // Set the content based on the language
          document.querySelector('.about-title').textContent = data.about_title;
          document.querySelector('.about-content').textContent = data.about_content;
          document.querySelector('.organizers-title').textContent = data.organizers_title;
          document.querySelector('.organizers-content').textContent = data.organizers_content;
          document.querySelector('.program-title').textContent = data.program_title;
          document.querySelector('.program-content').textContent = data.program_content;
          
          document.querySelector('.gallery-title').textContent = data.gallery_title;
          document.querySelector('.about-title1').textContent = data.about_title1;
          document.querySelector('.about-title2').textContent = data.about_title2;
          document.querySelector('.organizers-title1').textContent = data.organizers_title1;
          document.querySelector('.program-title1').textContent = data.program_title1;
      
        })
        .catch(err => console.log('Error loading language:', err));
    }

    // Set default language to English
    loadLanguage('english');

    // Event listeners for language switcher buttons
    document.getElementById('enBtn').addEventListener('click', () => loadLanguage('english'));
    document.getElementById('frBtn').addEventListener('click', () => loadLanguage('french'));
  </script>
  <!--==========================
    Footer
  ============================-->
  <!--  footer -->
  <footer id="footer" style="background-color: #2c6e49; padding: 60px 0; font-family: 'Roboto', sans-serif; color: #fff; border-top: 2px solid #4CAF50;">
    <div class="container">
      <div class="row">
        <!-- Footer Info Section (Left-Aligned) -->
        <div class="col-lg-6 footer-info" style="text-align: left; color: #fff;">
          <img src= "img/sans back.png"alt="Serenity Springs" style="max-width: 180px; margin-bottom: 20px;">
          <p style="font-size: 18px; line-height: 1.6; font-weight: 400;">
            Welcome to <strong>Serenity Springs</strong>, where nature and agriculture come together to create sustainable solutions. Join us on our journey toward a green future, cultivating harmony with the Earth.
          </p>
        </div>
  
        <!-- Contact Us Section (Right-Aligned) -->
        <div class="col-lg-6 footer-contact" style="text-align: right; color: #fff; padding-left: 40px;">
          <h4 style="font-size: 22px; color: #fff; font-weight: bold; margin-bottom: 20px;">Contact Us</h4>
          <p style="font-size: 16px; line-height: 1.6;">
            <strong>Serenity Springs</strong><br>
            123 Green Valley Road<br>
            Farmville, USA<br>
            <strong>Phone:</strong> +1 123 456 7890<br>
            <strong>Email:</strong> info@serenitysprings.com
          </p>
  
          <!-- Social Links -->
          <div class="social-links" style="margin-top: 30px;">
            <a href="#" class="twitter" style="color: #55acee; padding: 10px; font-size: 20px; margin: 0 10px; transition: 0.3s; text-decoration: none;">
              <i class="fa fa-twitter"></i>
            </a>
            <a href="#" class="facebook" style="color: #3b5998; padding: 10px; font-size: 20px; margin: 0 10px; transition: 0.3s; text-decoration: none;">
              <i class="fa fa-facebook"></i>
            </a>
            <a href="#" class="instagram" style="color: #e4405f; padding: 10px; font-size: 20px; margin: 0 10px; transition: 0.3s; text-decoration: none;">
              <i class="fa fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
  
      <!-- Footer Bottom Section -->
      <div class="row" style="margin-top: 40px; border-top: 1px solid #ccc; padding-top: 20px;">
        <div class="col-12" style="text-align: center; font-size: 14px; color: #ddd;">
          <div class="copyright">
            &copy; 2024 <strong>Serenity Springs</strong>. All Rights Reserved.
          </div>
          <div class="credits">
            Designed by <a href="https://bootstrapmade.com/" style="color: #4CAF50; font-weight: 600; text-decoration: none;">BootstrapMade</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  
  <!-- Add this to your CSS for smooth hover effects and animations -->
  <style>
    footer a:hover {
      transform: scale(1.1);
      color: #4CAF50;
    }
  
    .social-links a {
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.2);
      padding: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  
    .social-links a:hover {
      background-color: #4CAF50;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
  </style>
  
  
  
  <!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="https://code.responsivevoice.org/responsivevoice.js?key=EGYc5uHv"></script>


  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>

</html>
