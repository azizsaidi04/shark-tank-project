<div class="flex h-screen">
    <!-- Sidebar -->
    <?php include(__DIR__ . '/../layout/sidebar.php'); ?>

    <!-- Content -->
    <main class="flex-1 p-8 overflow-auto">

    <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <input type="hidden" name="action" value="backoffice">

        <input type="text" name="title" class="px-2" placeholder="Filtrer par titre" value="<?= htmlspecialchars($filters['title'] ?? '') ?>" class="input">
        
        <select name="status" class="input">
            <option value="">Tous les statuts</option>
            <option value="open" <?= ($filters['status'] ?? '') === 'open' ? 'selected' : '' ?>>Ouvert</option>
            <option value="closed" <?= ($filters['status'] ?? '') === 'closed' ? 'selected' : '' ?>>Fermé</option>
        </select>

        <select name="date_filter" class="input">
            <option value="">Toutes les dates</option>
            <option value="today" <?= ($filters['date_filter'] ?? '') === 'today' ? 'selected' : '' ?>>Aujourd’hui</option>
            <option value="last_week" <?= ($filters['date_filter'] ?? '') === 'last_week' ? 'selected' : '' ?>>Semaine dernière</option>
            <option value="last_month" <?= ($filters['date_filter'] ?? '') === 'last_month' ? 'selected' : '' ?>>Mois dernier</option>
        </select>

        <select name="sort_order" class="input">
            <option value="desc" <?= ($filters['sort_order'] ?? '') === 'desc' ? 'selected' : '' ?>>Date décroissante</option>
            <option value="asc" <?= ($filters['sort_order'] ?? '') === 'asc' ? 'selected' : '' ?>>Date croissante</option>
        </select>

        <!-- Boutons Appliquer et Réinitialiser -->
        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary p-3">Appliquer les filtres</button>
            <a href="index.php?action=backoffice" class="btn btn-secondary p-3 bg-gray-200 border border-gray-400">Réinitialiser</a>
        </div>
    </form>




        <h1 class="text-3xl font-semibold mb-6">Dashboard Dealhub</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($complaints as $complaint): ?>
                <div class="card p-6 rounded shadow w-full relative">
                    <h2 class="text-xl font-bold mb-2 text-[#2F1A4A]"><?= htmlspecialchars($complaint['title']) ?></h2>
                    <p class="mb-2 text-[#847C84]"><?= nl2br(htmlspecialchars($complaint['description'])) ?></p>
                    <p class="text-sm text-[#A093AF]">Topic: <b> <?= htmlspecialchars($complaint['topic']) ?> </b> </p>
                    <?php if($complaint['status'] == 'Closed') : ?>
                        <img src="closed.png" alt="closed complaint" class="absolute closed-img-style">
                    <?php else : ?>
                        <img src="waiting.png" alt="waiting complaint" class="absolute waiting-img-style">
                    <?php endif; ?>

                    <p class="text-sm text-[#A093AF]"><?= htmlspecialchars($complaint['created_at']) ?></p>
                    <!-- Affichage des réponses -->
                    <?php 
                        $responses = $this->complaintModel->getResponsesByComplaintId($complaint['id']);
                        foreach ($responses as $response):
                    ?>
                        <div class="response p-2 mt-4 bg-gray-100 rounded">
                            <p><?= nl2br(htmlspecialchars($response['response_text'])) ?></p>
                            <p class="text-sm text-gray-500"><?= $response['created_at'] ?></p>

                            <!-- Buttons for modify and delete reply -->
                            <div class="flex justify-between items-center mt-2">
                                <a href="index.php?action=modify_reply&id=<?= $response['id'] ?>" class="btn-primary px-3 py-1 rounded">Modifier</a>
                                <a href="index.php?action=delete_reply&id=<?= $response['id'] ?>" class="btn-danger px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?')">Supprimer</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <!-- Bouton Répondre -->
                    <a href="index.php?action=reply&id=<?= $complaint['id'] ?>" class="btn-primary px-3 py-1 rounded">Répondre</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>
