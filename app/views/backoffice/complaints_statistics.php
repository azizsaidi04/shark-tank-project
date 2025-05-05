<div class="flex h-screen">
    <!-- Sidebar -->
    <?php include(__DIR__ . '/../layout/sidebar.php'); ?>


    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Statistiques des Réclamations</h2>
        <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2 text-purple-500">Waiting</th>
                <th class="border px-4 py-2 text-red-500">Closed</th>
            </tr>
        </thead>

            <tbody>
                <?php foreach ($stats as $row): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['date']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['complaints_per_day']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['open_complaints']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['closed_complaints']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="my-8">
                <h2 class="text-xl font-bold mb-2">Répartition des sujets (Pie Chart)</h2>
                <canvas id="topicChart" class="w-full max-w-xl h-64"></canvas>
            </div>

            <div class="my-8">
                <h2 class="text-xl font-bold mb-2">Nombre de réclamations par jour (Bar Chart)</h2>
                <canvas id="barChart" class="w-full max-w-xl h-64"></canvas>
            </div>

            <div class="my-8">
                <h2 class="text-xl font-bold mb-2">Évolution quotidienne (Line Chart)</h2>
                <canvas id="lineChart" class="w-full max-w-xl h-64"></canvas>
            </div>
        </div>
        


        
    </div>
</div>

<script>
    const topicLabels = <?= json_encode(array_column($statsByTopic ?? [], 'topic')) ?>;
    const topicData = <?= json_encode(array_column($statsByTopic ?? [], 'count')) ?>;

    const dateLabels = <?= json_encode(array_column($statsByDate ?? [], 'date')) ?>;
    const dateData = <?= json_encode(array_column($statsByDate ?? [], 'count')) ?>;

    const backgroundColors = topicLabels.map(label => label === 'Undefined' ? '#000000' : getRandomColor());

    function getRandomColor() {
        const colors = ['#f87171', '#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f472b6', '#38bdf8'];
        return colors[Math.floor(Math.random() * colors.length)];
    }


    new Chart(document.getElementById('topicChart'), {
        type: 'pie',
        data: {
            labels: topicLabels,
            datasets: [{
                label: 'Réclamations par sujet',
                data: topicData,
                backgroundColor: backgroundColors
            }]
        }
    });


    // Bar chart (complaints per day)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: dateLabels,
            datasets: [{
                label: 'Réclamations par jour',
                data: dateData,
                backgroundColor: '#60a5fa',
                borderColor: '#3b82f6',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Line chart (daily evolution)
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: dateLabels,
            datasets: [{
                label: 'Réclamations dans le temps',
                data: dateData,
                borderColor: '#34d399',
                backgroundColor: 'rgba(52, 211, 153, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
