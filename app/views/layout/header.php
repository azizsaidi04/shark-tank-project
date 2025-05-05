<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Réclamations</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F5F2F6;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #2F1A4A;
            color: #F5F2F6;
        }
        .navbar a {
            color: #F5F2F6;
            margin: 0 10px;
            transition: color 0.3s;
        }
        .navbar a:hover {
            color: #A093AF;
        }
        .btn-primary {
            background-color: #846CA0;
            color: #F5F2F6;
        }
        .btn-primary:hover {
            background-color: #A093AF;
        }
        .btn-danger {
            background-color: #847C84;
            color: #F5F2F6;
        }
        .btn-danger:hover {
            background-color: #A093AF;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #847C84;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        #background-video {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="video-background">
    <video autoplay muted loop id="background-video">
        <source src="bgvid.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<nav class="navbar p-4 flex justify-between items-center">
    <div class="text-xl font-bold">Complaint Management</div>
    <div>
        <a href="index.php?action=backoffice">Backoffice</a>
        <a href="index.php?action=index">Mes Réclamations</a>
        <a href="index.php?action=add">Ajouter</a>
    </div>
</nav>
<div class="p-8">
