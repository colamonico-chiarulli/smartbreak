<?php

/**
 * File:	\app\Http\Controllers\HomeController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	November 23rd 2022 5:37:47 pm
 * Modified By: 	Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
 * -----
 * * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2022-11-23	F. Caccavone	Check if there's a new message for users
 * 2021-04-26	R. Andriano	    Home for Bar managers
 * 2021-02-21	G. Ciriello     Gate improvements
 * 2020-12-15	G. Ciriello     Init project	
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\MessageUsers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $role = auth()->user()->role;
        $userid = auth()->user()->id;

        //get all new messages for user (from latest to oldest)
        $message = Message::where('destination', $role)
            ->whereDoesntHave('messageUsers', function ($query) use ($userid) {
                $query->where('user_id', $userid);
            })->latest()->get();

        //if there are message they are marked as read into message_users table
        if (!$message->isEmpty()) {
            $message->each(function ($msg) use ($userid) {
                MessageUsers::create([
                    'message_id' => $msg['id'],
                    'user_id' => $userid,
                ]);
            });

            // and latest message is send to SweetAlert trough session 
            $msg = $message->first()->only(['title', 'message']);

            $request->session()->flash('title',$msg['title']);
            $request->session()->flash('msg', json_encode($msg['message']));
        }

        if (Gate::check('is-manager')) {
            $route = 'products.by-day';
        } elseif (Gate::check('is-student')) {
            $route = 'cart.choose-products';
        } elseif (Gate::check('is-admin')) {
            $route = 'analytics';
        } else {
            abort(403);
        }

        return redirect()->route($route);
    }
}
