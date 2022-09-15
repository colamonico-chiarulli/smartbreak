<?php
/**
 * File:	/resources/views/pages/homepage/index.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	June 30th, 2021 10:54am
 * -----
 * Last Modified: 	February 3rd 2022 7:31:39 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application
 * developed during the PON course "The AppFactory" 2020-2021 with teachers
 * & students of "Informatica e Telecomunicazioni"
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 *
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 *
 * ------------------------------------------------------------------------------
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SmartBreak - IISS Colamonico Chiarulli Acquaviva delle Fonti (BA)</title>
  <meta content="WebApp per prenotazioni al Bar della scuola" name="description">
  <meta content="smartbreak" name="keywords">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Analytics -->
  @includeIf('partials._gtag')

    <!-- Favicons -->
  <link rel="icon" href="{{  asset('img/logos/icon.svg') }}">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing-assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('landing-assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landing-assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('landing-assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landing-assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landing-assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="landing-assets/css/style.min.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a href="/"><img src="img/logos/logo.svg" alt="Smartbreak logo" class="img-fluid"></a>
        <h5 style="margin-left:60px"><a href="https://colamonicochiarulli.edu.it">IISS Colamonico Chiarulli</a></h5>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#features">Funzionalità</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="https://sites.google.com/colamonicochiarulli.edu.it/guida-smartbreak">Supporto</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div
          class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1"
          data-aos="fade-up">
          <div>
            <h1>SmartBreak</h1>
            <h2>Ordina la tua merenda al BAR della scuola con un click!</h2>

            <a class="download-btn mt-2" href="{{ route('login.google') }}">
              <i class="bi bi-google"></i> Accesso studenti
            </a>
            <a class="download-btn mt-2" href="{{ route('home') }}">
              <i class="bi bi-person-circle"></i> Accesso admin
            </a>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
          data-aos="fade-up">
          <img src="{{ asset('landing-assets/img/smartbreak-hero.jpg')}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= App Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title">
          <h2>Funzionalità App</h2>
          <p>SmartBreak è un'applicazione web progettata e realizzata
            con gli studenti <br> dell’indirizzo di
            <a target="_blank"
              href="https://colamonicochiarulli.edu.it/istituto/carta-identita/indirizzi-studio/istruzione-tecnica-tecnologica/tecnologico-colamonico/indirizzo-informatica-telecomunicazioni.html"><i>Informatica
                e Telecomunicazioni</i></a>,
            nell’ambito del PON <a
              href="https://colamonicochiarulli.edu.it/didattica/area-comune/pon-fesr/pon-2014-2020/pon-app-factory.html"
              target="_blank">“The App Factory”</a> nell'a.s. 2020-21
          </p>
        </div>

        <div class="row no-gutters">
          <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-cart"></i>
                  <h4>Ordina con un click!</h4>
                  <p>Accedi velocemente ai prodotti disponibili</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-cookie"></i>
                  <h4>Scopri cosa ti piace di più</h4>
                  <p>I prodotti sono raggruppati per categoria e sono indicati gli allergeni</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-receipt"></i>
                  <h4>Compilazione automatica lista ordini</h4>
                  <p>Gli studenti accedono alla lista ordini della propria classe</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-list-check"></i>
                  <h4>Controlla lo stato dell’ordine</h4>
                  <p>Verifica quando l'ordine è stato preparato</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-bar-chart-alt-2"></i>
                  <h4>Monitora le tue spese</h4>
                  <p>Statistiche dei tuoi ordini</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                  <i class="bx bx-calendar"></i>
                  <h4>Cronologia</h4>
                  <p>Elenco degli ordini effettuati</p>
                </div>
              </div>
            </div>
          </div>
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2"
            data-aos="fade-left" data-aos-delay="100">
            <img src="{{ asset('landing-assets/img/app-features.jpg')}}" class="img-fluid"
              alt="Caratteristiche di Smartbreak">
          </div>
        </div>

      </div>
    </section><!-- End App Features Section -->

    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="{{ asset('landing-assets/img/student-details.jpg')}}" class="img-fluid"
              alt="Funzionalità Studente">
          </div>
          <div class="col-md-8 pt-2" data-aos="fade-up">
            <h3>Funzionalità per lo studente</h3>
            <p class="fst-italic">
              Puoi ordinare ogni giorno scolastico <b>dalle 7:00 alle 9:10</b>
            </p>
            <ul>
              <li><i class="bi bi-lightning-charge"></i> <b>Accesso rapido</b><br> Accedi ora con il tuo account
                istituzionale.</li>
              <li><i class="bi bi-check"></i> <b>Catalogo prodotti</b><br> Scegli i tuoi prodotti e conferma l’ordine.</li>
              <li><i class="bi bi-graph-up"></i> <b>Statistiche</b><br> Monitora le tue spese settimanali, mensili ed
                annuali.</li>
            </ul>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="{{ asset('landing-assets/img/manager-details2.jpg')}}" class="img-fluid"
              alt="Funzionalità Bar Manager">
          </div>
          <div class="col-md-8 pt-2 order-2 order-md-1" data-aos="fade-up">
            <h3>Funzionalità per il Bar Manager</h3>
            <p class="fst-italic">
              Pannello di Controllo per il Bar Manager.
            </p>
            <ul>
              <li><i class="bi bi-gear"></i></i> <b>Gestisci prodotti e categorie</b><br> Aggiungi modifica e rimuovi
                le categorie e i prodotti.</li>
              <li><i class="bi bi-clock-history"></i> <b>Imposta lo stato degli ordini</b><br> Scegli quali ordini hai
                preparato e comunica se sono incompleti.</li>
              <li><i class="bi bi-collection"></i> <b>Gestisci velocemente le giacenze</b><br> Gestisci i prodotti in
                magazzino e le loro disponibilità</li>
              <li><i class="bi bi-arrow-clockwise"></i> <b>Disponibilità giornaliere</b><br> Imposta una quantità
                disponibile automaticamente ogni giorno per i tuoi prodotti</li>
              <li><i class="bi bi-graph-up"></i> <b>Visualizza l'andamento delle vendite</b><br> Osserva come procedono
                le vendite dei prodotti attraverso grafici aggiornati in tempo reale</li>
            </ul>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="{{ asset('landing-assets/img/admin-details.jpg')}}" class="img-fluid"
              alt="Funzionalità Amministratore">
          </div>
          <div class="col-md-8 pt-2" data-aos="fade-up">
            <h3>Funzionalità per l'Amministratore</h3>
            <p>Queste sono le funzionalità a disposizione dell'Amministratore della scuola.</p>
            <ul>
              <li><i class="bi bi-person-check"></i> <b>Gestisci gli utenti</b><br> Aggiungi, rimuovi e modifica gli
                utenti.</li>
              <li><i class="bi bi-people"></i> <b>Gestisci le sedi, classi e gli studenti</b><br> Aggiungi, rimuovi e
                modifica gli
                le sedi, le classi e gli studenti</li>
              <li><i class="bi bi-file-arrow-up"></i> <b>Importa utenti</b><br> Importa velocemente gli utenti da file
                CSV</li>
              <li><i class="bx bx-bar-chart"></i> <b>Visualizza le statistiche sull'utilizzo dell'applicazione</b><br>
                Osserva il numero di studenti che utilizzano l'applicazione attraverso grafici aggiornati in tempo
                reale.</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Gallery</h2>
          <p>Ecco alcune schermate della nostra applicazione.</p>
        </div>

      </div>

      <div class="container-fluid" data-aos="fade-up">
        <div class="gallery-slider swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/elenco_categorie.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/elenco_categorie.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/elenco_prodotti.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/elenco_prodotti.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/menu_utente.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/menu_utente.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/riepilogo_ordine.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/riepilogo_ordine.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/user-orders.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/user-orders.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/class-orders.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/class-orders.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/user-stat01.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/user-stat01.png')}}" class="img-fluid" alt=""></a>
            </div>
            <div class="swiper-slide"><a href="{{ asset('landing-assets/img/gallery/user-stat02.png')}}"
                class="gallery-lightbox" data-gall="gallery-carousel">
                <img src="{{ asset('landing-assets/img/gallery/user-stat02.png')}}" class="img-fluid" alt=""></a>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Testimonials Section ======= 
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Recensioni</h2>
          <p>Recensioni utenti</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Anthony Liuzzi</h3>
                <h4>Founder</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Mi trovo molto bene con quest'app, eseguo gli ordini facilmente senza riscontrare problemi.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="landing-assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Claudio Montenegro</h3>
                <h4>Founder</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Quest'app mi permette di fare ordini rapidamente, inoltre informa che tipo di allergeni ci sono
                  all'interno di ogni prodotto.Insomma l'app perfetta!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="landing-assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Costantino Tassielli</h3>
                <h4>Founder</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Quest'app è fantastica, una vera bomba! Ti permette di vedere l'andamento delle vendite, i tuoi ordini
                  totali e... tanto altro!!Cosa aspetti!? Installala ora e testala subito!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="landing-assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Fabio Caccavone</h3>
                <h4>Founder</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  ...
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="landing-assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>Nicola Sergio</h3>
                <h4>Founder</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa
                  labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>Giuseppe Giorgio</h3>
                <h4>Founder</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  ...
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    End Testimonials Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container"  data-aos="fade-up">

        <div class="section-title">
          <h2>FAQ</h2>
          <p>Domande frequenti</p>
        </div>

        <div class="accordion-list">
          <ul>
            <li>
              <i class="bx bx-help-circle icon-help"></i>
              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-1" class="collapsed">
                Posso fare ordini a qualsiasi ora?
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-1" class="collapse" data-bs-parent=".accordion-list">
                <p>
                  No, gli ordini possono essere effettuati <b>dalle ore 7:00 alle 9:10</b> di ogni giorno scolastico.
                </p>
              </div>
            </li>

            <li>
              <i class="bx bx-help-circle icon-help"></i>
              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed">
                Come posso ritirare il mio ordine?
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                <p>
                  Il personale ATA consegnerà l'ordine nelle classi.
                </p>
              </div>
            </li>

            <li>
              <i class="bx bx-help-circle icon-help"></i>
              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed">
                Come avviene il pagamento?
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                <p>
                  Per il pagamento, si procederà come al solito, anticipando i soldi nella busta destinata al gestore
                  del BAR <b>alla fine della prima ora</b>, con l’indicazione della classe e del totale.
                </p>
              </div>
            </li>

            <li>
              <i class="bx bx-help-circle icon-help"></i>
              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-4" class="collapsed">
                Come si accede?
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-4" class="collapse" data-bs-parent=".accordion-list">
                <p>
                  Possono accedere solamente gli studenti con il proprio account istituzionale.
                </p>
              </div>
            </li>

            <li>
              <i class="bx bx-help-circle icon-help"></i>
              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-5" class="collapsed">
                Sono obbligato ad usare SmartBreak? <i class="bx bx-chevron-down icon-show"></i><i
                  class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-5" class="collapse" data-bs-parent=".accordion-list">
                <p>
                  L’utilizzo dell’App non è né obbligatorio, né esclusivo, si può sempre utilizzare l’ordine cartaceo
                  (ad esempio, in caso di difficoltà di accesso al servizio web).
                </p>
              </div>
            </li>

            <li>
              <i class="bx bx-help-circle icon-help"></i>
              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-6" class="collapsed">
                Ho difficoltà ad accedere come studente. Cosa posso fare? <i class="bx bx-chevron-down icon-show"></i><i
                  class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-6" class="collapse" data-bs-parent=".accordion-list">
                <p>
                  In caso di difficoltà di accesso si consiglia di <a style="display: inline" class="m-0 p-0" href="https://sites.google.com/colamonicochiarulli.edu.it/guida-smartbreak/supporto-accesso" target="_blank">
                    <b>cancellare la cronologia</b></a> del browser o <b>uscire da tutti gli account Google</b> e riprovare <br>
                    - Sul dispositivo, apri una pagina Google, ad esempio www.google.com <br>
                    - In alto a destra, seleziona la tua iniziale o l'immagine del tuo profilo. <br>
                    - Nel menu, scegli <b>Esci</b> o <b>Esci da tutti gli account.</b>
                </p>
              </div>
            </li>
          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>SmartBreak</h3>
            <p>
              <a href="https://colamonicochiarulli.edu.it" target="_blank">IISS Colamonico Chiarulli </a><br>
              Via C. Colamonico, n. 5 <br>
              70021 - Acquaviva delle Fonti (BA)<br>
              Italia <br><br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links</h4>
              <i class="bx bx-chevron-right"></i> <a href="{{ url('/credits') }}">Credits</a><br>
              <i class="bx bx-chevron-right"></i> <a href="{{ url('/privacy') }}">Privacy</a><br>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>I nostri Social</h4>
            <p>Rimani aggiornato grazie ai nostri canali social.</p>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/IISS-Colamonico-Chiarulli-625046681002397" class="facebook"><i
                  class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com/istitutocolamonicochiarulli/" class="instagram"><i
                  class="bx bxl-instagram"></i></a>
              <a href="https://www.youtube.com/c/IISSCColamonicoNChiarulliAcquavivadelleFonti" class="google-plus"><i
                  class="bx bxl-youtube"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span><a href="https://www.colamonicochiarulli.edu.it/">IISS Colamonico
              Chiarulli</a></span></strong>. All Rights Reserved
      </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="landing-assets/vendor/aos/aos.js"></script>
  <script src="landing-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landing-assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="landing-assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="landing-assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="landing-assets/js/main.js"></script>

</body>

</html>