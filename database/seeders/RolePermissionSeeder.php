<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Meja
        Permission::create(['name' => 'tambah-meja']);
        Permission::create(['name' => 'edit-meja']);
        Permission::create(['name' => 'view-meja']);
        //Barang
        Permission::create(['name' => 'tambah-stock']);
        Permission::create(['name' => 'view-stock']);
        Permission::create(['name' => 'edit-stock']);
        //Order | transakasi
        Permission::create(['name' => 'ViewEdit-pesanan']);
        Permission::create(['name' => 'ViewEdit-transaksi']);
        //laporan
        Permission::create(['name' => 'ViewEdit-laporan']);
        //Roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'waiter']);
        Role::create(['name' => 'kasir']);
        Role::create(['name' => 'owner']);
        Role::create(['name'=>'pelanggan']);
        //Role Admin
        // $roleAdmin = Role::findByName('admin');
        // $roleAdmin->givePermissionTo('tambah-meja');
        // $roleAdmin->givePermissionTo('view-meja');
        // $roleAdmin->givePermissionTo('edit-meja');
        // $roleAdmin->givePermissionTo('tambah-stock');
        // $roleAdmin->givePermissionTo('edit-stock');
        // $roleAdmin->givePermissionTo('view-stock');
        // $roleAdmin->givePermissionTo('ViewEdit-transaksi');
        // $roleAdmin->givePermissionTo('ViewEdit-pesanan');
        // $roleAdmin->givePermissionTo('ViewEdit-laporan');

        //RoleWaiter
        // $roleWaiter = Role::findByName('waiter');
        // $roleWaiter->givePermissionTo('edit-meja');
        // $roleWaiter->givePermissionTo('view-stock');
        // $roleWaiter->givePermissionTo('ViewEdit-pesanan');
        // $roleAdmin->givePermissionTo('ViewEdit-laporan');


        //RoleKasir
        // $roleKasir = Role::findByName('kasir');
        // $roleKasir->givePermissionTo('ViewEdit-pesanan');
        // $roleKasir->givePermissionTo('ViewEdit-laporan');


        //RoloOwner
        // $roleOwner = Role::findByName('owner');
        // $roleOwner->givePermissionTo('ViewEdit-laporan');

    }
}
