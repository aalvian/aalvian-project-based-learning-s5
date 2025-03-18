<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        $role_admin = Role::updateOrCreate(['name' => 'admin']);
        $role_anggota = Role::updateOrCreate(['name' => 'anggota']);
        $role_pengurus = Role::updateOrCreate(['name' => 'pengurus']);

        // Buat permission jika belum ada
        $permissions = [
            'view_dashboard',
            'manage_divisi',
            'manage_jadwal',
            'manage_pengurus',
            'manage_alat',
            'manage_timeline',
            'manage_pendaftar',
            'transaksi',
            'manage_presensi',
            'view_anggota',
            'view_jadwal',
            'presensi'
        ];

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(['name' => $perm]);
        }

        // Assign permission ke role
        $role_admin->syncPermissions(['view_dashboard', 'manage_divisi', 'manage_jadwal', 'manage_pengurus', 'manage_alat', 'manage_timeline']);
        $role_pengurus->syncPermissions(['view_dashboard', 'manage_pendaftar', 'transaksi', 'manage_presensi']);
        $role_anggota->syncPermissions(['view_anggota', 'view_jadwal', 'presensi']);

        // Assign role ke user
        $user = User::find(1);
        $user->assignRole('admin', 'pengurus','anggota');
    }
}
