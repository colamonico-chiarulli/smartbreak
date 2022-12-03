<?php
/**
 * File:	/resources/views/pages/users/import.blade.php
 * @package smartbreak
 * @author  Costantino Tassielli <costantino.tassielli.inf@colamonicochiarulli.edu.it>
 * @copyright	(c)2022 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Saturday, December 3rd 2022, 10:34:17 am
 * -----
 * Last Modified: 	December 17th 2022 10:07:50 am
 * Modified By: 	Costantino Tassielli <costantino.tassielli.inf@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2022-12-17	C. Tassielli	Added sample file CSV 
 *              A. Liuzzi
 * 2021-05-18	R. Andriano     Import CSV School-Classes & Students
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
 * You should have received a copy of the resources/views/pages/users/import.blade.phpGNU Affero General Public License along 
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
@extends('layouts.app', ['title' => 'Importazione studenti'])

@section('content')
<div class="container">

    <div class="card bg-light mt-3">
        <div class="card-header">
            Importazione STUDENTI da file CSV
        </div>

        <div class="card-body">
            <form action="{{ route('users.import-csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <p>Il file csv degli studenti deve avere i seguenti campi:first_name,last_name,email,class_id,site_id</p>
                    <a href="{{asset('download/student-sample.csv')}}" target="_blank" rel="nofollow noopener noreferrer" title="Download sample csv ">Scarica CSV studenti di esempio</a>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file" onchange="$('#upload-file-info').html(this.files[0].name)">
                      <label class="custom-file-label" id="upload-file-info" for="customFile">Scegli il file</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">Importa</button>
            </form>
        </div>
    </div>

</div>
@endsection