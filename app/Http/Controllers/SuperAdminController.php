<?php

namespace App\Http\Controllers;

use App\Models\Superadmin;
use App\Models\Admin;
use App\Models\User;
use App\Models\Activity;
use App\Models\Study;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        // Statistik dasar
        $totalUsers = User::count();
        $totalAdmins = Admin::count();
        $totalSuperadmins = Superadmin::count();
        
        // Statistik hari ini
        $today = Carbon::today();
        $newUsersToday = User::whereDate('created_at', $today)->count();
        $activeAdmins = Admin::where('status', 'active')->count();
        $todayActivities = Activity::whereDate('created_at', $today)->count();
        
        // Perbandingan dengan hari kemarin
        $yesterdayActivities = Activity::whereDate('created_at', $today->copy()->subDay())->count();
        $percentageChange = $yesterdayActivities > 0 
            ? round((($todayActivities - $yesterdayActivities) / $yesterdayActivities) * 100)
            : 100;

        // Data untuk grafik
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[] = Activity::whereDate('created_at', $date)->count();
        }

        // Aktivitas terbaru
        $recentActivities = Activity::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($activity) {
                $activity->type_color = $this->getActivityColor($activity->type);
                $activity->icon = $this->getActivityIcon($activity->type);
                return $activity;
            });

        // Masalah sistem
        $systemIssues = 0; // Implementasikan sesuai kebutuhan
        $unresolvedIssues = 0; // Implementasikan sesuai kebutuhan

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalSuperadmins',
            'newUsersToday',
            'activeAdmins',
            'todayActivities',
            'percentageChange',
            'chartLabels',
            'chartData',
            'recentActivities',
            'systemIssues',
            'unresolvedIssues'
        ));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10);
        $admins = Admin::latest()->paginate(10);
        $superadmins = Superadmin::latest()->paginate(10);

        return view('superadmin.users', compact('users', 'admins', 'superadmins'));
    }

    public function settings()
    {
        $superadmin = Auth::guard('superadmin')->user();
        return view('superadmin.settings', compact('superadmin'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:superadmins,email,' . Auth::guard('superadmin')->id(),
            'phone' => 'nullable|string|max:20',
        ]);

        $superadmin = Auth::guard('superadmin')->user();
        Superadmin::where('id', $superadmin->id)->update($request->only(['name', 'email', 'phone']));

        // Log activity
        Activity::create([
            'user_id' => $superadmin->id,
            'type' => 'profile_update',
            'description' => 'Memperbarui profil'
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $superadmin = Auth::guard('superadmin')->user();

        if (!Hash::check($request->current_password, $superadmin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        Superadmin::where('id', $superadmin->id)->update([
            'password' => Hash::make($request->password),
        ]);

        // Log activity
        Activity::create([
            'user_id' => $superadmin->id,
            'type' => 'password_update',
            'description' => 'Memperbarui password'
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui');
    }

    public function updateNotifications(Request $request)
    {
        $superadmin = Auth::guard('superadmin')->user();
        // Implementasikan logika update notifikasi
        return redirect()->back()->with('success', 'Pengaturan notifikasi berhasil diperbarui');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $model = null;
        $actor = Auth::guard('superadmin')->user();
        
        // Cek apakah ID ada di tabel admin
        if ($admin = Admin::find($id)) {
            $model = $admin;
            $targetType = 'admin';
        } 
        // Jika tidak ada di admin, cek di users
        elseif ($user = User::find($id)) {
            $model = $user;
            $targetType = 'user';
        }

        if (!$model) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $oldStatus = $model->status;
        $model->update([
            'status' => $request->status
        ]);

        // Log activity dengan detail lebih lengkap
        Activity::create([
            'user_id' => $actor->id,
            'type' => 'status_update',
            'description' => sprintf(
                'Mengubah status %s %s dari %s menjadi %s',
                $targetType,
                $model->name,
                $oldStatus,
                $request->status
            )
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:admins,email|unique:superadmins,email',
            'password' => 'required|string|min:8',
            'type' => 'required|in:user,admin',
        ]);

        $actor = Auth::guard('superadmin')->user();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ];

        if ($request->type === 'admin') {
            $model = Admin::create($data);
            $type = 'admin';
        } else {
            $model = User::create($data);
            $type = 'user';
        }

        // Log activity
        Activity::create([
            'user_id' => $actor->id,
            'type' => 'create_user',
            'description' => "Membuat {$type} baru: {$model->name}"
        ]);

        return redirect()->back()->with('success', ucfirst($type) . ' berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'type' => 'required|in:user,admin',
        ]);

        $actor = Auth::guard('superadmin')->user();
        $model = null;
        $type = $request->type;

        if ($type === 'admin') {
            $model = Admin::find($id);
            // Validasi email unik kecuali untuk admin ini sendiri
            if ($model && $model->email !== $request->email) {
                $request->validate([
                    'email' => 'unique:admins,email|unique:users,email|unique:superadmins,email',
                ]);
            }
        } else {
            $model = User::find($id);
            // Validasi email unik kecuali untuk user ini sendiri
            if ($model && $model->email !== $request->email) {
                $request->validate([
                    'email' => 'unique:users,email|unique:admins,email|unique:superadmins,email',
                ]);
            }
        }

        if (!$model) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $model->update($data);

        // Log activity
        Activity::create([
            'user_id' => $actor->id,
            'type' => 'update_user',
            'description' => "Memperbarui {$type}: {$model->name}"
        ]);

        return redirect()->back()->with('success', ucfirst($type) . ' berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:user,admin',
        ]);

        $actor = Auth::guard('superadmin')->user();
        $type = $request->type;
        $model = null;

        if ($type === 'admin') {
            $model = Admin::find($id);
        } else {
            $model = User::find($id);
        }

        if (!$model) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $name = $model->name;
        $model->delete();

        // Log activity
        Activity::create([
            'user_id' => $actor->id,
            'type' => 'delete_user',
            'description' => "Menghapus {$type}: {$name}"
        ]);

        return redirect()->back()->with('success', ucfirst($type) . ' berhasil dihapus');
    }

    public function nilai()
    {
        $nilai = Value::with('user')->latest()->paginate(10);
        $siswa = User::all();
        $studys = Study::all();
        $totalNilai = Value::count();
        // $averageNilai = Value::avg('value');
        $todayInputs = Value::whereDate('created_at', today())->count();

        return view('superadmin.nilai', compact('nilai', 'siswa', 'studys',  'totalNilai', 'todayInputs'));
    }

    private function getActivityColor($type)
    {
        return [
            'login' => 'blue',
            'profile_update' => 'green',
            'password_update' => 'yellow',
            'system_update' => 'purple',
            'status_update' => 'orange',
        ][$type] ?? 'gray';
    }

    private function getActivityIcon($type)
    {
        return [
            'login' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>',
            'profile_update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
            'password_update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>',
            'system_update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>',
            'status_update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ][$type] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
    }
} 