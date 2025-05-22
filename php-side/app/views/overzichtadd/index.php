<?php require_once APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="../public/css/forms.css">
</head>

<body>
    <div class="container">
        <form action="" method="post" class="addless" id="addles-form">
            <h1 class="addless-head"><?php echo (isset($data['les']) ? 'les updaten':'les bijvoegen')?></h1>
            <input type="hidden" name="id" value="<?php echo $data['les']->Id ?? '' ?>">
            <div class="form-group">
                <label for="naam">Naam</label>
                <input required type="text" class="form-control" id="naam" name="naam" value="<?php echo $data['les']->Naam ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="datum">Datum</label>
                <input required type="date" class="form-control" id="datum" name="datum" value="<?php echo $data['les']->Datum ?? '' ?>" min="<?php echo date('Y-m-d') ?>">
            </div>
            <div class="form-group">
                <label for="tijd">Tijd</label>
                <input required type="time" class="form-control" id="tijd" name="tijd" value="<?php echo $data['les']->Tijd ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="minAantalPersonen">MinAantalPersonen</label>
                <input required type="number" class="form-control" id="minAantalPersonen" name="minAantalPersonen" value="<?php echo $data['les']->MinAantalPersonen ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="maxAantalPersonen">MaxAantalPersonen</label>
                <input required type="number" class="form-control" id="maxAantalPersonen" name="maxAantalPersonen" value="<?php echo $data['les']->MaxAantalPersonen ?? '' ?>">

            </div>

            <div class="form-group">
                <label for="beschikbaarheid">Beschikbaarheid</label>
                <input type="text" class="form-control" id="beschikbaarheid" name="beschikbaarheid" value="<?php echo $data['les']->Beschikbaarheid ?? '' ?>">
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>

    </div>


<script src="../public/js/form.js"></script>
<?php require_once APPROOT . '/views/includes/under.php'; ?>