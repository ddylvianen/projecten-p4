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
                 <?php require_once APPROOT . '/views/view-functions/lessen.php'; ?>
                 <?php
                        $template = new Lessen();
                        $template->page($data);
                    ?>
             </div>
        </main>
        <?php require_once APPROOT . '/views/includes/footer.php'; ?>
    </div>

    <div id="confirmation" class="modal">
        <div class="modal-content">
            <div class="modal-header border">
                <h2>Anuleer ****?</h2>
                <i class="fa-solid fa-x modal-close"></i>
            </div>
            
            <div class="text border">
                <p>Ben je zeker dat je **** wilt anuleren?</p>
                <p>Dit kan niet meer veranderd worden.</p>
            </div>
            <div class="modal-actions">
                <button class="btn">Cancel</button>
                <button class="btn">Delete</button>
            </div>
        </div>    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/4c0f1a2b8d.js" crossorigin="anonymous"></script>

    <script>
        const deleteButtons = document.querySelectorAll('.delete');
        const modal = document.querySelector('.modal');
        const modalClose = document.querySelector('.modal-close');
        const cancelButton = document.querySelector('.btn:first-child');
        const deleteButton = document.querySelector('.btn:last-child');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.style.display = 'block';
                deleteButton.setAttribute('data-id', button.id);

                const lessonName = button.closest('tr').querySelector('td:nth-child(1)').textContent;
                const lessonDate = button.closest('tr').querySelector('td:nth-child(2)').textContent;

                console.log(lessonName, lessonDate);
                modal.querySelector('h2').textContent = `Anuleer ${lessonName} op ${lessonDate}?`;
                modal.querySelector('.text p').textContent = `Ben je zeker dat je ${lessonName} op ${lessonDate} wilt annuleren?`;
            });
        });

        modalClose.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        cancelButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        deleteButton.addEventListener('click', () => {
            const id = deleteButton.getAttribute('data-id');
            window.location.href = `/deleteles?id=${id}`;
        });
    </script>
    <?php require_once APPROOT . '/views/includes/under.php'; ?>