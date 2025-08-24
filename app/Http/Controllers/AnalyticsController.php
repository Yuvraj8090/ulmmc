<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Users with expired last_service_date
        $usersWithServiceAlert = User::whereDate('last_service_date', '<=', now())->get();

        // Total Users
        $totalUsers = User::count();

        // Active sessions in last 30 minutes
        $activeSessions = DB::table('sessions')
            ->where('last_activity', '>', now()->subMinutes(30)->timestamp)
            ->count();

        // Visitor data
        $visitorData = DB::table('sessions')
            ->select('ip_address', 'user_agent', 'last_activity')
            ->get()
            ->map(function ($visitor) {
                $visitor->location = $this->getLocationByIp($visitor->ip_address);
                return $visitor;
            });

        // Daily traffic stats
        $dailyTraffic = DB::table('sessions')
            ->select(DB::raw('DATE(FROM_UNIXTIME(last_activity)) as date'), DB::raw('COUNT(*) as session_count'))
            ->groupBy(DB::raw('DATE(FROM_UNIXTIME(last_activity))'))
            ->get();

        // Pass alert to the view if there are expired users
        $alert = $usersWithServiceAlert->count() > 0
            ? 'Some users have expired service dates!'
            : null;

        return view('dashboard', compact(
            'totalUsers',
            'activeSessions',
            'visitorData',
            'dailyTraffic',
            'alert',
            'usersWithServiceAlert'
        ));
    }

    private function getLocationByIp($ip)
    {
        $url = "http://ip-api.com/json/{$ip}";

        $response = @file_get_contents($url);
        if (!$response) {
            return ['city' => 'Unknown', 'region' => 'Unknown', 'country' => 'Unknown'];
        }

        $data = json_decode($response, true);
        if (!isset($data['status']) || $data['status'] === 'fail') {
            return ['city' => 'Unknown', 'region' => 'Unknown', 'country' => 'Unknown'];
        }

        return [
            'city' => $data['city'],
            'region' => $data['regionName'],
            'country' => $data['country'],
        ];
    }
}
