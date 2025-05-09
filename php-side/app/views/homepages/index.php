<?php require_once APPROOT . '/views/includes/header.php'; ?>

<link rel="stylesheet" href="../public/css/home.css">
</head>
<body>
    <div class="cont">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <main>
            <header style="background-image: url('../public/img/waarom1.png');">
                <div>
                    <h1>FitForFun</h1>
                    <p>Welkom bij FitForFun, de plek waar je jezelf kunt zijn en kunt werken aan je gezondheid.</p>
                    <button class="btn">Meld je nu aan!</button>
                </div>
            </header>
            <section class="intro">
                <div>
                    <h2>Waarom FitForFun?</h2>
                    <p>
                        FitForFun is de plek waar je jezelf kunt zijn en kunt werken aan je gezondheid.
                        Wij bieden een breed scala aan sporten en activiteiten aan, zodat er voor iedereen wat wils is.
                        Of je nu
                        wilt afvallen,
                        spiermassa wilt opbouwen of gewoon lekker wilt bewegen, bij FitForFun ben je aan het juiste
                        adres.
                    </p>
                </div>
                <img src="../public/img/calltoaction.png" alt="">
            </section>
            <section class="sporten">
                <h2>Onze sporten</h2>
                <div class="wraper">
                    <div>
                        <img src="../public/img/cardiospinning.png" alt="">
                        <h3>Cardio</h3>
                        <p>
                            Cardio is een van de meest effectieve manieren om af te vallen en je conditie te verbeteren.
                            Bij FitForFun kun je terecht voor verschillende vormen van cardio, zoals hardlopen, fietsen
                            en
                            roeien.
                        </p>
                    </div>
                    <div>
                        <img src="../public/img/kracht.png" alt="">
                        <h3>Krachttraining</h3>
                        <p>
                            Krachttraining is een goede manier om spiermassa op te bouwen en je lichaam sterker te
                            maken.
                            Bij FitForFun kun je terecht voor verschillende vormen van krachttraining, zoals
                            gewichtheffen en
                            bodypump.
                        </p>
                    </div>
                    <div>
                        <img src="../public/img/yoga.png" alt="">
                        <h3>Yoga</h3>
                        <p>
                            Yoga is een goede manier om te ontspannen en je lichaam soepel te houden.
                            Bij FitForFun kun je terecht voor verschillende vormen van yoga, zoals hatha yoga en power
                            yoga.
                        </p>
                    </div>
                    <div>
                        <img src="../public/img/zwemmen.png" alt="">
                        <h3>Zwemmen</h3>
                        <p>
                            Zwemmen is een goede manier om je conditie te verbeteren en je spieren te versterken.
                            Bij FitForFun kun je terecht voor verschillende vormen van zwemmen, zoals baantjes trekken
                            en
                            aquarobics.
                        </p>
                    </div>
                </div>
            </section>
            <section>
                <?php require_once APPROOT . '/views/includes/pricing.php'; ?>
            </section>
        </main>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>

    
    <?php require_once APPROOT . '/views/includes/under.php'; ?>