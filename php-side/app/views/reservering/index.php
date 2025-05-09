<?php require_once APPROOT . '/views/includes/header.php'; ?>
<?php require_once APPROOT . '/views/view-functions/reservering.php'; ?>
<?php
    $template = new reserveringfunctions();
?>

<link rel="stylesheet" href="../public/css/lessen.css">
</head>

<body>
    <div class="cont">
        <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
        <main>
            <?php $template->makeweek($data['week'], $data['weekNumber'], 'reservering')?>
            <section>
                <?php    
                    foreach($data['lessen'] as $day){
                        $naam = array_search( $day, $data['lessen']);
                        $template->makeday($day, $naam);
                    }

                    
                ?>
            </section>
        </main>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>
    <!-- <div class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Reverve **les**?</h2>
                <i class="fa-solid fa-x modal-close"></i>
            </div>
            
            <div class="text border">
                <p>Are you sure you want to Reverve this lesson?</p>
                
            </div>
            <div class="modal-actions">
                <button class="btn">Cancel</button>
                <button class="btn">Reserve</button>
            </div>
        </div>    
    </div> -->
    <?php require_once APPROOT . '/views/includes/under.php'; ?>