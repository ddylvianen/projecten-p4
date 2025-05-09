
const form = document.getElementById("addles-form");
const initialData = new FormData(form);
let isDirty = false;

function checkChanges() {
    const currentData = new FormData(form);
    isDirty = false;

    for (let [key, value] of currentData.entries()) {
        if (value !== initialData.get(key)) {
            isDirty = true;
            break;
        }
    }
}

form.addEventListener("input", checkChanges);

form.addEventListener("submit", function (e) {
    checkChanges(); // check nog een keer bij submit
    if (!isDirty) {
        e.preventDefault();
        alert("Je hebt niks aangepast.");
    }
});