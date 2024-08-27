<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name'=>'userone',
            'email'=>'userone@a.com',
            'password'=>Hash::make('password'),
            'image'=>"user.png",
            'phone'=>'09685816237',
            'address'=>'Address'
        ]);
        Admin::create([
            'name'=>'Admin',
            'email'=>'admin@a.com',
            'password'=>Hash::make('password')
        ]);

        //category
        $category=['T shirt','Hat','Electronic','Mobile','Earphone'];
        foreach($category as $c){
            Category::create([
                'slug'=>Str::slug($c),
                'name'=>$c,
                'mm_name'=>"mm",
                'image'=>'category.webp'
            ]);
        }

        $brand=['Samsung','Huawei','Apple'];
        foreach($brand as $c){
            Brand::create([
                'slug'=>Str::slug($c),
                'name'=>$c
            ]);
        }

        $color=['red','green','blue','black'];
        foreach($color as $c){
            Color::create([
                'slug'=>Str::slug($c),
                'name'=>$c
            ]);
        }

        Supplier::create([
            'name'=>'Mg Mg',
            'image'=>'supplier.png'
        ]);
    }
}
