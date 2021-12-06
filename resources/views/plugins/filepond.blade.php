<?php
/**
 * File:	/resources/views/plugins/filepond.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 19th, 2021 10:11pm
 * -----
 * Last Modified:
 * Modified By:
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
@push('css')
    <!-- Filepond stylesheet -->
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
  <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">


@endpush

@push('js')

  <!-- Load FilePond library -->
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
  <script src="https://unpkg.com/filepond/dist/filepond.js"></script>



  <!-- Turn all file input elements into ponds -->
  <script>

    const labels = {
        labelIdle: 'Trascina e rilascia i tuoi file oppure <span class = "filepond--label-action"> Carica <span>',
        labelInvalidField: "Il campo contiene dei file non validi",
        labelFileWaitingForSize: "Aspettando le dimensioni",
        labelFileSizeNotAvailable: "Dimensioni non disponibili",
        labelFileLoading: "Caricamento",
        labelFileLoadError: "Errore durante il caricamento",
        labelFileProcessing: "Caricamento",
        labelFileProcessingComplete: "Caricamento completato",
        labelFileProcessingAborted: "Caricamento cancellato",
        labelFileProcessingError: "Errore durante il caricamento",
        labelFileProcessingRevertError: "Errore durante il ripristino",
        labelFileRemoveError: "Errore durante l'eliminazione",
        labelTapToCancel: "tocca per cancellare",
        labelTapToRetry: "tocca per riprovare",
        labelTapToUndo: "tocca per ripristinare",
        labelButtonRemoveItem: "Elimina",
        labelButtonAbortItemLoad: "Cancella",
        labelButtonRetryItemLoad: "Ritenta",
        labelButtonAbortItemProcessing: "Camcella",
        labelButtonUndoItemProcessing: "Indietro",
        labelButtonRetryItemProcessing: "Ritenta",
        labelButtonProcessItem: "Carica",
        labelMaxFileSizeExceeded: "Il peso del file è eccessivo",
        labelMaxFileSize: "Il peso massimo del file è {filesize}",
        labelMaxTotalFileSizeExceeded: "Dimensione totale massima superata",
        labelMaxTotalFileSize: "La dimensione massima totale del file è {filesize}",
        labelFileTypeNotAllowed: "File non supportato",
        fileValidateTypeLabelExpectedTypes: "Aspetta {allButLastType} o {lastType}",
        imageValidateSizeLabelFormatError: "Tipo di immagine non compatibile",
        imageValidateSizeLabelImageSizeTooSmall: "L'immagine è troppo piccola",
        imageValidateSizeLabelImageSizeTooBig: "L'immagine è troppo grande",
        imageValidateSizeLabelExpectedMinSize: "La dimensione minima è {minWidth} × {minHeight}",
        imageValidateSizeLabelExpectedMaxSize: "La dimensione massima è {maxWidth} × {maxHeight}",
        imageValidateSizeLabelImageResolutionTooLow: "La risoluzione è troppo bassa",
        imageValidateSizeLabelImageResolutionTooHigh: "La risoluzione è troppo alta",
        imageValidateSizeLabelExpectedMinResolution: "La risoluzione minima è {minResolution}",
        imageValidateSizeLabelExpectedMaxResolution: "La risoluzione massima è {maxResolution}",
    };

    FilePond.setOptions({
        ...labels,
        server: {
            url: '/upload-file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }
    })

    FilePond.registerPlugin(
        FilePondPluginImagePreview
    );
  </script>

@endpush
