{{ include('header.php', {title: 'Liste utilisateurs'}) }}
<body>
    <div class="container">
        <h1>Utilisateurs</h1>
        <table>
            <tr>
                <th>Identifiant</th>
                <th>Privilège</th>
            </tr>
            {% for user in users %}
                <tr>
                    <td>{{ user.username }}</a></td>
                    <td>{{ user.privilege }}</td>
                </tr>
            {% endfor %}
        </table>
        <br><br>
        <a href="{{path}}user/create" class="btn">Ajouter</a>
    </div>
</body>
</html>