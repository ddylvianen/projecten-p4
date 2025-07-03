<?php require_once APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

</head>

<body>
    <div class="container mt-4">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <h2>Ticket bewerken</h2>
        <?php
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $csrf_token = $_SESSION['csrf_token'];
        ?>
        <form id="ticket-form" method="post" action="/overzichttickets/update" class="mx-auto my-5 p-4 bg-white rounded shadow fs-5" style="width: 60%; min-width: 320px;">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['ticket']->Id ?? '') ?>">
            <div class="mb-3">
                <label for="voorstelling" class="form-label fw-semibold">Voorstelling</label>
                <select name="voorstelling" id="voorstelling" class="form-select" required>
                    <option value="" disabled selected>Kies een voorstelling</option>
                    <?php foreach ($data['voorstelling'] as $voorstelling) : ?>
                        <option value="<?= $voorstelling->Id ?>" <?= $voorstelling->Id == ($data['ticket']->VoorstellingId ?? '') ? 'selected' : '' ?>><?= $voorstelling->Naam ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="bezoeker" class="form-label fw-semibold">Bezoeker</label>
                <select name="bezoeker" id="bezoeker" class="form-select" required>
                    <option value="" disabled selected>Kies een bezoeker</option>
                    <?php foreach ($data['bezoekers'] as $bezoeker) : ?>
                        <option value="<?= $bezoeker->Id ?>" <?= $bezoeker->Id == ($data['ticket']->BezoekerId ?? '') ? 'selected' : '' ?>><?= $bezoeker->Naam ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label fw-semibold">Barcode</label>
                <input type="text" class="form-control form-control-lg" id="barcode" name="barcode" value="<?= htmlspecialchars($data['ticket']->Barcode ?? $data['ticket']->Barcode ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prijs" class="form-label fw-semibold">Prijs</label>
                <input type="number" class="form-control form-control-lg" id="prijs" name="prijs" value="<?= htmlspecialchars($data['ticket']->Tarief ?? $data['ticket']->Tarief ?? '0'); ?>" min="0" step="0.01" max="1000" required>
            </div>
            <input type="hidden" name="prijsId" id="prijsId" value="<?= htmlspecialchars($data['ticket']->PrijsId ?? $data['ticket']->PrijsId ?? ''); ?>">
            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">Status</label>
                <input type="text" class="form-control form-control-lg" id="status" name="status" value="<?= htmlspecialchars($data['ticket']->Status ?? $data['ticket']->Status ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning btn-lg w-100">Opslaan</button>
        </form>
        <!-- Bootstrap 5 CDN End -->
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>
    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        $(function() {
            var bezoekerSelect = $('#bezoeker');
            if (bezoekerSelect.length) {
                new Choices(bezoekerSelect[0], {
                    searchEnabled: true,
                    itemSelectText: '',
                    shouldSort: false
                });
            }
        });
    </script>
    <?php require_once APPROOT . '/views/includes/under.php'; ?>