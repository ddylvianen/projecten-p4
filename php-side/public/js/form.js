// Zorg dat jQuery geladen is voordat dit script wordt uitgevoerd

// Algemene helper om een formulier te valideren op verplichte velden
function validateRequiredFieldsJQ($form, requiredFields) {
    let errors = [];
    requiredFields.forEach(field => {
        const $el = $form.find('#' + field.id);
        if ($el.length === 0 || !$el.val().trim()) {
            errors.push(field.name + ' is verplicht.');
        }
    });
    return errors;
}

// Detecteer of een formulier gewijzigd is
function isFormDirtyJQ($form, initialData) {
    let dirty = false;
    $form.serializeArray().forEach(function(item) {
        if (item.value !== (initialData[item.name] || '')) {
            dirty = true;
        }
    });
    return dirty;
}

// Initialiseer validatie en change-detectie voor een formulier
function setupFormFeaturesJQ(formId, requiredFields, changeAlert, requireDirty) {
    const $form = $('#' + formId);
    if ($form.length === 0) {
        console.warn(`Formulier '${formId}' niet gevonden in document.`);
        return;
    }
    let initialData = {};
    // Sla initiële data pas op NA volledige DOM load (en evt. plugins zoals Choices.js)
    $(window).on('load', function() {
        initialData = {};
        $form.serializeArray().forEach(function(item) {
            initialData[item.name] = item.value;
        });
    });

    $form.on('submit', function (e) {
        // Validatie
        if (requiredFields && requiredFields.length > 0) {
            const errors = validateRequiredFieldsJQ($form, requiredFields);
            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
                return;
            }
        }
        // Vereis wijziging bij update
        if (requireDirty && !isFormDirtyJQ($form, initialData)) {
            e.preventDefault();
            alert("Je hebt geen wijzigingen gemaakt aan het ticket.");
        }
        // Change-detectie bij submit (optioneel)
        if (changeAlert && !isFormDirtyJQ($form, initialData)) {
            e.preventDefault();
            alert("Je hebt niks aangepast aan de voorstelling.");
        }
    });
}

// Setup voor addles-form (les toevoegen/bewerken)
setupFormFeaturesJQ(
    "addles-form",
    [], // geen verplichte velden hier (pas aan indien nodig)
    true // change-detectie aan
);

// Setup voor ticket-form (ticket toevoegen/bewerken)
// Bij update (bewerken) is requireDirty true, bij toevoegen false
$(function() {
    const $ticketForm = $('#ticket-form');
    if ($ticketForm.length) {
        // Detecteer of het een update is (hidden id aanwezig)
        const isUpdate = $ticketForm.find('input[name=\"id\"]').length > 0 && $ticketForm.find('input[name=\"id\"]').val() !== '';
        setupFormFeaturesJQ(
            "ticket-form",
            [
                { id: 'voorstelling', name: 'Voorstelling' },
                { id: 'barcode', name: 'Barcode' },
                { id: 'status', name: 'Status' },
                { id: 'bezoeker', name: 'Bezoeker' },
                { id: 'prijs', name: 'Prijs' }
            ],
            false, // geen losse change-alert
            isUpdate // alleen bij update vereisen dat er iets gewijzigd is
        );
    }
});