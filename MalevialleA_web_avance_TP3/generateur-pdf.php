<?php

require_once 'vendor/autoload.php';
require_once('library/RequirePage.php');
RequirePage::model('CRUD');
RequirePage::model('Facture');
RequirePage::model('Voyage');
RequirePage::model('Client');

use Dompdf\Dompdf;
use Dompdf\Options;

// Récupérer l'identifiant de la facture depuis la requête.
$factureId = $_GET['id'] ?? null;

if ($factureId) {

    $facture = new Facture;
    $voyage = new Voyage;
    $client = new Client;

    $factureData = $facture->selectId($factureId);
    $voyageData = $voyage->selectId($factureData['voyage_id']);
    $clientData = $client->selectId($factureData['client_id']);

    // Créer une chaîne de caractères HTML avec les données.
    $html = '
        <html>
            <body>
                <h1>Facture client</h1>
                <p>Montant (en $) : ' . $factureData['montant'] . '</p>
                <p>Date de facturation : ' . $factureData['date_facture'] . '</p>
                <p>Voyage : ' . $voyageData['destination'] . '</p>
                <p>Client : ' . $clientData['nom'] . '</p>
            </body>
        </html>
    ';

    // Utiliser Dompdf pour générer le PDF.
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Effacer tout tampon de sortie avant la redirection.
    ob_clean();

    // Sauvegarder le PDF dans un fichier.
    $output = $dompdf->output();
    file_put_contents('facture.pdf', $output);

    // Rediriger vers le fichier PDF généré
    header('Location: facture.pdf');
    exit;
} else {
    // Gérer le cas où l'identifiant de la facture n'est pas fourni
    echo 'Identifiant de facture manquant.';
}

?>