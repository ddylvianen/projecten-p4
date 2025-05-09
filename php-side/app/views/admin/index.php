<?php require_once APPROOT . '/views/includes/header.php'; ?>

<link rel="stylesheet" href="../public/css/home.css">
<link rel="stylesheet" href="../public/css/admin.css">
</head>

<body>
    <div class="cont">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <main>
            <div class="container-chart">
                <?php if (!empty($data['aantallessen'])): ?>
                <canvas id="myChart"></canvas>
                <?php else: ?>
                <div class="no-data">
                    <h2>Geen gegevens beschikbaar</h2>
                    <p>Er zijn momenteel geen reserveringen om weer te geven.</p>
                </div>
                <?php endif; ?>

            </div>
        </main>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        'use strict';

        $(document).ready(function () {
            const ctx = $('#myChart');

            const labels = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
            const data = <?= json_encode($data['aantallessen']) ?>;

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'reserveringen per maand',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Adjust canvas container height for responsiveness
            $(window).on('resize', function () {
                const containerWidth = $('.cont').width();
                $('#myChart').height(containerWidth * 0.5); // Adjust height based on width
            }).trigger('resize');
        });
    </script>

    </script>
    <?php require_once APPROOT . '/views/includes/under.php'; ?>