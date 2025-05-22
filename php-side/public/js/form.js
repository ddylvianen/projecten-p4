try {
    const form = document.getElementById("addles-form");
    if (form) {
        const initialData = new FormData(form);
        let isDirty = false;

        function checkChanges() {
            try {
                const currentData = new FormData(form);
                isDirty = false;

                for (let [key, value] of currentData.entries()) {
                    if (value !== initialData.get(key)) {
                        isDirty = true;
                        break;
                    }
                }
            } catch (error) {
                console.error("Fout bij het controleren van wijzigingen:", error);
            }
        }

        form.addEventListener("input", checkChanges);

        form.addEventListener("submit", function (e) {
            try {
                checkChanges(); // check nog een keer bij submit
                if (!isDirty) {
                    e.preventDefault();
                    alert("Je hebt niks aangepast aan de voorstelling.");
                }
            } catch (error) {
                console.error("Fout bij het formulier verzenden:", error);
                // Allow form submission even in error case
            }
        });
    } else {
        console.warn("Formulier 'addles-form' niet gevonden in document.");
    }
} catch (e) {
    console.error("Algemene fout in formulierscript:", e);
}