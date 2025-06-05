<?php
include '../../../Controller/eventController.php'; 
if (isset($_POST['organizer_name'], $_POST['organizer_email'])) {
    if (!empty($_POST['organizer_name']) && !empty($_POST['organizer_email'])) {
        try {
            // Create the organizer object
            $addorganizer = new Organizer(
                null, // Organizer ID for adding
                $_POST['organizer_name'],
                $_POST['organizer_email']
            );

            // Call the controller to add the organizer
            $organizersController = new organizersController();
            $organizersController->addorganizers($addorganizer);

            // Redirect to organizer page with success
            header('Location: organizer.php?success=1');
            exit; // Make sure to call exit after header redirection
            
        } catch (Exception $e) {
            echo "Error while adding organizer: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// Update an organizer
if (isset($_POST['organizer_name'], $_POST['organizer_email'], $_POST['organizer_id'])) {
    if (!empty($_POST['organizer_name']) || !empty($_POST['organizer_email'])) {

        // Create the updated organizer object
        $updatedOrganizer = new Organizer(
            $_POST['organizer_id'], // Organizer ID for updating
            $_POST['organizer_name'],
            $_POST['organizer_email']
        );

        // Call the controller to update the organizer
        $organizerController = new organizersController();
        $organizerController->updateAndReplaceOrganizer($updatedOrganizer);

        // Redirect to organizer page with success
        header('Location: organizer.php?success=1');
        exit; // Ensure no code runs after the redirection
    } else {
        echo "Please fill in at least one field to update.";
    }
}



// Delete an organizer
if (isset($_POST['delete_organizer_id'])) {
    $deleteOrganizerId = (int)$_POST['delete_organizer_id'];

    if ($deleteOrganizerId > 0) {
        try {
            $organizersController = new organizersController();
            $organizersController->deleteOrganizer($deleteOrganizerId);

            // Redirect to organizer page after deletion
            header('Location: organizer.php');
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid organizer ID.";
    }
}
if (!class_exists('organizersController')) {
    echo 'organizersController class not loaded. Check the file path or class name.';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-start;
        }
        .card {
            width: 300px;
            border: 1px solid #ddd;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
        .card-body {
            position: relative;
        }
        .btn-delete {
            position: absolute;
            bottom: 10px;
            left: 10px;
            width: 90px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add Organizer</h2>
    <form id="addOrganizerForm" action="organizer.php" method="post">
        <div class="mb-3">
            <label for="organizerName" class="form-label">Organizer Name</label>
            <input type="text" class="form-control" id="organizerName" name="organizer_name" required>
        </div>
        <div class="mb-3">
            <label for="organizerEmail" class="form-label">Organizer Email</label>
            <input type="email" class="form-control" id="organizerEmail" name="organizer_email" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Organizer</button>
    </form>
</div>

<div class="container mt-5">
    <h2>Organizer List</h2>
    <?php
    $organizersController = new organizersController();
    $organizers = $organizersController->afficheOrganizers(); // Get the array of organizers

    if (!empty($organizers)) { // Check if the array is not empty
        //echo "<div class='row'>";
        echo "<div class='card-container'>";

        foreach ($organizers as $organizer) { // Loop through each organizer
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($organizer['Organizer_name']) . "</h5>";
            echo "<p class='card-text'>" . htmlspecialchars($organizer['Organizer_email']) . "</p>";
            echo "<p class='card-text'><small class='text-muted'>ID: " . htmlspecialchars($organizer['Organizer_id']) . "</small></p>";
            echo "<form action='organizer.php' method='post' onsubmit=\"return confirm('Are you sure you want to delete this organizer?');\">";
            echo "<input type='hidden' name='delete_organizer_id' value='" . htmlspecialchars($organizer['Organizer_id']) . "'>";
            echo "<button type='submit' class='btn btn-danger btn-delete'>Delete</button>";
            echo "</form>";
            echo "</div>"; // Close card-body
            echo "</div>"; // Close card
        }

        echo "</div>";
    } else {
        echo "<p>No organizers found.</p>";
    }
    ?>
</div>

<div class="container mt-5">
    <h2>Edit Organizer</h2>
    <form action="organizer.php" method="post">
        <div class="mb-3">
            <label for="organizerId" class="form-label">Organizer ID</label>
            <input type="number" class="form-control" id="organizerId" name="organizer_id" placeholder="Enter Organizer ID" required>
        </div>
        <div class="mb-3">
            <label for="organizerName" class="form-label">Organizer Name</label>
            <input type="text" class="form-control" id="organizerName" name="organizer_name" placeholder="Enter Organizer Name">
        </div>
        <div class="mb-3">
            <label for="organizerEmail" class="form-label">Organizer Email</label>
            <input type="email" class="form-control" id="organizerEmail" name="organizer_email" placeholder="Enter Organizer Email">
        </div>
        <button type="submit" class="btn btn-primary">Update Organizer</button>
    </form>
</div>



<!-- Include Bootstrap JS -->
<script src="organizerform.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
