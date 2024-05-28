<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::create([
            'email' => 'captainvyom@google.com',
            'name' => 'Vyom Srivastava',
            'password' => bcrypt('admin@1234')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::delete()->where('email', '=', 'captainvyom@google.com');
    }
};
