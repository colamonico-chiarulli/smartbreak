<?php
/**
 * File:	\resources\views\pages\messages\_form.blade.php
 * @package smartbreak
 * @author  Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
 * @copyright	(c)2022 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Tuesday, November 22nd 2022, 5:03:31 pm
 * -----
 * Last Modified: 	November 22nd 2022 5:04:08 pm
 * Modified By: 	Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
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
<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('messages.index') }}" class="btn btn-info">Elenco messaggi</a>
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
                        <label for="message">Titolo *</label>
                        <input type="text" class="form-control @error('title')is-invalid @enderror" id="title"
                            name="title" maxlength="30" {{$readonly ?? '' }}
                            value="{{ $message->title ?? old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="summernote">Messaggio *</label>
                        <textarea class="form-control @error('message')is-invalid @enderror" rows="10" id="summernote"
                            name="message" placeholder="Messaggio da inviare" {{$readonly ?? ''}}>
                            @isset($message->message){{$message->message}}@endisset
                            @empty($message->message){{old('message')}}@endempty</textarea>
                    </div>

                    <div class=" form-group">
                        <label for="destination">Utenti destinatari *</label>
                        <select class="form-control @error('destination')is-invalid @enderror" id="destination"
                            name="destination" {{$readonly ?? '' }}>
                            <option value="">Seleziona un Ruolo </option>
                            <option value="ADMIN" 
                                @if($message->destination == "ADMIN")
                                selected="selected"
                                @endif
                                >Amministratori</option>
                            </option>
                            <option value="MANAGER" 
                                @if($message->destination == "MANAGER")
                                selected="selected"
                                @endif
                                >BAR Manager</option>
                            </option>
                            <option value="STUDENT" 
                                @if($message->destination == "STUDENT")
                                selected="selected"
                                @endif
                                >Studenti</option>
                            </option>
                        </select>
                    </div>
                </div>


                <div class="card-footer">
                    @empty($readonly)
                    <button type="submit" class="btn btn-primary">{{$button}}</button>
                    <button type="button" class="btn btn-info" onclick="preview()">Anteprima</button>
                    @endempty
                </div>
            </form>
        </div>
    </div>

</div>

@include('plugins.summernote')
