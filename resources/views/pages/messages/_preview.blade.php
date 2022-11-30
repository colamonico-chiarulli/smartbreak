<?php
/**
 * File:	/resources/views/pages/messages/_preview.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2022 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Tuesday, November 29th 2022, 5:02:45 pm
 * -----
 * Last Modified: 	November 29th 2022 5:02:45 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2022".
 * 
 * ------------------------------------------------------------------------------
 */

?>
@push('js')
<script>
function preview(){
    var title=$("#title").val();
    var msg=$("#summernote").val();
    Swal.fire({
        titleText: title,
        icon: 'info',
        html: '<div class="text-left">'+msg+'</div>',
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText:
            '<i class="fa fa-thumbs-up"></i> Ok!',
        confirmButtonAriaLabel: 'Ok!',
        confirmButtonColor: '#0277bd',
    });
}
</script>
@endpush