<!--CHANGELOG of smartbreak-->
<!--
 * File: /CHANGELOG.md
 * @package smartbreak
 * @author  Nicola Sergio <nicolasergio04@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	November 18th, 2022 01:00:03
 * -----
 * Last Modified: 	November 22th 2022 11:44:39 pm
 * Modified By: 	Nicola Sergio <nicola.sergio@colamonicochiarulli.edu.it>
-->
 # SmartBreak - Changelog

  **SmartBreak** è un'applicazione web per la gestione delle liste di prenotazioni al Bar della scuola sviluppata durante il corso PON "The AppFactory" tra dicembre 2020 e aprile 2021, con insegnanti e studenti dell'indirizzo "Informatica e Telecomunicazioni" presso l'IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy.

  Esperto del progetto:   [dr. Giovanni Ciriello](https://github.com/giovanniciriello)  

  La manutenzione e lo sviluppo ulteriore è attualmente affidato ad team di studenti sviluppatori dell'indirizzo Informatica e Telecomunicazioni della stessa scuola.
   
---
 ### Documentazione delle modifche più significative di SmartBreak.
---
> ## [v.1.2.0] - (2022-11-30)
---
 ### :rocket: Nuove Funzionalità

  - [x]  **Cancellazione ordini** - Possibilità di cancellare gli ordini del giorno (nello stesso intervallo di tempo in cui è possibile effettuarli), ([805e0cc](https://github.com/colamonico-chiarulli/smartbreak/commit/805e0cce86713a0fec8eba9057cfd1b7670db87b)). [Giuseppe Giorgio - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=NovaPixell)

  - [x]  **Totale pezzi ordinati per classe** - Aggiunto nella pagina Ordini per classe del bar manager, il totale dei pezzi ordinati ([ddf3fc8](https://github.com/colamonico-chiarulli/smartbreak/commit/ddf3fc89bc1cbf567b5c28032eba3d13caa01cbd)). [Costantino Tassielli - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=CostaTassielli04)
  - [x]  **Listino prodotti** Fuori dall'intervallo orario utile a fare gli ordini, viene comunque visualizzato il listino dei prodotti disponibili ([c2a9dbc](https://github.com/colamonico-chiarulli/smartbreak/commit/c2a9dbcf3e112c81669ff6b3b1a7cd98a0948216)) - [Gabriele Losurdo - 5InfA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=Gabriele-Losurdo)
  - [x]  **Messaggi** - Possibilità per l'amministratore di inviare messaggi agli utenti. CRUD dei Messaggi - Visualizzazione al login dell'ultimo messaggio non letto per il ruolo dell'utente (studente, manager, administrator) ([7bd53dc](https://github.com/colamonico-chiarulli/smartbreak/commit/7bd53dc6d7dabe60f444d4754051f276a6eb2c7f)) - [Fabio Caccavone 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=FabioC04)
  
 
### :bug: Risoluzione di Bug

- [x] Corretto il link sul logo per gli ospiti (non autenticati), ora vengono reindirizzati alla landing page ([7167340](https://github.com/colamonico-chiarulli/smartbreak/commit/7167340bf1d81c7ed52846946ef4c7a02bb12402)) -  [Nicola Sergio - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=Nicola-Sergio)

- [x] Nella navbar adesso viene sempre visualizzato il numero degli articoli inseriti nel carrello ed il totale spesa, anche se si cambia funzionalità (Es. Statistiche)([5b780cb](https://github.com/colamonico-chiarulli/smartbreak/commit/5b780cb2f1d61ac44c0acac6b6b8073013a7a4b7)).[Giuseppe Giorgio - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=NovaPixell)
  
- [x] Fuori dall'intervallo degli ordini, non viene più visualizzato il carrello nella navbar([9daf168](https://github.com/colamonico-chiarulli/smartbreak/commit/9daf1685634115054f4173ea721ebc3642100cb8)).[Giuseppe Giorgio - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=NovaPixell)

### :wrench: Miglioramenti

- [x] **Layout** - Rimossa la sidebar dalla pagina di login ([e4d169b](https://github.com/colamonico-chiarulli/smartbreak/commit/e4d169b8850c754825cabcf033bb899e5932afeb)).
  
- [x]  **Avviso tempo utile per ordinare** - Nella visualizzazione del Listino adesso visualizza anche lìintervallo di tempo nel quale è possibile effettuare ordini ([c2a9dbc](https://github.com/colamonico-chiarulli/smartbreak/commit/c2a9dbcf3e112c81669ff6b3b1a7cd98a0948216)) - [Gabriele Losurdo - 5InfA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=Gabriele-Losurdo)

- [x] Aggiunti tooltip sulle icone (vedi, Modifica, cancella) in tutte le pagine index dei vari CRUD di tutte le tabelle ([31227ab](https://github.com/colamonico-chiarulli/smartbreak/commit/31227abfd9661e4ff9288286757cdab5cea402ad)) - [Antony Liuzzi - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=Anthonyliu05)
  
- [x]  **Documentazione** - Aggiunti i file README.md and CHANGELOG.md  -  [Nicola Sergio - 5infA](https://github.com/colamonico-chiarulli/smartbreak/commits?author=Nicola-Sergio)
---
> ## [v1.0.1] - (2021-09-27)
### :bug: Risoluzione di Bug

   - [x]  Prevenzione del click compulsivo sul pulsante [Conferma Ordine] per evitare la creazione multipla dello stesso ordine([12e6b01](https://github.com/colamonico-chiarulli/smartbreak/commit/12e6b011dd3ddabf58237f00dcc7a6ee4c727f00)).[Rino Andriano](https://github.com/colamonico-chiarulli/smartbreak/commits?author=rino-andriano)

> ## [v1.0.0 stable] - (2022-02-03)
### :rocket: Funzionalità dell'App

**Funzionalità disponibili nella prima versione stabile**

  - Ogni studente, dopo l’autenticazione con account Google istituzionale, **API Google (OAuth 2.0)**., può ordinare da qualsiasi dispositivo mobile i prodotti che intende acquistare al Bar della scuola, tra quelli proposti e disponibili, consultando un’apposita lista fotografica di prodotti.
  - L’applicazione compila automaticamente le liste delle ordinazioni giornaliere per classe, rendendo più semplice il processo di preparazione dell’ordine e la consegna dei prodotti.
  - Fornisce statistiche agli studenti sui propri acquisti e al Bar sulle vendite

L'applicazione prevede la gestione di più sedi scolastiche, ciascuna con il proprio servizio BAR, ed è stata progettata e realizzata sulla base di 3 tipologie di utenti: 
  - **Amministratore:** il tecnico ICT della scuola, che amministra tutti gli aspetti relativi all'applicazione. 
  - **Bar Manager**: il responsabile del bar di una sede, che si occupa della preparazione fisica degli ordini.
  - **Studente**: ogni singolo studente della scuola, che accede all'app con il proprio account istituzionale (Google for Education).


Nello specifico :
- **Amministratore**:
  - **Gestione sedi scolastiche**: può aggiungere, modificare ed eliminare le sedi scolastiche.
  - **Gestione utenti**: può aggiungere, modificare e eliminare gli utenti *Administrator* e *Bar Manager*. 
  - **Gestioni classi**: può aggiungere, modificare e eliminare le classi. Il loro inserimento può essere eseguito anche mediante file **CSV**.
  - **Gestione studenti**: può aggiungere, modificare e eliminare gli studenti.  Il loro inserimento può essere eseguito anche mediante file **CSV**.
  - **Gestione categorie**: può aggiungere, modificare e eliminare categorie dal catalogo dei prodotti.
  - **Gestione prodotti**: può aggiungere, modificare ed eliminare prodotti dal catalogo. 
  - **Statistiche**: può visualizzare le statistiche sull'utilizzo dell'applicazione nelle varie sedi della scuola, filtrando i risultati per unità temporale (settimana, mese, anno).
  
- **Bar Manager**:
  - **Gestione categorie**: può aggiungere, modificare e eliminare categorie dal catalogo.
  - **Gestione prodotti**: può aggiungere, modificare ed eliminare prodotti dal catalogo.
  - **Gestione giacenze**: può aggiornare velocemente le quantità disponibili dei prodotti presenti nel listino.
  - **Ordini per prodotto**: può visualizzare in un'unica tabella tutti gli ordini del giorno raggruppati per prodotto.
  - **Ordini per classe**: può visualizzare gli ordini del giorno raggruppati per classe, impostando lo stato (complete o incomplete). Il Bar Manager non è in grado di visualizzare il dettaglio dei singoli utenti.
  - **Gestione delle disponibilità giornaliere**: se lo desidera, può impostare per i prodotti una quantità disponibile giornalmente. La giacenza viene aggiornata ogni giorno automaticamente.
  - **Statistiche**: può visualizzare le statistiche delle vendite dei prodotti e degli incassi del bar, filtrando i risultati per unità temporale (settimana, mese, anno).


- **Studente**:
  - **Fai un ordine**: ogni singolo studente può effettuare ordinazioni al bar, scegliendo tra i prodotti disponibili e inserendo la quantità desiderata. Se si effettuano più ordni in un giorno verranno raggruppati automaticamente. Gli ordini possono essere effettuati **solo** in un intervallo orario (Es. 07:30-09:30)

  - **I miei ordini**: può visualizzare le proprie ordinazioni effettuate nel tempo, giorno per giorno. 
  - **Ordni della mia classe** ogni studente può visualizzare la lista degli ordini della propria classe, alunno per alunno, con il dettaglio dei prodotti e del corrispettivo da pagare. Ciò è utile per il ritiro dei prodotti e la loro distribuzione nell'aula
  - **Statistiche**: può tenere sotto controllo le proprie spese, visualizzando le statistiche delle spese totalii e per categoria, filtrando i risultati per unità temporale (settimana, mese, anno).

---



