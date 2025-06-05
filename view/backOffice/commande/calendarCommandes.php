<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
    <style>
        .fc-day-grid-event {
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
        }

        .fc-day-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .fc-toolbar-title {
            font-size: 1.5rem;
        }

        .header-btns {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Header with buttons -->
        <div class="header-btns">
            <a href="listCommandes.php" class="btn btn-primary">Retour à la liste des commandes</a>
            <a href="javascript:void(0)" id="downloadPDF" class="btn btn-danger">Télécharger en PDF</a>
        </div>

        <h2 class="mb-4 text-center">Calendrier des Commandes</h2>
        <div id="calendar"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
        $(document).ready(function () {
            // Récupérer les commandes via AJAX
            $.ajax({
                url: 'fetch_commandes.php',  // Charger les commandes depuis le fichier PHP
                dataType: 'json',
                success: function (data) {
                    var events = data.map(function (commande) {
                        return {
                            title: commande.details, // Titre de la commande
                            start: commande.dateCommande, // Date de la commande
                        };
                    });

                    // Initialisation du calendrier FullCalendar
                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        events: events,
                        eventRender: function (event, element) {
                            element.find('.fc-title').text(event.title); // Afficher seulement le titre
                        }
                    });
                },
                error: function () {
                    alert("Erreur lors du chargement des commandes.");
                }
            });

            // Télécharger le calendrier en PDF avec son design
            $('#downloadPDF').on('click', function () {
                const calendarElement = document.getElementById('calendar');
                
                // Options pour html2pdf.js
                const opt = {
                    filename: 'calendrier_commandes.pdf',
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
                };

                // Convertir le calendrier en PDF avec son design
                html2pdf().from(calendarElement).set(opt).save();
            });
        });
    </script>
</body>

</html>
