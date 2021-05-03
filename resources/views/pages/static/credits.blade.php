<?php
/**
 * File:	/resources/views/pages/static/credits.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Monday, May 3rd 2021, 7:23:41 pm
 * -----
 * Last Modified: 	May 3rd 2021 8:03:07 pm
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
@extends('layouts.app', ['title' => 'Credits'])

@section('content')
<h2>SmartBreak</h2>
<p>
è un'applicazione web per la gestione delle ordinazioni al Bar della scuola
sviluppata durante il corso PON "The AppFactory" tra dicembre 2020 e aprile 2021, con insegnanti e studenti dell'indirizzo "Informatica e Telecomunicazioni" 
presso l'IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
Esperto dr. <a target="_blank" href="https://giovanniciriello.github.io/">Giovanni Ciriello</a> - giovanni.ciriello.5@gmail.com
</p>
<h2>Licenza</h2>
<p>
SmartBreak is free software; you can redistribute it and/or modify it under
the terms of the <a target="_blank" href="https://www.gnu.org/licenses/agpl-3.0.html">GNU Affero General Public License version 3</a> as published by
the Free Software Foundation<br>
</p>
<p>
SmartBreak is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
details.</p>
<p>
<p>
The interactive user interfaces in original and modified versions
of this program must display Appropriate Legal Notices, as required under
Section 5 of the GNU Affero General Public License version 3.
</p>
<p>
In accordance with Section 7(b) of the GNU Affero General Public License version 3,
these Appropriate Legal Notices must retain the display of the SmartBreak
logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
is not reasonably feasible for technical reasons, the Appropriate Legal Notices 
must display the words
"(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - {{ date('Y')}}".
</p>

<h2>Sviluppatori</h2>
<ul>
   <li>Giovanni Ciriello - giovanni.ciriello.5@gmail.com</li> 
   <li>Rino Andriano - andriano@colamonicochiarulli.it</li> 
</ul>

<h2>Beta tester e documentazione</h2>
<ul>
<li>Fabio Caccavone - fabio.caccavone.inf@colamonicochiarulli.it</li> 
<li>Giuseppe Giorgio - giuseppe.giorgio.inf@colamonicochiarulli.it</li> 
<li>Nicola Sergio - nicola.sergio.inf@colamonicochiarulli.it</li> 
</ul>
@endsection