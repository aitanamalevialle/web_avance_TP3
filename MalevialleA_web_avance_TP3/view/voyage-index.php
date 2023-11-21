{{ include('header.php', {title: 'Liste voyages'}) }}
<main>
    <h1>Voyages à venir</h1>
    <table>
            <tr>
                <th>Destination</th>
                <th>Date de départ</th>
                <th>Date de retour</th>
                <th>Prix (en $)</th>
                <th>Description</th>
                {% if guest == false %}
                    {% if session.privilege != 2 %}
                        <th>Supprimer</th>
                    {% endif %}
                {% endif %}
            </tr>
            {% for voyage in voyages %}
                <tr>
                <td>{% if guest == false %}
                        {% if session.privilege != 2 %}
                    <a href="{{ path }}voyage/show/{{ voyage.id }}">
                        {% endif %}
                    {% endif %} 
                    {{ voyage.destination }}</a></td>
                    <td>{{ voyage.date_depart }}</td>
                    <td>{{ voyage.date_retour }}</td>
                    <td>{{ voyage.prix }}</td>
                    <td>{{ voyage.description }}</td>
                    {% if guest == false %}
                        {% if session.privilege != 2 %}
                            <td>
                                <form action="{{ path }}voyage/destroy" method="post" class="delete-form">
                                    <input type="hidden" name="id" value="{{ voyage.id }}">
                                    <input type="submit" value="Supprimer" {% if session.privilege != 1 %} disabled {% endif %}>
                                </form>
                            </td>
                        {% endif %}
                    {% endif %}
                </tr>
            {% endfor %}
    </table>
    {% if session.privilege == 1 %}
    <a href="{{ path }}voyage/create">Ajouter</a>
    {% endif %}
</main>
</body>
</html>