<?php require_once APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="../public/css/home.css">
</head>
<body>
    <div class="cont">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <main>
            <header style="background-image: url('../public/img/waarom3.jpg');">
                <div>
                    <h1>Theater Podium</h1>
                    <p>Ontdek de magie van het theater. Laat je meevoeren door verhalen die raken, verbazen en inspireren.</p>
                    <button class="btn">Bekijk programma</button>
                </div>
            </header>

            <!-- Uitgelichte voorstelling -->
            <section class="featured-production">
                <h2>Nu te zien</h2>
                <div class="production-highlight">
                    <div class="production-image">
                        <img src="../public/img/verborgen licht.jpg" alt="Uitgelichte voorstelling">
                        <div class="date-badge">
                            <span class="month">APR</span>
                            <span class="day">15</span>
                        </div>
                    </div>
                    <div class="production-info">
                        <h3>Het Verborgen Licht</h3>
                        <p class="production-meta">Regie: Maria van Dongen | Duur: 120 min</p>
                        <p class="production-description">
                            Een indringend verhaal over familie, verlies en de kracht van vergeving. 
                            Deze bekroonde productie neemt je mee naar het naoorlogse Nederland 
                            waar drie zussen worstelen met hun verleden.
                        </p>
                        <div class="production-actions">
                            <button class="btn">Tickets</button>
                            <a href="#" class="read-more">Meer informatie</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Programma sectie -->
            <section class="sporten">
                <h2>Programma</h2>
                <div class="wraper">
                    <div>
                        <img src="../public/img/King_Lear_by_George_Frederick_Bensell.jpg" alt="Toneelvoorstelling">
                        <div class="date-badge small">
                            <span>APR</span>
                            <span>20</span>
                        </div>
                        <h3>Koning Lear</h3>
                        <p>
                            Shakespeare's tijdloze tragedie in een moderne vertaling. Een koning verdeelt zijn rijk 
                            onder zijn drie dochters, met desastreuze gevolgen.
                        </p>
                    </div>
                    <div>
                        <img src="../public/img/fantasy-2368432_640.jpg" alt="Dansvoorstelling">
                        <div class="date-badge small">
                            <span>MEI</span>
                            <span>3</span>
                        </div>
                        <h3>Hemels Bewegen</h3>
                        <p>
                            Een moderne dansvoorstelling die de grens tussen dans en theater doet vervagen.
                            Door dansgezelschap Corpus.
                        </p>
                    </div>
                    <div>
                        <img src="../public/img/Nocturnes.jpg" alt="Muziekvoorstelling">
                        <div class="date-badge small">
                            <span>MEI</span>
                            <span>12</span>
                        </div>
                        <h3>Nocturnes</h3>
                        <p>
                            Een muzikale reis door de nacht, met werken van Chopin, Debussy en 
                            hedendaagse componisten in een sfeervol decor.
                        </p>
                    </div>
                    <div>
                        <img src="../public/img/zwemmen.png" alt="Kindervoorstelling">
                        <div class="date-badge small">
                            <span>MEI</span>
                            <span>19</span>
                        </div>
                        <h3>De Drakentuin</h3>
                        <p>
                            Een betoverende voorstelling voor het hele gezin over moed, vriendschap en de 
                            kracht van verbeelding. Geschikt voor 6+.
                        </p>
                    </div>
                </div>
                <div class="view-all-wrapper">
                    <a href="/lessen" class="view-all-btn">Bekijk volledig programma</a>
                </div>
            </section>

            <!-- Over ons sectie -->
            <section class="intro">
                <div>
                    <h2>Over Theater Podium</h2>
                    <p>
                        Theater Podium is een plek waar verhalen tot leven komen. Al meer dan 25 jaar 
                        brengen wij voorstellingen die inspireren, uitdagen en verbinden. Van klassieke 
                        stukken tot experimenteel werk, van gerenommeerde gezelschappen tot nieuw talent.
                        Onze deuren staan open voor iedereen die zich wil laten meevoeren door de magie van theater.
                    </p>
                </div>
                <img src="../public/img/calltoaction.png" alt="Theatergebouw">
            </section>

            <!-- Nieuws & Actualiteiten -->
            <section class="news-section">
                <h2>Nieuws & Actualiteiten</h2>
                <div class="news-wrapper">
                    <article class="news-item">
                        <h3>Jonge Makers Festival aangekondigd</h3>
                        <p class="news-date">12 april 2023</p>
                        <p>
                            Deze zomer presenteren we het eerste Jonge Makers Festival met werk van opkomende 
                            regisseurs, choreografen en theatermakers onder de 30.
                        </p>
                        <a href="#" class="read-more">Lees meer</a>
                    </article>
                    <article class="news-item">
                        <h3>Nieuwe artistiek directeur</h3>
                        <p class="news-date">5 april 2023</p>
                        <p>
                            Met trots verwelkomen we vanaf september Julia Berends als onze nieuwe artistiek directeur, 
                            bekend van haar werk bij het Nationale Toneel.
                        </p>
                        <a href="#" class="read-more">Lees meer</a>
                    </article>
                </div>
            </section>

        </main>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>

    
    <?php require_once APPROOT . '/views/includes/under.php'; ?>