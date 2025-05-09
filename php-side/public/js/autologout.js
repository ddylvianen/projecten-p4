
    let idleTime = 0;
    let idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    function timerIncrement() {
        idleTime = idleTime + 1;
        console.log(idleTime);
        if (idleTime > 14) { // 15 minutes
            window.location.href = "/logout";
        }
    }


    document.addEventListener("mousemove", resetIdleTime);
    document.addEventListener("keypress", resetIdleTime);
    document.addEventListener("click", resetIdleTime);
    document.addEventListener("scroll", resetIdleTime);

    function resetIdleTime() {
        idleTime = 0;
    }