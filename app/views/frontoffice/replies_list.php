<head>
    <style>
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #faf5ff;
            padding: 2rem;
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
<div class="container-center">
    <div class="card">
        
        <!-- Titre de la réclamation -->
        <h2 class="complaint-title"><?= htmlspecialchars($complaint['title']) ?></h2>
        
        <!-- Contenu de la réclamation -->
        <p class="complaint-content"><?= nl2br(htmlspecialchars($complaint['description'])) ?></p>

        <hr class="separator" />

        <!-- Affichage des réponses -->
        <?php if (empty($replies)): ?>
            <p class="no-reply">Il n'y a pas de réponses encore.</p>
        <?php else: ?>
            <?php foreach ($replies as $response): ?>
                <div class="response">
                    <p><?= nl2br(htmlspecialchars($response['response_text'])) ?></p>
                    <p class="date"><?= $response['created_at'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

</body>