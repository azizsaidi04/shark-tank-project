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

        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            max-width: 600px;
            width: 100%;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(128, 90, 213, 0.2);
            background-color: #f5f3ff;
            border: 1px solid #d8b4fe;
        }

        .complaint-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6d28d9;
            margin-bottom: 0.5rem;
        }

        .complaint-content {
            color: #4c1d95;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .separator {
            border: none;
            border-top: 1px solid #ddd6fe;
            margin: 1.5rem 0;
        }

        .response {
            padding: 1rem;
            margin-top: 1rem;
            background-color: #ede9fe;
            border: 1px solid #c4b5fd;
            border-radius: 0.75rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .response:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(139, 92, 246, 0.3);
        }

        .response p {
            color: #4c1d95;
            line-height: 1.6;
        }

        .response .date {
            font-size: 0.75rem;
            color: #7c3aed;
            margin-top: 0.5rem;
            text-align: right;
            font-style: italic;
        }

        .no-reply {
            color:rgb(228, 39, 39);
            font-style: italic;
            text-align: center;
            margin-top: 1rem;
            font-weight: bold;
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
