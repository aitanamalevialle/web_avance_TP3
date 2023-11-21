<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{path}}css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{path}}">Accueil</a></li>
                <li><a href="{{path}}voyage">Voyages</a></li>
                {% if guest %}
                <li><a href="{{path}}login">Connexion</a></li>
                {% else %}
                <li><a href="{{path}}facture">Factures</a></li>
                    {% if session.privilege == 1 %}
                    <li><a href="{{path}}user">Utilisateurs</a></li>
                    <li><a href="{{path}}log">Journal</a></li>
                    {% endif %}
                <li><a href="{{path}}login/logout">Déconnexion</a></li>
                {% endif %}
                {{ session.username }}
            </ul>
        </nav>
        <img src="{{path}}img/banniere.png" alt="agence voyages">
    </header>