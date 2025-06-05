<?php
include(__DIR__ . '/../Model/eventModel.php');

include (__DIR__ . "/../vendor/autoload.php"); 
//../../../../../vendor/autoload.php; // Use autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class eventsController {
    // Fetch all events
    public function getEvents() {
        $sql = "SELECT * FROM events";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch(Exception $err) {
            echo $err->getMessage();
            return [];
        }
    }


public function addEvent($event) {
    $sql = "INSERT INTO events (Event_name, Event_description, Event_date, Event_location,Event_organizer) 
            VALUES (:Event_name, :Event_description, :Event_date, :Event_location,:Event_organizer)";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);

        // Convert the DateTime object to a string using format 'Y-m-d'
        $formattedDate = $event->getEvent_date() instanceof DateTime 
                         ? $event->getEvent_date()->format('Y-m-d') 
                         : $event->getEvent_date();

        $result = $query->execute([
            'Event_name' => $event->getEvent_name(),
            'Event_description' => $event->getEvent_description(),
            'Event_date' => $formattedDate, // Use formatted date string
            'Event_location' => $event->getEvent_location(),
            'Event_organizer' => $event->getEvent_organizer() 
        ]);

        if ($result) {
            echo "Event added successfully!";
        } else {
            echo "Failed to add event.";
        }
        return $result;
    } catch (PDOException $err) {
        echo "Error while adding event: " . $err->getMessage();
        return false;
    }
}

    // Delete an event by ID
    public function deleteEvent($Event_id) {
        $sql = "DELETE FROM events WHERE Event_id = :Event_id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':Event_id', $Event_id);
            $query->execute();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    // Fetch a single event by ID
    // Fetch an event by ID
    public function getEvent($Event_id) {
        $sql = "SELECT * FROM events WHERE Event_id = :Event_id"; // Use the correct column name
        $db = config::getConnexion();
        $query = $db->prepare($sql);
    
        try {
            $query->execute(['Event_id' => $Event_id]); // Bind the event ID
            return $query->fetch(PDO::FETCH_ASSOC); // Fetch and return the event
        } catch (Exception $e) {
            echo "Error fetching event: " . $e->getMessage();
        }
    }
    
   
    // Update an event
    public function updateEvent1($event) {
        // Assume $db is your database connection
        $db = config::getConnexion();
    
        // Prepare the SQL query to update the event
        $query = "UPDATE events SET 
                    Event_name = :name, 
                    Event_description = :description, 
                    Event_date = :date, 
                    Event_location = :location, 
                    Event_organizer = :organizer 
                  WHERE Event_id = :id";
        
            // Prepare the statement
            $stmt = $db->prepare($query);
    
            // Format the event date if it is a DateTime object
            $formattedDate = $event->getEvent_date() instanceof DateTime 
                             ? $event->getEvent_date()->format('Y-m-d H:i:s') 
                             : null;
    
            // Bind the values
            $stmt->bindParam(':name', $event->getEvent_name());
            $stmt->bindParam(':description', $event->getEvent_description());
            $stmt->bindParam(':date', $formattedDate);
            $stmt->bindParam(':location', $event->getEvent_location());
            $stmt->bindParam(':organizer', $event->getEvent_organizer());
            $stmt->bindParam(':id', $event->getEvent_id());
    
            // Execute the query
            $stmt->execute();
            
    }
    

        public function getEventsByOrganizer($organizerId) {
            $db = new PDO('mysql:host=localhost;dbname=serenity_springs', 'root', ''); // Adjust credentials
            $sql = "SELECT * FROM events WHERE Event_organizer = :Organizer_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':Organizer_id', $organizerId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }
        

        public function addParticipant($username, $email, $eventId) {
    $db = config::getConnexion();

    try {
        // Disable foreign key checks temporarily
        $db->exec("SET foreign_key_checks = 0");

        // Check if the participant is already registered for this event
        $checkSql = "SELECT * FROM event_participations WHERE email = :email AND event_id = :event_id";
        $checkQuery = $db->prepare($checkSql);
        $checkQuery->execute(['email' => $email, 'event_id' => $eventId]);

        if ($checkQuery->rowCount() > 0) {
            echo "You are already registered for this event.";
            return;
        }

        // Create a new Participant object and save it
        $participant = new Participant($username, $eventId, $email, $db);

        if ($participant->save()) {
            // Send confirmation email to the participant using PHPMailer
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                         // Set the SMTP server to use
                $mail->SMTPAuth   = true;                                     // Enable SMTP authentication
                $mail->Username   = 'mariemmolka50@gmail.com';                   // SMTP username
                $mail->Password   = 'nhou fxhj flpq apuv';                          // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           // Enable TLS encryption
                $mail->Port       = 587;                                      // TCP port to connect to (587 is typical for Gmail)

                //Recipients
                $mail->setFrom('molka.makri@epsrit.tn', 'Serenity Springs');
                $mail->addAddress($email, $username);                         // Add recipient

                // Content
                $mail->isHTML(true);                                          // Set email format to HTML
                $mail->Subject = 'Thank You for Participating in the Event';
                $mail->Body    = "Thank you for participating in the event. We will send you more details soon.";
                

                // Send the email
                $mail->send();
                echo '<div style="font-size: 24px; font-weight: bold; color: green; text-align: center;">';
                echo 'Thank you for your participation! A confirmation email has been sent.';
                echo '<div style="display: flex; justify-content: center; align-items: center; height: 10vh;">';
echo '<img src="http://www.coin-operated.com/wp-content/uploads/2010/05/mail.gif" alt="Mail GIF" style="max-width: 100%; height: auto;">';
echo '</div>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "There was an error processing your participation. Please try again.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Re-enable foreign key checks
        $db->exec("SET foreign_key_checks = 1");
    }
    
}
    



 
        
        
        
        

    }
     

class organizersController {
    // Fetch all organizers
    public function getorganizers() {
        $sql = "SELECT * FROM organizers";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    // Add a new organizer
    public function addorganizers($organizer) {
        $sql = "INSERT INTO organizers (Organizer_name, Organizer_email) 
                VALUES (:Organizer_name, :Organizer_email)";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'Organizer_name' => $organizer->getOrganizer_name(),
                'Organizer_email' => $organizer->getOrganizer_email()
            ]);
    
            if ($result) {
                echo "organizer added successfully!";
            } else {
                echo "Failed to add organizer.";
            }
        } catch (PDOException $err) {
            echo "Error while adding organizer: " . $err->getMessage();
            return false;
        }
    }
    public function deleteorganizer($Organizer_id) {
        $sql = "DELETE FROM organizers WHERE Organizer_id = :Organizer_id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':Organizer_id', $Organizer_id, PDO::PARAM_INT);
            $query->execute();
            echo "Organizer deleted successfully!";
        } catch (Exception $e) {
            echo "Error deleting organizer: " . $e->getMessage();
        }
    }

    // Fetch a single organizer by ID
    public function getorganizer($Organizer_id) {
        $sql = "SELECT * FROM organizers WHERE Organizer_id = :Organizer_id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);

        try {
            $query->execute(['Organizer_id' => $Organizer_id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error fetching organizer: " . $e->getMessage();
        }
    }

    // Update an organizer
    public function updatorganizer($organizer) {
        $sql = "UPDATE organizers SET 
                    Organizer_name = COALESCE(:Organizer_name, Organizer_name),
                    Organizer_email = COALESCE(:Organizer_email, Organizer_email)
                WHERE Organizer_id = :Organizer_id";
    
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'Organizer_name' => $organizer->getOrganizer_name(),
                'Organizer_email' => $organizer->getOrganizer_email(),
                'Organizer_id' => $organizer->getOrganizer_id()
            ]);
    
            if ($result) {
                return "Organizer updated successfully!";
            } else {
                return "No changes made to the organizer.";
            }
        } catch (Exception $e) {
            error_log("Error updating organizer: " . $e->getMessage());
            return "Error updating organizer.";
        }
    }
        public function updatorganizer1($updatedOrganizer) {
            // Assume $db is your database connection
            $db = config::getConnexion();
    
            // Prepare the SQL query to update the organizer
            $query = "UPDATE organizers SET Organizer_name = :name, Organizer_email = :email WHERE Organizer_id = :id";
            $stmt = $db->prepare($query);
    
            // Bind the values
            $stmt->bindParam(':name', $updatedOrganizer->getOrganizer_name());
            $stmt->bindParam(':email', $updatedOrganizer->getOrganizer_email());
            $stmt->bindParam(':id', $updatedOrganizer->getOrganizer_id());
    
            // Execute the query
            $stmt->execute();
        }
    
    
    
    

    // Fetch events by organizer ID
    public function afficheEventsByOrganizer($Organizer_id) {
        $sql = "SELECT * FROM organizers WHERE Organizer_id = :Organizer_id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);

        try {
            
            $query->execute(['Organizer_id' => $Organizer_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching events by organizer: " . $e->getMessage();
        }
    }

    // Fetch all organizers
    public function afficheOrganizers() {
        $sql = "SELECT * FROM organizers";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching organizers: " . $e->getMessage();
        }
    }
}
?>
