<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('state_codes', function (Blueprint $table) {
            $table->id();
            $table->string('state_name');
            $table->string('gstin_code', 2);
            $table->string('state_code', 2);
            $table->timestamps();
        });

        // Insert initial state data
        DB::table('state_codes')->insert([
            ['state_name' => 'ANDAMAN AND NICOBAR ISLANDS', 'gstin_code' => '35', 'state_code' => 'AN'],
            ['state_name' => 'ANDHRA PRADESH', 'gstin_code' => '28', 'state_code' => 'AP'],
            ['state_name' => 'ANDHRA PRADESH (NEW)', 'gstin_code' => '37', 'state_code' => 'AD'],
            ['state_name' => 'ARUNACHAL PRADESH', 'gstin_code' => '12', 'state_code' => 'AR'],
            ['state_name' => 'ASSAM', 'gstin_code' => '18', 'state_code' => 'AS'],
            ['state_name' => 'BIHAR', 'gstin_code' => '10', 'state_code' => 'BH'],
            ['state_name' => 'CHANDIGARH', 'gstin_code' => '04', 'state_code' => 'CH'],
            ['state_name' => 'CHATTISGARH', 'gstin_code' => '22', 'state_code' => 'CT'],
            ['state_name' => 'DADRA AND NAGAR HAVELI', 'gstin_code' => '26', 'state_code' => 'DN'],
            ['state_name' => 'DAMAN AND DIU', 'gstin_code' => '25', 'state_code' => 'DD'],
            ['state_name' => 'DELHI', 'gstin_code' => '07', 'state_code' => 'DL'],
            ['state_name' => 'GOA', 'gstin_code' => '30', 'state_code' => 'GA'],
            ['state_name' => 'GUJARAT', 'gstin_code' => '24', 'state_code' => 'GJ'],
            ['state_name' => 'HARYANA', 'gstin_code' => '06', 'state_code' => 'HR'],
            ['state_name' => 'HIMACHAL PRADESH', 'gstin_code' => '02', 'state_code' => 'HP'],
            ['state_name' => 'JAMMU AND KASHMIR', 'gstin_code' => '01', 'state_code' => 'JK'],
            ['state_name' => 'JHARKHAND', 'gstin_code' => '20', 'state_code' => 'JH'],
            ['state_name' => 'KARNATAKA', 'gstin_code' => '29', 'state_code' => 'KA'],
            ['state_name' => 'KERALA', 'gstin_code' => '32', 'state_code' => 'KL'],
            ['state_name' => 'LAKSHADWEEP ISLANDS', 'gstin_code' => '31', 'state_code' => 'LD'],
            ['state_name' => 'MADHYA PRADESH', 'gstin_code' => '23', 'state_code' => 'MP'],
            ['state_name' => 'MAHARASHTRA', 'gstin_code' => '27', 'state_code' => 'MH'],
            ['state_name' => 'MANIPUR', 'gstin_code' => '14', 'state_code' => 'MN'],
            ['state_name' => 'MEGHALAYA', 'gstin_code' => '17', 'state_code' => 'ME'],
            ['state_name' => 'MIZORAM', 'gstin_code' => '15', 'state_code' => 'MI'],
            ['state_name' => 'NAGALAND', 'gstin_code' => '13', 'state_code' => 'NL'],
            ['state_name' => 'ODISHA', 'gstin_code' => '21', 'state_code' => 'OR'],
            ['state_name' => 'PONDICHERRY', 'gstin_code' => '34', 'state_code' => 'PY'],
            ['state_name' => 'PUNJAB', 'gstin_code' => '03', 'state_code' => 'PB'],
            ['state_name' => 'RAJASTHAN', 'gstin_code' => '08', 'state_code' => 'RJ'],
            ['state_name' => 'SIKKIM', 'gstin_code' => '11', 'state_code' => 'SK'],
            ['state_name' => 'TAMIL NADU', 'gstin_code' => '33', 'state_code' => 'TN'],
            ['state_name' => 'TELANGANA', 'gstin_code' => '36', 'state_code' => 'TS'],
            ['state_name' => 'TRIPURA', 'gstin_code' => '16', 'state_code' => 'TR'],
            ['state_name' => 'UTTAR PRADESH', 'gstin_code' => '09', 'state_code' => 'UP'],
            ['state_name' => 'UTTARAKHAND', 'gstin_code' => '05', 'state_code' => 'UT'],
            ['state_name' => 'WEST BENGAL', 'gstin_code' => '19', 'state_code' => 'WB'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_codes');
    }
};
