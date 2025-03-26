# NoConsole - Interfaccia Web per Laravel Artisan

## Descrizione
NoConsole è un'interfaccia web per eseguire comandi Laravel Artisan senza accesso alla console. È progettato per ambienti dove l'accesso SSH non è disponibile o non è pratico.

## Caratteristiche Principali
- Esecuzione di comandi Artisan tramite interfaccia web
- Gestione delle dipendenze Composer
- Gestione delle dipendenze Bower
- Gestione dei log
- Configurazione ambiente
- Integrazione con Filament Admin Panel
- Supporto per processi ReactPHP

## Requisiti
- PHP 7.4 o superiore
- Laravel 5.x o superiore
- Composer
- Node.js e npm (per Bower)

## Struttura del Progetto
```
noconsole/
├── docs/               # Documentazione
├── css/               # Stili CSS
├── js/                # Script JavaScript
├── _docs/             # Documentazione legacy
├── index.php          # Punto di ingresso
├── common.php         # Funzioni comuni
├── mainArtisan.php    # Gestore comandi Artisan
├── mainBower.php      # Gestore dipendenze Bower
├── mainComposer.php   # Gestore dipendenze Composer
├── mainEnv.php        # Gestore variabili ambiente
├── mainFilament.php   # Gestore Filament
├── mainLog.php        # Gestore log
└── mainReactphp.php   # Gestore processi ReactPHP
```

## Configurazione
1. Copiare `.env.example` in `.env`
2. Configurare `LARAVEL_DIR` nel file `.env`
3. Assicurarsi che i permessi delle cartelle siano corretti

## Sicurezza
- Implementare autenticazione appropriata
- Limitare l'accesso a IP specifici
- Utilizzare HTTPS
- Validare tutti gli input
- Sanitizzare l'output

## Best Practices
1. Utilizzare strict typing
2. Seguire PSR-12
3. Implementare logging strutturato
4. Validare input
5. Gestire errori appropriatamente

## Note
- Questo progetto è in fase di modernizzazione
- Sta passando da Bootstrap a Tailwind CSS
- Implementa best practices moderne di sviluppo PHP 