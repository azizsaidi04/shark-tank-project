<!-- navbar -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

<h2 class="text-2xl mb-6 text-gray-100">Modifier une réclamation</h2>

<?php if (!empty($error)) : ?>
    <div class="bg-red-200 text-red-800 p-2 mb-4"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="space-y-4">
    <div>
        <label class="text-gray-100">Titre</label>
        <input type="text" name="title" class="border p-2 w-full" value="<?= htmlspecialchars($complaint['title']) ?>" required>
    </div>
    <div>
        <label class="text-gray-100">Description</label>
        <textarea name="description" class="border p-2 w-full" rows="5" required><?= htmlspecialchars($complaint['description']) ?></textarea>
    </div>
    <button type="submit" class="btn-primary px-4 py-2 rounded">Modifier</button>
</form>
