<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $dataPegawai = [];
        $dataAdminOpd = [];
        $title = 'Dashboard';
        switch ($filter) {
            case 'daily':
                $dataPegawai = Pegawai::whereDate('created_at', Carbon::today())->get();
                $dataAdminOpd = User::where('role', 'Admin OPD')->whereDate('created_at', Carbon::today())->get();
                $dataSuperAdmin = User::where('role', 'Super Admin')->whereDate('created_at', Carbon::today())->get();
                break;
            case 'weekly':
                $startOfWeek = Carbon::now()->startOfWeek();
                $endOfWeek = Carbon::now()->endOfWeek();
                $dataPegawai = Pegawai::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
                $dataAdminOpd = User::where('role', 'Admin OPD')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
                $dataSuperAdmin = User::where('role', 'Super Admin')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
                break;
            case 'monthly':
                $dataPegawai = Pegawai::whereMonth('created_at', Carbon::now()->month)->get();
                $dataAdminOpd = User::where('role', 'Admin OPD')->whereMonth('created_at', Carbon::now()->month)->get();
                $dataSuperAdmin = User::where('role', 'Super Admin')->whereMonth('created_at', Carbon::now()->month)->get();
                break;
            default:
                $dataPegawai = Pegawai::all();
                $dataAdminOpd = User::where(function ($query) {
                    $query->where('role', 'Operator Rumah Sakit')->orWhere('role', 'Operator Puskesmas');
                })->get();
                $dataSuperAdmin = User::where('role', 'Super Admin')->get();
                break;
        }
        return view('back_office.dashboard', compact('dataPegawai', 'title', 'dataAdminOpd', 'dataSuperAdmin'));
    }
}
