{{ include('header.php', {title: 'Détails facture'}) }}
<main>
    <div class="show-container">
        <h2>Facture</h2>
        <p><strong>Montant (en $) : </strong>{{ facture.montant }}</p>
        <p><strong>Date de facturation : </strong>{{ facture.date_facture }}</p>
        <p><strong>Voyage : </strong>{{ voyage }}</p>
        <p><strong>Client : </strong>{{ client }}</p>
        <a href="{{ path }}facture/edit/{{ facture.id }}">Modifier</a>
        <a href="{{ path }}generateur-pdf.php?id={{ facture.id }}">Télécharger la facture</a>
    </div>
</main>
</body>
</html>