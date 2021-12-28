<?php
/**
 * File:	/config/bugsnag.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Wednesday, May 09th 2021, 4:32:55 pm
 * -----
 * Last Modified: 	May 12th 2021 4:35:35 pm
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
<?php
return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | You can find your API key on your Bugsnag dashboard.
    |
    | This api key points the Bugsnag notifier to the project in your account
    | which should receive your application's uncaught exceptions.
    |
    */

    'api_key' => env('BUGSNAG_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | App Type
    |--------------------------------------------------------------------------
    |
    | Set the type of application executing the current code.
    |
    */

    'app_type' => env('BUGSNAG_APP_TYPE'),

    /*
    |--------------------------------------------------------------------------
    | App Version
    |--------------------------------------------------------------------------
    |
    | Set the version of application executing the current code.
    |
    */

    'app_version' => env('BUGSNAG_APP_VERSION'),

    /*
    |--------------------------------------------------------------------------
    | Batch Sending
    |--------------------------------------------------------------------------
    |
    | Set to true to send the errors through to Bugsnag when the PHP process
    | shuts down, in order to prevent your app waiting on HTTP requests.
    |
    | Setting this to false will send an HTTP request straight away for each
    | error.
    |
    */

    'batch_sending' => env('BUGSNAG_BATCH_SENDING'),

    /*
    |--------------------------------------------------------------------------
    | Endpoint
    |--------------------------------------------------------------------------
    |
    | Set what server the Bugsnag notifier should send errors to. By default
    | this is set to 'https://notify.bugsnag.com', but for Bugsnag Enterprise
    | this should be the URL to your Bugsnag instance.
    |
    */

    'endpoint' => env('BUGSNAG_ENDPOINT'),

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    |
    | Use this if you want to ensure you don't send sensitive data such as
    | passwords, and credit card numbers to our servers. Any keys which
    | contain these strings will be filtered.
    |
    | This option has been deprecated in favour of 'redacted_keys'
    |
    */

    'filters' => empty(env('BUGSNAG_FILTERS')) ? null : explode(',', str_replace(' ', '', env('BUGSNAG_FILTERS'))),

    /*
    |--------------------------------------------------------------------------
    | Hostname
    |--------------------------------------------------------------------------
    |
    | You can set the hostname of your server to something specific for you to
    | identify it by if needed.
    |
    */

    'hostname' => env('BUGSNAG_HOSTNAME'),

    /*
    |--------------------------------------------------------------------------
    | Proxy
    |--------------------------------------------------------------------------
    |
    | This is where you can set the proxy settings you'd like us to use when
    | communicating with Bugsnag when reporting errors.
    |
    */

    'proxy' => array_filter([
        'http' => env('HTTP_PROXY'),
        'https' => env('HTTPS_PROXY'),
        'no' => empty(env('NO_PROXY')) ? null : explode(',', str_replace(' ', '', env('NO_PROXY'))),
    ]),

    /*
    |--------------------------------------------------------------------------
    | Project Root
    |--------------------------------------------------------------------------
    |
    | Bugsnag marks stacktrace lines as in-project if they come from files
    | inside your “project root”. You can set this here.
    |
    | If this is not set, we will automatically try to detect it.
    |
    */

    'project_root' => env('BUGSNAG_PROJECT_ROOT'),

    /*
    |--------------------------------------------------------------------------
    | Project Root Regex
    |--------------------------------------------------------------------------
    |
    | Bugsnag marks stacktrace lines as in-project if they come from files
    | inside your “project root”. You can set this here.
    |
    | This option allows you to set it as a regular expression and will take
    | precedence over "project_root" if both are defined.
    |
    */

    'project_root_regex' => env('BUGSNAG_PROJECT_ROOT_REGEX'),

    /*
    |--------------------------------------------------------------------------
    | Strip Path
    |--------------------------------------------------------------------------
    |
    | The strip path is a path to be trimmed from the start of any filepaths in
    | your stacktraces.
    |
    | If this is not set, we will automatically try to detect it.
    |
    */

    'strip_path' => env('BUGSNAG_STRIP_PATH'),

    /*
    |--------------------------------------------------------------------------
    | Strip Path Regex
    |--------------------------------------------------------------------------
    |
    | The strip path is a path to be trimmed from the start of any filepaths in
    | your stacktraces.
    |
    | This option allows you to set it as a regular expression and will take
    | precedence over "strip_path" if both are defined.
    |
    */

    'strip_path_regex' => env('BUGSNAG_STRIP_PATH_REGEX'),

    /*
    |--------------------------------------------------------------------------
    | Query
    |--------------------------------------------------------------------------
    |
    | Enable this if you'd like us to automatically record all queries executed
    | as breadcrumbs.
    |
    */

    'query' => env('BUGSNAG_QUERY', true),

    /*
    |--------------------------------------------------------------------------
    | Bindings
    |--------------------------------------------------------------------------
    |
    | Enable this if you'd like us to include the query bindings in our query
    | breadcrumbs.
    |
    */

    'bindings' => env('BUGSNAG_QUERY_BINDINGS', false),

    /*
    |--------------------------------------------------------------------------
    | Release Stage
    |--------------------------------------------------------------------------
    |
    | Set the release stage to use when sending notifications to Bugsnag.
    |
    | Leaving this unset will default to using the application environment.
    |
    */

    'release_stage' => env('BUGSNAG_RELEASE_STAGE'),

    /*
    |--------------------------------------------------------------------------
    | Notify Release Stages
    |--------------------------------------------------------------------------
    |
    | Set which release stages should send notifications to Bugsnag.
    |
    */

    //'notify_release_stages' => empty(env('BUGSNAG_NOTIFY_RELEASE_STAGES')) ? null : explode(',', str_replace(' ', '', env('BUGSNAG_NOTIFY_RELEASE_STAGES'))),
    'notify_release_stages' => ['production'],
    /*
    |--------------------------------------------------------------------------
    | Send Code
    |--------------------------------------------------------------------------
    |
    | Bugsnag automatically sends a small snippet of the code that crashed to
    | help you diagnose even faster from within your dashboard. If you don’t
    | want to send this snippet, then set this to false.
    |
    */

    'send_code' => env('BUGSNAG_SEND_CODE', true),

    /*
    |--------------------------------------------------------------------------
    | Callbacks
    |--------------------------------------------------------------------------
    |
    | Enable this if you'd like us to enable our default set of notification
    | callbacks. These add things like the cookie information and session
    | details to the error to be sent to Bugsnag.
    |
    | If you'd like to add your own callbacks, you can call the
    | Bugsnag::registerCallback method from the boot method of your app
    | service provider.
    |
    */

    'callbacks' => env('BUGSNAG_CALLBACKS', true),

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    | Enable this if you'd like us to set the current user logged in via
    | Laravel's authentication system.
    |
    | If you'd like to add your own user resolver, you can do this by using
    | callbacks via Bugsnag::registerCallback.
    |
    */

    'user' => env('BUGSNAG_USER', true),

    /*
    |--------------------------------------------------------------------------
    | Logger Notify Level
    |--------------------------------------------------------------------------
    |
    | This sets the level at which a logged message will trigger a notification
    | to Bugsnag.  By default this level will be 'notice'.
    |
    | Must be one of the Psr\Log\LogLevel levels from the Psr specification.
    |
    */

    'logger_notify_level' => env('BUGSNAG_LOGGER_LEVEL'),

    /*
    |--------------------------------------------------------------------------
    | Auto Capture Sessions
    |--------------------------------------------------------------------------
    |
    | Enable this to start tracking sessions and deliver them to Bugsnag.
    |
    */

    'auto_capture_sessions' => env('BUGSNAG_CAPTURE_SESSIONS', false),

    /*
    |--------------------------------------------------------------------------
    | Sessions Endpoint
    |--------------------------------------------------------------------------
    |
    | Sets a url to send tracked sessions to.
    |
    */

    'session_endpoint' => env('BUGSNAG_SESSION_ENDPOINT'),

    /*
    |--------------------------------------------------------------------------
    | Builds Endpoint
    |--------------------------------------------------------------------------
    |
    | Sets a url to send build reports to.
    |
    */

    'build_endpoint' => env('BUGSNAG_BUILD_ENDPOINT'),

    /*
    |--------------------------------------------------------------------------
    | Discard Classes
    |--------------------------------------------------------------------------
    |
    | An array of classes that should not be sent to Bugsnag.
    |
    | This can contain both fully qualified class names and regular expressions.
    |
    */

    'discard_classes' => empty(env('BUGSNAG_DISCARD_CLASSES')) ? null : explode(',', env('BUGSNAG_DISCARD_CLASSES')),

    /*
    |--------------------------------------------------------------------------
    | Redacted Keys
    |--------------------------------------------------------------------------
    |
    | An array of metadata keys that should be redacted.
    |
    */

    'redacted_keys' => empty(env('BUGSNAG_REDACTED_KEYS')) ? null : explode(',', env('BUGSNAG_REDACTED_KEYS')),
];
