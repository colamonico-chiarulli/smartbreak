<?php
/**
 * File:	/resources/views/pages/products/_form.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February, 2nd 2021 11:05pm
 * -----
 * Last Modified: 	April 3rd 2021 12:13:51 pm
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
            <a href="{{ route('products.index') }}" class="btn btn-info">Elenco prodotti</a>
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome *</label>
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="name"
                                    name="name" placeholder="Inserisci un nome"
                                    value="{{ $product->name ?? old('name') }}" {{$readonly ?? ''}}>
                            </div>

                            <div class=" form-group">
                                <label for="description">Descrizione *</label>
                                <textarea class="form-control @error('description')is-invalid @enderror"
                                    id="description" name="description"
                                    placeholder="Inserisci una descrizione o gli ingredienti"
                                    {{$readonly ?? ''}}>{{ $product->description ?? old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Prezzo *</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="0.01"
                                        class="form-control @error('price')is-invalid @enderror" id="price" name="price"
                                        placeholder="Inserisci il prezzo" value="{{ $product->price ?? old('price') }}"
                                        {{$readonly ?? ''}}>
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="allergens">Allergeni</label>
                                <input type="text" class="form-control @error('allergens')is-invalid @enderror"
                                    id="allergens" name="allergens" placeholder="Inserisci eventuali allergeni"
                                    value="{{ $product->allergens ?? old('allergens') }}" {{$readonly ?? ''}}>
                            </div>

                        </div>
                        <div class="col-md-6">

                            @if(isset($product) && $product->getFirstMediaUrl('product_photo'))
                            <div class="text-center">
                                <img src="{{ $product->getFirstMediaUrl('product_photo') }}" alt="" style="max-height:250px;">
                            </div>
                            @endif

                            @if(!isset($readonly) or !$readonly)
                            <div class="form-group">
                                <label for="photo_path">Foto prodotto*</label>
                                <input type="file" id="photo" name="photo">
                            </div>
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num_items">Quantità disponibile *</label>
                                <input type="number" min="0"
                                    class="form-control @error('num_items')is-invalid @enderror" id="num_items"
                                    name="num_items" placeholder="Inserisci la quantità disponibile"
                                    value="{{ $product->num_items ?? old('num_items') }}" {{$readonly ?? ''}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="default_daily_stock">Disponibilità quotidiana</label>
                                <input type="number" min="0"
                                    class="form-control @error('default_daily_stock')is-invalid @enderror"
                                    id="default_daily_stock" name="default_daily_stock"
                                    placeholder="Inserisci la disponibilità quotidiana"
                                    value="{{ $product->default_daily_stock ?? old('default_daily_stock') }}"
                                    {{$readonly ?? ''}}>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="category_id">Categoria *</label>
                        <select class="form-control @error('category_id')is-invalid @enderror" id="category_id"
                            name="category_id" {{$readonly ?? ''}}>
                            <option value="">Seleziona una categoria</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ isset($product) && $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    @can('is-admin')
                    <div class="form-group">
                        <label for="site_id">Sede *</label>
                        <select class="form-control @error('site_id')is-invalid @enderror" id="site_id" name="site_id"
                            {{$readonly ?? ''}}>
                            <option value="">Seleziona una sede</option>
                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}"
                                {{ isset($product) && ($site->id == $product->site_id) ? 'selected' : '' }}>
                                {{ $site->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endcan


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

@include('plugins.filepond')
@push('js')
<script>
    const pond = FilePond.create(document.getElementById('photo'));
</script>
@endpush
