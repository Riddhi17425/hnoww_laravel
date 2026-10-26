<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->text('description');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->string('photo')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('1 = Active 0 = In-active');
            $table->timestamps();
        });

        // Default sample reviews
        $now = now();
        $samples = [
            ['Aisha Al Mansoori', 'Dubai', 'The Twin Columns arrived beautifully packaged and looks stunning on our dining table. Guests keep asking where it is from.', 5],
            ['Rahul Mehta', 'Abu Dhabi', 'Ordered a corporate gift for our partners and the feedback was incredible. Elegant, thoughtful and delivered right on time.', 5],
            ['Sara Khalid', 'Sharjah', 'A truly premium experience from checkout to unboxing. The craftsmanship feels special and the blessing card was a lovely touch.', 5],
            ['Emma Collins', 'Dubai', 'Bought a wedding gift here and the couple loved it. The team was helpful and the delivery was quick across Dubai.', 5],
            ['Omar Hassan', 'Ajman', 'Beautiful objects with real character. One piece took a little longer to arrive, but the quality made it worth the wait.', 4],
        ];
        foreach ($samples as [$name, $city, $description, $rating]) {
            DB::table('reviews')->insert([
                'name' => $name,
                'city' => $city,
                'description' => $description,
                'rating' => $rating,
                'photo' => null,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
