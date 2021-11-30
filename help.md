- vendor/bin/phpunit

Se va in errore per transaction, prova :
- php artisan cache:clear
- php artisan config:clear

- TESTS
[x] Come amministratore voglio creare un corso.
[x] Come amministratore voglio ricevere un errore se creo un corso con un nome già presente.
[x] Come amministratore voglio creare un iscritto
[x] Come amministratore voglio ricevere un errore se creo un iscritto con una mail già presente.
[x] Come amministratore voglio ricevere un errore se creo un iscritto con una mail non valida.
[x] Come amministratore voglio creare un allenatore.
[x] Come amministratore voglio ricevere un errore se creo un allenatore con una mail già presente.
[x] Come amministratore voglio ricevere un errore se creo un allenatore con una mail non valida.
[x] Come amministratore voglio associare un allenatore ad un corso.
[x] Come amministratore voglio associare un iscritto ad un corso.
[x] Come amministratore voglio ricevere un errore se provassi a collegare un partecipante ad un corso ed uno dei due non esistesse.
[x] Come allenatore voglio poter elencare tutti i corsi dei quali sono titolare


[] Come amministratore nel caso volessi associare un allenatore ad un corso già assegnato ad un altro allenatore devo avere un errore.
[] Come allenatore voglio poter estrapolare l’elenco degli iscritti ad un corso del quale sono titolare
[] Come iscritto voglio poter ricevere un errore se provassi a registrare la mia presenza ad un corso in cui sono già iscritto
[] Come iscritto voglio poter richiedere la cancellazione della mia presenza da uno specifico corso a cui sono iscritto


[] Come allenatore voglio poter cancellare la presenza di un iscritto in una data
[] Come iscritto voglio poter registrare la mia presenza ad un corso in una determinata data
[] Come allenatore voglio poter consultare l’elenco delle presenze relative ad un corso del quale sono titolare
[] Come iscritto voglio estrapolare l’elenco delle mie presenze relative ad un corso