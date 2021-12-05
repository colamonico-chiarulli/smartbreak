<?php
/**
 * File:	/resources/views/pages/students/_form.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 26th, 2021 4:06pm
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
<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('students.index') }}" class="btn btn-info">Elenco Studenti</a>
        </div>
    </div>

    <div class="row">
        <div class="card w-100 shadow">
            <div class="card-header {{$headercolor ?? ''}}">
                <h3 class="card-title">{{$cardTitle}}</h3>
            </div>

            <form action="{{ $action }}" method="post">
                @csrf
                @isset ($method)
                @method($method)
                @endisset
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Attenzione!</strong> Verifica i dati inseriti.<br><br>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="first_name">Nome *</label>
                        <input type="text" class="form-control @error('first_name')is-invalid @enderror" id="first_name" name="first_name" placeholder="Inserisci il nome"
                               value="{{ $student->first_name ?? old('first_name') }}"
                               {{$readonly ?? ''}}>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Cognome *</label>
                        <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" placeholder="Inserisci il nome"
                               value="{{ $student->last_name ?? old('last_name') }}"
                               {{$readonly ?? ''}}>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email"
                               placeholder="Indirizzo email"
                               value="{{ $student->email ?? old('email') }}"
                               {{$readonly ?? ''}}>
                    </div>


                <div class="form-group">
                    <label for="class_id">Classe *</label>
                    <select class="form-control @error('class_id')is-invalid @enderror" id="class_id" name="class_id" {{$readonly ?? ''}}>
                        <option value="">Seleziona una classe </option>
                        
                        @foreach ($classes as $class)
                            <option value="{{$class->id}}" {{ isset($student) && $class->id == $student->class_id ? 'selected' : '' }} >
                                {{ $class->name }}
                            </option>
                        @endforeach

                    </select>

                </div>

                </div>
                <div class="card-footer">
                    @empty($readonly)
                    <button type="submit" class="btn btn-primary">{{$button}}</button>
                    @endempty
                </div>
            </form>
        </div>

    </div>
</div>
