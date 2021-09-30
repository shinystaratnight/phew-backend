<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use App\Algorithm\MathCalcOrder;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['permissions_count'] = \App\Models\Role::where('id', '>' , 1)->count();
        $this->data['admins_count'] = User::where(['type' => 'admin'])->count();

        $this->data['last_ten_unseen_contacts'] = \App\Models\Contact::where('read_at', null)->latest()->take(10)->get();

        $this->data['clients_count'] = User::where(['type' => 'client'])->count();
        $this->data['last_ten_clients'] = User::where(['type' => 'client'])->latest()->take(10)->get();

         $this->data['posts_count'] = \App\Models\Post::count();
         $this->data['today_posts_count'] = \App\Models\Post::where('created_at', 'LIKE', date('Y-m-d') . '%')->count();

        $this->data['countries_count'] = \App\Models\Country::count();
        $this->data['cities_count'] = \App\Models\City::count();

        $this->data['contacts_count'] = \App\Models\Contact::where('read_at', null)->count();

        $this->data['movies'] = \App\Models\Movie::latest('counter')->take(20)->get();

        $client_active_analytics = User::where(['type' => 'client'])->active()->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $client_deactive_analytics = User::where(['type' => 'client'])->where(['is_active' => false])->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $client_blocked_analytics = User::where(['type' => 'client'])->where(['is_banned' => true])->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $posts_analytics = \App\Models\Post::get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });

        // $online_users = online_users();
        // dd($online_users);
        // dd($online_users->contains('id', 5));

        for ($i = 0; $i <= 12; $i++) {
            if (isset($client_active_analytics[now()->subMonths($i)->format('Y-m')])) {
                $this->data['client_active_analytics'][now()->subMonths($i)->format('Y-m')] = $client_active_analytics[now()->subMonths($i)->format('Y-m')]->count();
            } else {
                $this->data['client_active_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
            }
            if (isset($client_deactive_analytics[now()->subMonths($i)->format('Y-m')])) {
                $this->data['client_deactive_analytics'][now()->subMonths($i)->format('Y-m')] = $client_deactive_analytics[now()->subMonths($i)->format('Y-m')]->count();
            } else {
                $this->data['client_deactive_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
            }
            if (isset($client_blocked_analytics[now()->subMonths($i)->format('Y-m')])) {
                $this->data['client_blocked_analytics'][now()->subMonths($i)->format('Y-m')] = $client_blocked_analytics[now()->subMonths($i)->format('Y-m')]->count();
            } else {
                $this->data['client_blocked_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
            }
            if (isset($posts_analytics[now()->subMonths($i)->format('Y-m')])) {
                $this->data['posts_analytics'][now()->subMonths($i)->format('Y-m')] = $posts_analytics[now()->subMonths($i)->format('Y-m')]->count();
            } else {
                $this->data['posts_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
            }
        }
        return view('dashboard.home.index', $this->data);
    }
}
