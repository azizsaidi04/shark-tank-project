<!-- navbar -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

<h2 class="text-2xl mb-6 text-gray-100">Ajouter une réclamation</h2>

<?php if (!empty($error)) : ?>
    <div class="bg-red-200 text-red-800 p-2 mb-4"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="space-y-4">
    <div>
        <label class="text-gray-100">Titre</label>
        <input type="text" name="title" id="title" class="border p-2 w-full" required value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
        <div id="titleError" class="text-red-600 mt-2 hidden">Le titre ne doit pas dépasser 7 mots.</div>
    </div>
    <div>
        <label class="text-gray-100">Description</label>
        <textarea name="description" class="border p-2 w-full" rows="5" required><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
    </div>
    <button type="submit" class="btn-primary px-4 py-2 rounded">Ajouter</button>
</form>

<script>
    document.getElementById('complaintForm').addEventListener('submit', function(event) {
        // Get the title value
        var title = document.getElementById('title').value.trim();
        
        // Split the title into words and count them
        var titleWords = title.split(/\s+/); // Split by any whitespace
        
        // Check if the title has more than 7 words
        if (titleWords.length > 7) {
            // Display error message
            document.getElementById('titleError').classList.remove('hidden');
            event.preventDefault(); // Prevent form submission if the title is too long
        } else {
            // Hide the error message (if it exists) and proceed with form submission
            document.getElementById('titleError').classList.add('hidden');
        }
    });
</script>
