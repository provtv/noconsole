$(document).ready(function() {
    // Inizializzazione
    initializeUI();
    
    // Gestione degli errori globali
    $(document).ajaxError(function(event, jqXHR, settings, error) {
        showError('Errore nella richiesta: ' + error);
    });
});

function initializeUI() {
    // Aggiungi animazioni fade-in
    $('.btn, fieldset').addClass('fade-in');
    
    // Migliora la visibilità del focus
    $('.form-input').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });
}

function showLoading() {
    $('#output').html('<div class="loading">Caricamento in corso...</div>');
}

function showError(message) {
    $('#output').html(`<div class="error-message">${message}</div>`);
    $('.form-input').addClass('error');
    setTimeout(() => {
        $('.form-input').removeClass('error');
    }, 3000);
}

function showSuccess(message) {
    $('#output').html(`<div class="success-message">${message}</div>`);
    $('.form-input').addClass('success');
    setTimeout(() => {
        $('.form-input').removeClass('success');
    }, 3000);
}

function check() {
    showLoading();
    $.post('mainNoConsole.php', { function: 'check' }, function(data) {
        $('#output').html(data);
    });
}

function downloadComposer() {
    showLoading();
    $.post('mainComposer.php', { function: 'downloadComposer' }, function(data) {
        $('#output').html(data);
    });
}

function extractComposer() {
    showLoading();
    $.post('mainComposer.php', { function: 'extractComposer' }, function(data) {
        $('#output').html(data);
    });
}

function callPack(cmd, pack) {
    showLoading();
    const package = $(`#${pack}_text`).val();
    
    if (!package && cmd !== 'exe') {
        showError('Inserisci un pacchetto valido');
        return;
    }
    
    $.post(`main${pack}.php`, {
        function: 'command',
        command: cmd,
        package: package
    }, function(data) {
        $('#output').html(data);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        showError(`Errore: ${errorThrown}`);
    });
}

// Gestione del tasto Enter
$(document).keypress(function(e) {
    if (e.which == 13) {
        const activeElement = document.activeElement;
        if (activeElement.tagName === 'INPUT') {
            const pack = activeElement.id.split('_')[0];
            const cmd = $(`#${pack}_text`).data('last-command') || 'exe';
            callPack(cmd, pack);
        }
    }
});

// Memorizza l'ultimo comando utilizzato
$('.btn-success').click(function() {
    const pack = $(this).closest('fieldset').find('input').attr('id').split('_')[0];
    $(`#${pack}_text`).data('last-command', $(this).text());
});