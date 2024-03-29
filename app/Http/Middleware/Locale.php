<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use App;
use App\Models\Preference;
use Auth;
use Cache;
use App\Models\Language;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $langData = Preference::getAll()->where('field', 'dflt_lang')->first()->value;

        if (!empty(Auth::user()->id) && isset(Auth::guard('user')->user()->id) && Cache::get(config('cache.prefix') . '-user-language-'. Auth::guard('user')->user()->id)) {
            $langData = Cache::get(config('cache.prefix') . '-user-language-'. Auth::guard('user')->user()->id);
        }
        if (isset(Auth::user()->id) && Cache::get(config('cache.prefix') . '-admin-language-'. Auth::user()->id)) {
            $langData = Cache::get(config('cache.prefix') . '-admin-language-'. Auth::user()->id);
        }
        if (!auth()->user()) {
            $langData = Cache::get(config('cache.prefix') . '-guest-language-'. request()->server('HTTP_USER_AGENT'));
        }
        $language = Language::where(['short_name' => $langData, 'status' => 'Active'])->get();

        if (empty($language) || count($language) == 0) {
            $language = Language::where(['is_default' => '1', 'status' => 'Active'])->get();
            $langData = $language->first()->short_name;
        }

        if (!empty($language) && count($language) > 0) {
            App::setLocale($langData);
            $direction = !empty($language[0]['direction']) ? $language[0]['direction'] : 'ltr';
            Cache::put(config('cache.prefix') . '-language-direction', $direction, 600);
        } else {
            $langData = 'en';
            App::setLocale($langData);
            Cache::put(config('cache.prefix') . '-language-direction', 'ltr', 600);
        }

        return $next($request);
    }
}
