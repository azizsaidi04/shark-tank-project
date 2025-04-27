<!-- navbar -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach($complaints as $complaint): ?>
        <div class="card p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-2 text-[#2F1A4A]"><?= htmlspecialchars($complaint['title']) ?></h2>
            <p class="mb-2 text-[#847C84]"><?= nl2br(htmlspecialchars($complaint['description'])) ?></p>
            <div class="flex justify-between items-center mt-4">
                <a href="index.php?action=edit&id=<?= $complaint['id'] ?>" class="btn-primary px-3 py-1 rounded">Modifier</a>
                <a href="index.php?action=delete&id=<?= $complaint['id'] ?>" class="btn-danger px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>