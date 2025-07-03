<?php require_once APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
</head>
<body>
    <div class="container mt-4">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <h2>Ticket toevoegen</h2>
        <?php
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $csrf_token = $_SESSION['csrf_token'];
        ?>
        <form id="ticket-form" method="post" action="/overzichttickets/add" class="mx-auto my-5 p-4 bg-white rounded shadow fs-5" style="width: 60%; min-width: 320px;">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <div class="mb-3">
                <label for="voorstelling" class="form-label">Voorstelling</label>
                <select name="voorstelling" id="voorstelling" class="form-select" required>
                    <option value="" disabled selected>Kies een voorstelling</option>
                    <?php foreach ($data['voorstelling'] as $voorstelling) : ?>
                        <option value="<?= $voorstelling->Id ?>" <?= isset($data['ticket']->voorstelling) && $voorstelling->Id == $data['ticket']->voorstelling ? 'selected' : '' ?>><?= $voorstelling->Naam ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="bezoeker" class="form-label">Bezoeker</label>
                <select name="bezoeker" id="bezoeker" class="form-select" required>
                    <option value="" disabled selected>Kies een bezoeker</option>
                    <?php foreach ($data['bezoekers'] as $bezoeker) : ?>
                        <option value="<?= $bezoeker->Id ?>" <?= isset($data['ticket']->bezoeker) && $bezoeker->Id == $data['ticket']->bezoeker ? 'selected' : '' ?>><?= $bezoeker->Naam ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" required>
            </div>
            <div class="mb-3">
                <label for="prijs" class="form-label">Prijs</label>
                <input type="number" class="form-control" id="prijs" name="prijs" min="0" step="0.01" max="1000" value="0" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="bezet" required>
            </div>
            <button type="submit" class="btn btn-warning">Toevoegen</button>
        </form>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>
    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script src="../public/js/form.js"></script>
<?php require_once APPROOT . '/views/includes/under.php'; ?>
