<?php
include '../../../Controller/eventController.php'; 

// Add an event
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
if (isset($_POST['event_name'], $_POST['event_description'], $_POST['event_date'], $_POST['event_location'], $_POST['event_id'], $_POST['Event_organizer'])) {
    if (!empty($_POST['event_name']) || !empty($_POST['event_description']) || !empty($_POST['event_date']) || !empty($_POST['event_location']) || !empty($_POST['Event_organizer'])) {

        // Ensure event_date is properly initialized as DateTime or null
        $eventDate = !empty($_POST['event_date']) ? new DateTime($_POST['event_date']) : null;

        // Create the updated event object
        $updatedEvent = new Event(
            $_POST['event_id'], // Event ID for updating
            $_POST['event_name'],
            $_POST['event_description'],
            $eventDate, // DateTime object or null
            $_POST['event_location'],
            $_POST['Event_organizer']
        );

        
        $eventController = new eventsController();
        $eventController->updateEvent1($updatedEvent);

        // Redirect to event page with success
        header('Location: event.php?success=1');
        exit; 
    } else {
        echo "Please fill in at least one field to update.";
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

// Fetch events for the frontend

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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

    // Check if an organizer filter is applied
    if (isset($_GET['organizer_id']) && !empty($_GET['organizer_id'])) {
        $organizerId = (int)$_GET['organizer_id'];
        $events = $eventsController->getEventsByOrganizer($organizerId); // Fetch events for selected organizer
    } else {
        $events = $eventsController->getEvents(); // Fetch all events
    }

    // Display events
    if ($events && $events->rowCount() > 0) {
        echo "<div class='row'>";

        while ($event = $events->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-md-4 mb-4'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($event['Event_name']) . "</h5>";
            echo "<p class='card-text'>" . htmlspecialchars($event['Event_description']) . "</p>";
            echo "<p class='card-text'><strong>Date: " . htmlspecialchars($event['Event_date']) . "</strong></p>";
            echo "<p class='card-text'><small class='text-muted'>Place: " . htmlspecialchars($event['Event_location']) . "</small></p>";
            echo "<p class='card-text'><small class='text-muted'>ID: " . htmlspecialchars($event['Event_id']) . "</small></p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<p>No events found.</p>";
    }
    ?>
</div>


<!-- Edit Event Form -->
<div class="container mt-5">
    <h2>Edit Event</h2>
    <form action="event.php" method="post">
        <div class="mb-3">
            <label for="eventId" class="form-label">Event ID</label>
            <input type="number" class="form-control" id="eventId" name="event_id" placeholder="Enter Event ID" >
        </div>
        <div class="mb-3">
            <label for="eventName" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="eventName" name="event_name" placeholder="Enter Event Name">
        </div>
        <div class="mb-3">
            <label for="eventDescription" class="form-label">Event Description</label>
            <textarea class="form-control" id="eventDescription" name="event_description" rows="3" placeholder="Enter Event Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="eventDate" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="eventDate" name="event_date" placeholder="Enter Event Date">
        </div>
        <div class="mb-3">
            <label for="eventLocation" class="form-label">Event Location</label>
            <input type="text" class="form-control" id="eventLocation" name="event_location" placeholder="Enter Event Place">
        </div>
        <div class="mb-3">
            <label for="eventOrganizer" class="form-label">Event Organizer</label>
            <input type="text" class="form-control" id="eventOrganizer" name="Event_organizer" placeholder="Enter Event Organizer">
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>

<div class="container mt-5">
    <h2>Delete Event</h2>
    <form action="event.php" method="post">
        <div class="mb-3">
            <label for="deleteEventId" class="form-label">Event ID</label>
            <input type="number" class="form-control" id="deleteEventId" name="delete_event_id" placeholder="Enter Event ID" required>
        </div>
        <button type="submit" class="btn btn-danger">Delete Event</button>
    </form>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="form.js"></script>
</body>
</html>

