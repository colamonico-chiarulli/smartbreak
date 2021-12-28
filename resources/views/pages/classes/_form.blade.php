<?php
/**
 * File:	/resources/views/pages/classes/_form.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 18th, 2021 7:30pm
 * -----
 * Last Modified: 	March 27th, 2021 7:46pm)
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
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
            <a href="{{ route('classes.index') }}" class="btn btn-info">Elenco classi</a>
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
                        <label for="year">Anno *</label>
                        <input type="number" min=1 max=5 class="form-control @error('year')is-invalid @enderror" id="year" name="year"
                            placeholder="1..5" 
                               value="{{ $class->year ?? old('year') }}"
                               {{$readonly ?? ''}}>
                    </div>

                    <div class=" form-group">
                        <label for="section">Sezione *</label>
                        <input type="text" class="form-control @error('section')is-invalid @enderror" id="section" name="section"
                            placeholder="Inserire la sezione (Es. A)" 
                            value="{{ $class->section ?? old('section') }}"
                            {{$readonly ?? ''}}>
                    </div>

                    <div class="form-group">
                        <label for="course">Indirizzo *</label>
                        <input type="text" class="form-control @error('course')is-invalid @enderror" id="course" name="course"
                               placeholder="Indirizzo di studio - 3 caratteri Es. INF" 
                               value="{{ $class->course ?? old('course') }}"
                               {{$readonly ?? ''}}>
                    </div>


                    <div class="form-group">
                        <label for="site_id">Sede *</label>
                        <select class="form-control @error('site_id')is-invalid @enderror" id="site_id" name="site_id" {{$readonly ?? ''}}>
                            <option value="">Seleziona una sede</option>
                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}"
                                    @if($site->id == $formSite)
                                selected="selected"
                                @endif
                                >{{ $site->name }}</option>
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
