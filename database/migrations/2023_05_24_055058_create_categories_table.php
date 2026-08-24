<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('category_url')->nullable();
            $table->string('magic_heading_first')->nullable();
            $table->string('magic_heading_second')->nullable();
            $table->string('magic_title')->nullable();
            $table->string('magic_image')->nullable();
            $table->string('magic_description', 500)->nullable();

            // Celebration Section
            $table->string('celebration_label')->nullable();
            $table->string('celebration_title')->nullable();
            $table->text('celebration_description')->nullable();
            $table->string('celebration_image')->nullable();

            // Collection Section
            $table->string('collection_label')->nullable();
            $table->string('collection_title')->nullable();
            $table->text('collection_description')->nullable();

            // FAQs
            $table->json('faqs')->nullable();

            $table->tinyInteger('category_type')->default(0)->comment("0 = Basic 1 = Corporate 2 = Wedding");
            $table->tinyInteger('is_festive')->default(0)->comment("0 = Collection 1 = Festive");
            $table->tinyInteger('is_inquiry')->default(0)->comment('0 = View Detail, 1 = Inquire Now');
            $table->string('button_text', 500)->nullable();
            $table->tinyInteger('is_active')->default(1)->comment("0 = Active 1 = In-active");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
