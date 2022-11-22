<!--
 * File: /README.md
 * @package smartbreak
 * @author  Nicola Sergio <nicolasergio04@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	November 15th, 2022 00:57:03
 * -----
 * Last Modified: 	November 22th 2022 11:21:41 pm
 * Modified By: 	Nicola Sergio <nicola.sergio@colamonicochiarulli.edu.it>
-->
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/colamonico-chiarulli/smartbreak/blob/master/public/img/logos/logo.svg" width="400"></a></p>

<div align="center"> 

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/colamonico-chiarulli/smartbreak)  ![GitHub top language](https://img.shields.io/github/languages/top/colamonico-chiarulli/smartbreak) ![languages](https://img.shields.io/github/languages/count/colamonico-chiarulli/smartbreak) ![Project Forks](https://img.shields.io/github/forks/colamonico-chiarulli/smartbreak?style=social)  ![GitHub Release Date](https://img.shields.io/github/release-date/colamonico-chiarulli/smartbreak) ![license](https://img.shields.io/badge/License-AGPLv3.0-green)

</div>


> ## SmartBreak

  **SmartBreak** è un'applicazione web per la gestione delle liste di prenotazioni al Bar della scuola sviluppata durante il corso PON "The AppFactory" tra dicembre 2020 e aprile 2021, con insegnanti e studenti dell'indirizzo "Informatica e Telecomunicazioni" presso l'IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy.

   Esperto del progetto:  dr. [**Giovanni Ciriello**.](https://github.com/giovanniciriello)  

La manutenzione e lo sviluppo ulteriore è attualmente affidato ad team di studenti sviluppatori dell'indirizzo Informatica e Telecomunicazioni della stessa scuola.
   
   ---
> ## Funzionalità dell'App
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
  - **Fai un ordine**: ogni singolo studente può effettuare ordinazioni al bar, scegliendo tra i prodotti disponibili e inserendo la quantità desiderata. Se si effettuano  più ordni in un giorno verranno raggruppati automaticamente. Gli ordini possono essere effettuati **solo** in un intervallo orario (Es. 07:30-09:30)
  - **Listino prodotti** Fuori dall'intervallo orario utile a fare gli ordini, viene comunque visualizzato il listino dei prodotti disponibili.
  - **I miei ordini**: può visualizzare le proprie ordinazioni effettuate nel tempo, giorno per giorno. 
  - **Ordni della mia classe** ogni studente può visualizzare la lista degli ordini della propria classe, alunno per alunno, con il dettaglio dei prodotti e del corrispettivo da pagare. Ciò è utile per il ritiro dei prodotti e la loro distribuzione nell'aula
  - **Cancella ordine**: Nell'intervallo orario degli ordini, è possibile annullare l'ordine del giorno corrente.
  - **Statistiche**: può tenere sotto controllo le proprie spese, visualizzando le statistiche delle spese totalii e per categoria, filtrando i risultati per unità temporale (settimana, mese, anno).

---
 >  ## Main developers

- [Giovanni Ciriello](mailto:giovanni.ciriello.5@gmail.com) [Esperto progetto]
- [Rino Andriano](mailto:r.andriano@colamonicochiarulli.edu.it) [Docente e promotore del progetto]

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

@github/support What do you think about this readme?

---
> ## License
 SmartBreak is free software; you can redistribute it and/or modify it under the terms of the GNU Affero General Public License version 3 as published by the Free Software Foundation
SmartBreak is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

The interactive user interfaces in original and modified versions of this program must display Appropriate Legal Notices, as required under Section 5 of the GNU Affero General Public License version 3.

In accordance with Section 7(b) of the GNU Affero General Public License version 3, these Appropriate Legal Notices must retain the display of the SmartBreak logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo is not reasonably feasible for technical reasons, the Appropriate Legal Notices must display the words "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2022".
>>>>>>> 865f5af... New: Added Readme and Changelog
