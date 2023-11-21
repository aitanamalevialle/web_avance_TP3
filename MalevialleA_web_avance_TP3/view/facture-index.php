{{ include('header.php', {title: 'Liste factures'}) }}
<main>
    <h1>Factures</h1>
    <table>
        <tr>
            <th>Montant (en $)</th>
            <th>Date de facturation</th>
            <th>Voyage</th>
            <th>Client</th>
            {% if session.privilege == 1 %}
                <th>Supprimer</th>
            {% endif %}
        </tr>
        {% for facture in factures %}
            <tr>
                <td>
                    {% if session.privilege != 2 %}
                        <a href="{{path}}facture/show/{{ facture.id }}">{{ facture.montant }}</a>
                    {% else %}
                        {{ facture.montant }}
                    {% endif %}
                </td>
                <td>{{ facture.date_facture }}</td>
                <td>{{ facture.voyage.destination }}</td>
                <td>{{ facture.client.nom }}</td>
                {% if session.privilege == 1 %}
                    <td>
                        <form action="{{ path }}facture/destroy" method="post" class="delete-form">
                            <input type="hidden" name="id" value="{{ facture.id }}">
                            <input type="submit" value="Supprimer" {% if session.privilege != 1 %} disabled {% endif %}>
                        </form>
                    </td>
                {% endif %}
            </tr>
        {% endfor %}
    </table>
    {% if session.privilege == 1 %}
        <a href="{{path}}facture/create">Ajouter</a>
    {% endif %}
</main>
</body>
</html>