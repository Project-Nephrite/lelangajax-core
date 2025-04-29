<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("moderators", function (Blueprint $table) {

            $table->id();
            $table->string("display_name")->unique();
        });

        Schema::create("user_headers", function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("password");
            $table->string("username")->unique();
            
            $table->timestamps();
            $table->softDeletes();
       });

       Schema::create("user_administrations", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string("nik")->unique();
            $table->date("birth_of_date");
            $table->string("home_address");
            $table->string('ktp_url')->unique();
            $table->string('verification_key')->unique();


    });

       Schema::create("user_details", function (Blueprint $table) {
        $table->id();
        $table->string("first_name");
        $table->string("last_name");
        $table->string("address");
        $table->string("email_alt");
        $table->string("phone");
        $table->string("profile_url");

        $table->foreignId('user_id')
            ->constrained('user_headers')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        $table->foreignId("user_administration")
        ->constrained("user_administrations")
        ->onUpdate('cascade')
        ->onDelete('cascade');

        $table->timestamps();
        $table->softDeletes();
       });


        Schema::create("disputes", function (Blueprint $table)        {
            $table->id();
            $table->string("status", 10);
            $table->timestamp("opened_at");
            $table->timestamp("closed_at");
            $table->unsignedBigInteger("issuer_id");
            $table->unsignedBigInteger("moderator_id");
            $table->unsignedBigInteger("listing_id");

            // TODO determine the table reference
            $table->foreign("issuer_id")->references("id")->on("");
            $table->foreign("listing_id")->references("id")->on("");

            $table->foreign("moderator_id")->references("id")->on("moderators");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
