<!--
 * File: /INSTALL.md
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2024 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	June 4th, 2024 12:58:03
 * -----
-->
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/colamonico-chiarulli/smartbreak/blob/master/public/img/logos/logo.svg" width="400"></a></p>

<div align="center"> 

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/colamonico-chiarulli/smartbreak)  ![GitHub top language](https://img.shields.io/github/languages/top/colamonico-chiarulli/smartbreak) ![languages](https://img.shields.io/github/languages/count/colamonico-chiarulli/smartbreak) ![Project Forks](https://img.shields.io/github/forks/colamonico-chiarulli/smartbreak?style=social)  ![GitHub Release Date](https://img.shields.io/github/release-date/colamonico-chiarulli/smartbreak) ![license](https://img.shields.io/badge/License-AGPLv3.0-green)

</div>


> ## SmartBreak INSTALL
>*Ordina la tua merenda al bar della scuola con un click!*

> ### Prerequisiti
1) **Web server**: Essendo un'applicazione web è necessario un **Web Server** (Es. Apache), il linguaggio **PHP 8.x**, e **Un DBMS server** (Es. MySql Server).\
Per Windows esistono meta-pacchetti, tipo [**XAMPP**](https://www.apachefriends.org/it/index.html), che racchiudono tutto ciò che è necessario allo sviluppo web in PHP/MySQl 
2) **Composer** è un gestore di pacchetti per il linguaggio di programmazione PHP, che fornisce un formato standard per la gestione delle dipendenze dei progetti PHP e delle librerie richieste
3) **Git**: se volete contribuire allo sviluppo di SmartBreak. È un software di controllo di versione distribuito, per la sviluppo di software attraverso la scrittura collaborativa di codice sorgente 
> ### 1) Download e prima installazione del codice sorgente

* Da terminale posizionarsi nella cartella pubblica del webserver (HTDOCS di XAMPP, public_html per linux)
           
* Scaricare il codice sorgente di smartBreak
  ```
  git clone https://github.com/colamonico-chiarulli/smartbreak.git
  ```
        
* Entrare nella cartella smartbreak
  ```   
  cd smartbreak
  ```       
* Aggiornare le dipendenze (librerie PHP utilizzate)
  ```   
  composer update
      
  composer dump-autoload
  ```   

>### 2) Creazione Database
Da terminale con il CLI MySQL, dal browser con PHPMyAdmin o altri strumenti creare un database MySQL **smartbreak**
    
>### 3) Configurazione ambiente
* Aprire il codice sorgente di SmartBreak
    
* Nella cartella principale **creare una copia** del file **.env.example** e rinominarla **.env**
    
* Modificare il file **.env** appena creato personalizzando:
  * **i dati della scuola**
  * **la connessione con MySQL** (o altro DBMS)
  * **L'URL dell'App** \
    APP\_URL=http://localhost:8000 (per un'escuzione)

> ### 4.  Creazione di un'application key per Laravel
Eseguire nel Terminale, nella cartella di SmartBreak
```
php artisan key:generate
```
Verrà generata una stringa casuale di 32 caratteri e copiata nel file **.env** utilizzata per rendere sicure le vs connessioni
        

> ### 5) Creazione Tabelle e Popolamento Database
-------------------------------------------
Eseguire nel Terminale, nella cartella di SmartBreak, i seguenti comandi per la migrazione e popolamento del DB:
```
php artisan migrate (Crea le Tabelle nel DB)
```
```
php artisan storage:link (Serve per attivare la cartella public)
```
>  Solo se si desidera popolare il DataBase di SmartBreak **con dati a caso**, eseguire il comando:
> 
>  ```        
>  php artisan db:seed (Riempie le tabelle con dati a caso)
>  ```        
>Verranno creati:
>* 2 sedi (Colamonico, Chiarulli)
>* 46 classi (distribuite nelle 2 sedi)
>* 4 utenti
>  * admin@smartbreak.it -> AdminPassword >(**amministratore**)
>  * manager1@smartbreak.it -> ManagerPassword (**bar >Manager Colamonico**)
>  * manager2@smartbreak.it -> ManagerPassword (**bar >Manager Chiarulli**)
>  * student@smartbreak.it -> StudentPassword (**studente**)
>* da 5 a 10 studenti a caso per ogni classe
>* 7 categorie di prodotti
>* Prodotti per entrambi i bar delle 2 sedi. **N.B. Le >immagini non sono fornite**
>* Da 10 a 50 Ordini negli ultimi 2 mesi

> ### 6) Test dell'applicazione
-------------------------

* Per avviare un webserver che punta direttamente alla vostra applicazione Laravel, eseguire nel terminale:
  ```
  php artisan serve
  ```   
*   Aprire il browser alla pagina
    
    *   [http://localhost:8000](http://localhost:8000)
        
