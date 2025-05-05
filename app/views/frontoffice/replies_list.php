<!-- navbar -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

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
