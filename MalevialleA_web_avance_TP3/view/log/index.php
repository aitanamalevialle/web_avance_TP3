{{ include('header.php', {title: 'Liste journal'}) }}
<body>
    <div class="container">
        <h1>Journal de bord</h1>
        <table>
            <tr>
                <th>Adresse IP</th>
                <th>Date de consultation</th>
                <th>Nom utilisateur</th>
                <th>Page visitée</th>
            </tr>
            {% for log in logs %}
                <tr>
                    <td>{{ log.adresse_IP }}</a></td>
                    <td>{{ log.date_consultation }}</td>
                    <td>{{ log.nom_utilisateur }}</a></td>
                    <td>{{ log.page_visitee }}</td>
                </tr>
            {% endfor %}
        </table>
    </div>
</body>
</html>