<!--
 * File: /README.md
 * @package smartbreak
 * @author  Nicola Sergio <nicolasergio04@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	November 15th, 2022 00:57:03
 * -----
 * Last Modified: 	June 4rd 2024 11:45:54 am
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2024-06-04	R. Andriano	  Readme 1.3
 * 2022-11-22	N. Sergio 	  Readme 1.2
-->
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/colamonico-chiarulli/smartbreak/blob/master/public/img/logos/logo.svg" width="400"></a></p>

<div align="center"> 

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/colamonico-chiarulli/smartbreak)  ![GitHub top language](https://img.shields.io/github/languages/top/colamonico-chiarulli/smartbreak) ![languages](https://img.shields.io/github/languages/count/colamonico-chiarulli/smartbreak) ![Project Forks](https://img.shields.io/github/forks/colamonico-chiarulli/smartbreak?style=social)  ![GitHub Release Date](https://img.shields.io/github/release-date/colamonico-chiarulli/smartbreak) ![license](https://img.shields.io/badge/License-AGPLv3.0-green)

</div>


> ## SmartBreak
>*Ordina la tua merenda al bar della scuola con un click!*

**SmartBreak** è un'innovativa **applicazione web PWA** *(Progressive Web App)* che rivoluziona gli **ordini al bar della scuola**, migliorando efficienza, comodità e sostenibilità per studenti, personale del bar ed istituzioni scolastiche.

Essa è stata progettata e sviluppata con il contributo degli studenti durante il corso PON "The AppFactory" tra dicembre 2020 e aprile 2021, nell'indirizzo "*Informatica e Telecomunicazioni*" presso l'IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy.

Esperto del progetto e sviluppatore:  [dr. Giovanni Ciriello](https://github.com/giovanniciriello)  
Tutor e sviluppatore: [prof. Rino Andriano](https://github.com/colamonico-chiarulli/smartbreak/commits?author=rino-andriano) 

La manutenzione e lo sviluppo ulteriore è attualmente affidato ad team di docenti e studenti sviluppatori della stessa scuola.

---
> ## Demo
> Una demo dell’applicazione è disponibile all’indirizzo
https://sbtest.colamonicochiarulli.it \
Usare il pulsante **Accedi** e le credenziali fornite nella pagina di login, per provare SmartBreak nei vari ruoli: studente, bar manager e amministratore. \
N.B. Nella demo **le cancellazioni e le modifiche** ai dati di prova presenti nel Database **sono solo simulate**.
---
> ## Funzionalità dell'App
  - Ogni studente, dopo l’autenticazione con account Google istituzionale, **API Google (OAuth 2.0)**, può ordinare da qualsiasi dispositivo mobile i prodotti che intende acquistare al Bar della scuola, tra quelli proposti e disponibili, consultando un’apposita lista fotografica di prodotti.
  - L’applicazione compila automaticamente le liste delle ordinazioni giornaliere per classe, rendendo più semplice il processo di preparazione dell’ordine e la consegna dei prodotti.
  - Fornisce statistiche agli studenti sui propri acquisti, al Bar sulle vendite e alla scuola sull'utilizzo del servizio.

L'applicazione prevede la gestione di più sedi scolastiche, ciascuna con il proprio servizio BAR, ed è stata progettata e realizzata sulla base di 3 tipologie di utenti: 
  - **Amministratore:** il tecnico ICT della scuola, che amministra tutti gli aspetti relativi all'applicazione. 
  - **Bar Manager**: il responsabile del bar di una sede, che si occupa della preparazione fisica degli ordini.
  - **Studente**: ogni singolo studente della scuola, che accede all'app con il proprio account istituzionale (Google for Education).


Nello specifico :
- **Funzionalità per l'Amministratore** (scuola):
  - **Gestione sedi scolastiche**: può aggiungere, modificare ed eliminare le sedi scolastiche.
  - **Gestione utenti**: può aggiungere, modificare e eliminare gli utenti *Administrator* e *Bar Manager*. 
  - **Gestioni classi**: può aggiungere, modificare e eliminare le classi. Il loro inserimento può essere eseguito anche mediante file **CSV**.
  - **Gestione studenti**: può aggiungere, modificare e eliminare gli studenti.  Il loro inserimento può essere eseguito anche mediante file **CSV**.
  - **Gestione categorie**: può aggiungere, modificare e eliminare categorie dal catalogo dei prodotti.
  - **Gestione prodotti**: può aggiungere, modificare ed eliminare prodotti dal catalogo. 
  - **Statistiche**: può visualizzare le statistiche sull'utilizzo dell'applicazione nelle varie sedi della scuola, filtrando i risultati per unità temporale (settimana, mese, anno).
  - **Messaggi**: Possibilità per l'amministratore di scrivere e inviare messaggi (Es. nuove funzionalità) agli utenti in base al ruolo (Studente, Manager, Amministratore). Al primo login utente verrà visualizzato l'ultimo messaggio non letto.
  
- **Funzionalità per il Bar Manager**:
  - **Gestione categorie**: può aggiungere, modificare e eliminare categorie dal catalogo.
  - **Gestione prodotti**: può aggiungere, modificare ed eliminare prodotti dal catalogo.
  - **Gestione giacenze**: può aggiornare velocemente le quantità disponibili dei prodotti presenti nel listino.
  - **Ordini per prodotto**: può visualizzare in un'unica tabella tutti gli ordini del giorno raggruppati per prodotto.
  - **Ordini per classe**: può visualizzare gli ordini del giorno raggruppati per classe, impostando lo stato (complete o incomplete). A protezione della privacy degli studenti, il Bar Manager non è in assolutamente grado di visualizzare il dettaglio dei singoli utenti.
  - **Gestione delle disponibilità giornaliere**: se lo desidera, può impostare per i prodotti una quantità disponibile giornalmente. La giacenza viene aggiornata ogni giorno automaticamente per ogni prodotto in cui è stata impostata una **disponibilità > 0**
  - **Statistiche**: può visualizzare le statistiche delle vendite dei prodotti e degli incassi del bar, filtrando i risultati per unità temporale (settimana, mese, anno).


- **Funzionalità per lo Studente**:
  - **Fai un ordine**: ogni singolo studente può effettuare ordinazioni al bar, scegliendo tra i prodotti disponibili e inserendo la quantità desiderata. Se si effettuano  più ordni in un giorno verranno raggruppati automaticamente. Gli ordini possono essere effettuati **solo** in un intervallo orario (Es. 07:30-09:30)
  - **Listino prodotti** Fuori dall'intervallo orario utile a fare gli ordini, viene comunque visualizzato il listino dei prodotti disponibili.
  - **I miei ordini**: può visualizzare le proprie ordinazioni effettuate nel tempo, giorno per giorno. 
  - **Cancella ordine**: Nell'intervallo orario degli ordini, è possibile annullare l'ordine del giorno corrente.
  - **Acquista di nuovo**: Nell'intervallo orario degli ordini, è possibile aggiungere al carrello un vecchio ordine.
  - **Ordini della mia classe** ogni studente può visualizzare la lista degli ordini della propria classe, alunno per alunno, con il dettaglio dei prodotti e del corrispettivo da pagare. Ciò è utile per il ritiro dei prodotti e la loro distribuzione nell'aula
  - **Statistiche**: può tenere sotto controllo le proprie spese, visualizzando le statistiche delle spese totalii e per categoria, filtrando i risultati per unità temporale (settimana, mese, anno).
---
> ## Vantaggi di SmartBreak

L'utilizzo di SmartBreak, come sistema di gestione delle liste di ordinazioni al Bar della scuola offre numerosi vantaggi per tutti.

> **Vantaggi per la scuola**:

*   _**Maggior efficienza nella gestione delle ordinazioni**:_ l'applicazione consente una gestione più efficiente delle ordinazioni rispetto alle tradizionali liste cartacee, con minore dispendio di tempo scuola. Inoltre, evita spostamenti degli studenti fuori-classe per la consegna/ritiro delle liste e dei prodotti, che può essere affidato al personale ATA della scuola.
    
*   _**Miglioramento del servizio**:_ Grazie alla possibilità per gli studenti di ordinare in anticipo e con maggiore precisione, il servizio offerto dal bar della scuola può migliorare e diventare più efficiente.
    
*   _**Maggiore sicurezza**:_ L'applicazione consente di tenere traccia delle ordinazioni degli studenti in modo sicuro e affidabile, minimizzando il rischio di perdite o di errori.
    
*   _**Riduzione dell'utilizzo di carta**:_ L'eliminazione delle liste di ordinazioni cartacee riduce la quantità di carta utilizzata dalla scuola e dei rifiuti prodotti.
  
*   _**Tutela della Privacy**:_ Ogni utente: amministratore, bar manager e studente, accede solo ai propri dati, in base al ruolo. 
L'assenza voluta di sistemi di pagamento elettronici, evita qualsiasi problema legato all'autorizzazione preventiva dei genitori dei minori ed evita qualsiasi profilazione dei utenti come consumatori.
   
> **Vantaggi per il Bar Manager**:

*   _**Maggiore precisione**:_ L'applicazione Web permette di ridurre al minimo gli errori di compilazione delle ordinazioni e i malintesi nella trascrizione, migliorando la precisione e l'efficienza del servizio.
    
*   _**Maggiore efficienza**:_ L'applicazione web consente di visualizzare in tempo reale gli ordini con dati aggregati per prodotto e per classe. Inoltre, genera statistiche sulle vendite, permettendo di gestire il servizio in modo più efficiente.
    
*   _**Ottimizzazione del tempo**:_ L'applicazione Web consente di ridurre il tempo necessario per la compilazione delle liste di ordinazione e l'elaborazione dei dati, consentendo al Bar Manager di dedicarsi ad altre attività importanti.
    
*   _**Eliminazione degli sprechi alimentari**:_ Con la gestione cartacea o la vendita al banco, il personale del BAR può avere difficoltà a stimare le quantità di prodotto fresco da preparare per la tentata vendita, il che può comportare sprechi di cibo o vendite mancate per esaurimento delle scorte. SmartBreak consente al Bar Manager di conoscere le **ordinazioni reali** aggregate per singoli prodotti e  di gestire quindi, gli stock in modo più efficace evitando scorte eccessive o carenze di prodotto.
    
*   _**Migliora la comunicazione e la trasparenza**:_ il BAR Manager è libero di aggiungere nuovi prodotti e, per ciascuno di essi può fornire tutte le informazioni necessarie, compreso gli ingredienti e allergeni.
   
> **Vantaggi per gli studenti**:
*   _**Facilità di accesso**_: gli studenti possono effettuare le loro ordinazioni da qualsiasi dispositivo connesso a Internet, come PC o smartphone.
    
*   _**Comodità**_: gli studenti non sono costretti a fare la fila o a dover attendere il proprio turno al bancone del Bar. Possono fare le loro ordinazioni online anche da casa, o durante il viaggio a scuola e poi ritirare i prodotti al momento stabilito, evitando così attese prolungate.
    
*   _**Tracciabilità degli acquisti**_: gli studenti possono accedere alla propria cronologia di acquisti e visualizzare lo storico degli ordini giornalieri, il che rende più facile tenere traccia delle spese e delle preferenze personali.
    
*   _**Maggiore scelta**_: l'applicazione Web può mostrare l'intero menu del Bar della scuola, consentendo agli studenti di fare scelte informate e di selezionare i prodotti preferiti, anche in base agli allergeni, senza dover necessariamente consultare un elenco cartaceo.
    
*   _**Riduzione dell'errore umano**_: l'interfaccia dell'applicazione Web elimina la necessità di dover scrivere manualmente l'ordinazione su un pezzo di carta, riducendo così la possibilità di errori o di fraintendimenti.
---
> ## Tecnologie 

 #### Linguaggi, framework, packages
 SmartBreak è stata sviluppata utilizzando il framework PHP [Laravel](https://laravel.com/), ampiamente diffuso nel mondo del lavoro. Inoltre, sono state utilizzate altre tecnologie e linguaggi come HTML5, CSS3, Bootstrap, JavaScript, PHP, AJAX, MySQL, Composer. GIT è usaro per lo sviluppo collaborativo del codice.
  
 #### PWA (Progressive Web App)
 Per usare SmartBreak è sufficiente un **semplice browser** su qualsiasi computer o dispositivo ma se si accede da ***smartphone*** il programma propone di **installarla** *(creare avvio rapido)* nel dispositivo. Se si accetta SmartBreak si comporterà come le altre applicazioni ed avrà la propria icona.

 Vantaggi per gli utenti:

  * Velocità: Le PWA si caricano in un batter d'occhio, anche con una connessione internet debole.
  * Esperienza utente fluida: Offrono un'esperienza simile a quella di un'app nativa, con animazioni fluide e interazioni intuitive.
  * Nessun download: Non è necessario installarle dal Play Store o dall'App Store. Basta aprirle nel tuo browser web!
  * Aggiornamenti automatici: Riceverai sempre le ultime funzioni e i contenuti senza dover fare nulla.
  * Sicurezza: Le PWA sono sicure e proteggono i tuoi dati.

---
> ## Riconoscimenti e Premi
  - SmartBreak è stato [selezionato](https://www.colamonicochiarulli.edu.it/2023/10/11/smartbreak-al-maker-faire-2023/) ed ha partecipato come [**espositore**](https://makerfairerome.eu/it/espositori/?edition=2023&exhibit=2320169) al [**Maker Faire 2023**](https://makerfairerome.eu/it/edizioni/2023-it/) che si è tenuto alla Fiera di Roma dal 20 al 22 ottobre 2023. Maker Faire è l'evento europeo che facilita e racconta l’innovazione in modo semplice ed accessibile, connettendo le imprese, il mondo accademico, le persone e le idee. Essa è una manifestazione fieristica dove esperti del settore, maker e innovatori si incontrano per condividere i loro progetti con il grande pubblico. 
  - SmartBreak è stato premiato, classificandosi al [**secondo posto**](https://www.colamonicochiarulli.edu.it/2023/12/16/premio-imprendi-per-linnovazione/) del concorso nazionale [**Premio Imprendi per l’Innovazione**](https://www.imprendi.org/progetti/) 2022-23 della Fondazione Imprendi di Padova
---
 >  ## Main developers

- [Giovanni Ciriello](mailto:giovanni.ciriello.5@gmail.com) [Esperto progetto]
- [Rino Andriano](mailto:r.andriano@colamonicochiarulli.edu.it) [Docente e promotore del progetto]
- [Changelog](https://github.com/colamonico-chiarulli/smartbreak/blob/master/CHANGELOG.md)
- [Contributors](https://github.com/colamonico-chiarulli/smartbreak/graphs/contributors)

---
> ## Developers team a.s. 2022-2023
 * Fabio Caccavone |  @FabioC04
 * Nico Chimienti  | @nico-ch
 * Giuseppe Giorgio | @NovaPixell
 * Francesco Liantonio | @Francesco-04
 * Anthony Liuzzi | @Anthonyliu05
 * Gabriele Antonio Losurdo | @Gabriele-Losurdo
 * Toni Marziliano | @tonim2004
 * Claudio Montenegro | @serkaos
 * Nicola Sergio | @Nicola-Sergio
 * Costantino Tassielli | @CostaTassielli04
 * Camilla Vaira | @camillariav

---
> ## Licenza
 SmartBreak is free software; you can redistribute it and/or modify it under the terms of the GNU Affero General Public License version 3 as published by the Free Software Foundation
SmartBreak is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

The interactive user interfaces in original and modified versions of this program must display Appropriate Legal Notices, as required under Section 5 of the GNU Affero General Public License version 3.

In accordance with Section 7(b) of the GNU Affero General Public License version 3, these Appropriate Legal Notices **must retain** the display of the **SmartBreak logo**, the **IISS "Colamonico-Chiarulli" copyright** notice and the **credits** link. If the display of the logo is not reasonably feasible for technical reasons, the Appropriate Legal Notices must display the words "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it".

In conformità con la Sezione 7(b) della GNU Affero General Public License versione 3, qualsiasi pubblicazione/utilizzo di questo prodotto deve conservare la visualizzazione del **logo SmartBreak**, l'avviso di **copyright di IISS "Colamonico-Chiarulli**" ed il link **credits**. Se la visualizzazione del logo non è ragionevolmente fattibile per motivi tecnici, gli Avvisi Legali devono visualizzare le parole "(C) IISS Colamonico-Chiarulli - https://colamonicochiarulli.edu.it".

---
>  ## Utilizzo e supporto
Nel caso SmartBreak sia adottato da qualche scuola, è gradita la segnalazione scrivendo a [smartbreak@colamonicochiarulli.edu.it](mailto:smartbreak@colamonicochiarulli.edu.it).

Alla stessa mail è possibile scrivere per richieste di supporto.