<div class="flex h-screen">
    <!-- Sidebar -->
    <?php include(__DIR__ . '/../layout/sidebar.php'); ?>

    <!-- Content -->
    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-semibold mb-6">Dashboard Dealhub</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($complaints as $complaint): ?>
                <div class="card p-6 rounded shadow w-full">
                    <h2 class="text-xl font-bold mb-2 text-[#2F1A4A]"><?= htmlspecialchars($complaint['title']) ?></h2>
                    <p class="mb-2 text-[#847C84]"><?= nl2br(htmlspecialchars($complaint['description'])) ?></p>
                    <p class="text-sm text-[#A093AF]">Status: <?= htmlspecialchars($complaint['status']) ?></p>
                    
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
