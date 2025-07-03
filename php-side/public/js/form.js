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

    // Sla initiële data pas op NA volledige window load (en evt. plugins zoals Choices.js)
    $(window).on('load', function() {
        initialData = {};
        $form.find('input, select, textarea').each(function() {
            initialData[this.name] = $(this).val();
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
        if (requireDirty) {
            let changed = false;
            $form.find('input, select, textarea').each(function() {
                if ($(this).val() !== initialData[this.name]) {
                    changed = true;
                }
            });
            if (!changed) {
                e.preventDefault();
                alert("Er zijn geen wijzigingen om op te slaan");
            }
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
        const isUpdate = $ticketForm.find('input[name="id"]').length > 0 && $ticketForm.find('input[name="id"]').val() !== '';
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

// Initialiseer Choices.js voor bezoeker-selectie indien aanwezig
$(function () {
    var bezoekerSelect = $('#bezoeker');
    if (bezoekerSelect.length && typeof Choices !== 'undefined') {
        new Choices(bezoekerSelect[0], {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false
        });
    }
});