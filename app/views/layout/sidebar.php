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

        .input-field {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
        }

        .btn-filter {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background-color: #ede9fe;
            color: #4c1d95;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-filter:hover {
            background-color: #c4b5fd;
            color: white;
        }

        .btn-filter.active {
            background-color: #7c3aed;
            color: white;
        }

        .closed-img-style {
            transform: rotate(-20deg);
            top: 5%;
            right: 0;
            width: 50%;
        }

        .waiting-img-style {
            transform: rotate(-30deg);
            top: 10%;
            right: 0;
            width: 50%;
        }


    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 text-2xl font-bold text-blue-600">Backoffice</div>
        <nav class="space-y-2 px-6">
            <a href="#" class="block text-gray-700 hover:text-blue-500">Gestion users</a>
            <a href="#" class="block text-gray-700 hover:text-blue-500">Gestion categories</a>
            <a href="#" class="block text-gray-700 hover:text-blue-500">Gestion offres</a>
            <a href="#" class="block text-gray-700 hover:text-blue-500">Gestion speechs</a>
            <a href="index.php?action=statistics" class="block text-gray-700 hover:text-blue-500">Statistiques</a>
            <a href="index.php?action=backoffice" class="block text-gray-700 hover:text-blue-500">Gestion Réclamations</a>
            <a href="index.php?action=index" class="block text-gray-700 hover:text-blue-500">Frontoffice</a>
        </nav>
    </aside>
</body>
