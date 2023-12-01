<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name'=>'Scriza','prefix'=>'SCZ'],
            ['name'=>'Addone','prefix'=>'AON'],
        ];
        foreach($companies as $com){
            $company = new Company;
            $company->name = $com['name'];
            $company->prefix = $com['prefix'];
            $company->save();
        }
    }
}
