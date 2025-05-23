<?php require_once APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="./public/css/overzicht.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="cont">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <main>
            <!-- 1 table = one week -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Voorstelling</th>
                            <th>Status</th>
                            <th>Datum</th>
                            <th>Acties</th>
                            <th> 
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                    data-bs-target="#scanModal"title="Scan">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['tickets'])): ?>
                            <?php foreach ($data['tickets'] as $ticket): ?>
                                <tr id="<?php echo htmlspecialchars($ticket->Id); ?>">
                                    <td><?php echo htmlspecialchars($ticket->VoorstellingNaam); ?></td>
                                    <td><?php echo htmlspecialchars($ticket->Status); ?></td>
                                    <td><?php echo htmlspecialchars($ticket->Datum); ?></td>
                                    <td>
                                        <a href="<?php echo URLROOT . '/tickets/edit/' . $ticket->Id; ?>"
                                            class="btn btn-warning btn-sm">Veranderen</a>
                                        <!-- Verwijder knop -->
                                        <a href="<?php echo URLROOT . '/tickets/delete/' . $ticket->Id; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Weet je zeker dat je dit ticket wilt verwijderen?');">
                                            Verwijder
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Geen tickets gevonden.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Scan Modal -->
            <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scanModalLabel">Scan invoeren</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Sluiten"></button>
                            </div>
                            <div class="modal-body">
                                <input name="scanned_ticket"  id='scanned_ticket' type="text" class="form-control" placeholder="Voer scan tekst in..." autofocus>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                                <button type="submit" class="btn btn-primary">Verzenden</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/4c0f1a2b8d.js" crossorigin="anonymous"></script>

    <?php require_once APPROOT . '/views/includes/under.php'; ?>