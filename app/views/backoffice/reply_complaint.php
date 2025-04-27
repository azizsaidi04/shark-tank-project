<div class="flex h-screen">
    <!-- Sidebar -->
    <?php include(__DIR__ . '/../layout/sidebar.php'); ?>

    <!-- Content -->
    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-semibold mb-6">Répondre à la réclamation</h1>

        <!-- Show all errors if there are any -->
        <?php if (!empty($errors)) : ?>
            <div class="bg-red-200 text-red-800 p-2 mb-4">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <!-- Formulaire pour modifier ou ajouter une réponse -->
        <form method="POST" class="space-y-4">
            <div>
                <label class="text-[#2F1A4A]">Réponse</label>
                <textarea name="response_text" class="border p-2 w-full" rows="5" required><?= isset($reply) ? htmlspecialchars($reply['response_text']) : '' ?></textarea>
            </div>
            <button type="submit" class="btn-primary px-4 py-2 rounded"><?= isset($reply) ? 'Modifier' : 'Répondre' ?></button>
        </form>
    </main>
</div>
