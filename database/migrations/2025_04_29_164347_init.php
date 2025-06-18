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
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("password");
            $table->string("username")->unique();
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();


            // Details
            $table->string("first_name");
            $table->string("last_name");
            $table->string("address");
            $table->string("email_alt");
            $table->string("phone");
            $table->string("profile_url");

            // Administrations
            $table->string("nik")->unique();
            $table->date("birth_of_date");
            $table->string("home_address");
            $table->string('ktp_url')->unique();
            $table->string('verification_key')->unique();
        });

        Schema::create("auction_schemes", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->jsonb("config");
            $table->string("description");
        });

        Schema::create("categories", function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });



        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string("name");
            $table->string("description");
            $table->integer("value_base");
            $table->integer("value_current");
            $table->string("status");

            $table->json('bucket_url');

            $table->unsignedBigInteger("schema_id");
            $table->unsignedBigInteger("seller_id");
            $table->unsignedBigInteger("category_id")->nullable();

            $table->foreign("schema_id")->references("id")
                ->on("auction_schemes")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("seller_id")->references('id')
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("category_id")->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->onDelete("set null")
            ;
        });


        Schema::create("disputes", function (Blueprint $table) {
            $table->id();
            $table->string("status", 10);
            $table->timestamps();
            $table->timestamp("opened_at")->useCurrent();
            $table->timestamp("closed_at")->nullable();
            $table->unsignedBigInteger("issuer_id");
            $table->unsignedBigInteger("moderator_id");
            $table->unsignedBigInteger("listing_id");

            $table->foreign("issuer_id")->references("id")
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("listing_id")->references("id")
                ->on("listings")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("moderator_id")->references("id")
                ->on("moderators")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });


        Schema::create("bids", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("index")->autoIncrement();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("listing_id");

            $table->foreign("user_id")->references("id")
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("listing_id")->references("id")
                ->on("listings")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });



        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer("amount");
            $table->string("status");
            $table->string("payment_method");
            $table->string("payment_provider");
            $table->jsonb("metadata");
            $table->string("provider_ref_id");

            $table->unsignedBigInteger("listing_id");
            $table->unsignedBigInteger("buyer_id");
            $table->unsignedBigInteger("seller_id");

            $table->foreign("listing_id")->references("id")
                ->on("listings")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("buyer_id")->references("id")
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("seller_id")->references("id")
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create("deliveries", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string("status");
            $table->jsonb("update")->nullable();
            $table->string("note_id")->nullable();

            $table->unsignedBigInteger("receiver_id");
            $table->unsignedBigInteger("listing_id");

            $table->foreign("receiver_id")->references("id")->on("users");
            $table->foreign("listing_id")->references("id")->on("listings");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("moderators");
        Schema::dropIfExists("users");
        Schema::dropIfExists("disputes");
        Schema::dropIfExists("bids");
        Schema::dropIfExists("auction_schemes");
        Schema::dropIfExists("categories");
        Schema::dropIfExists("listings");
        Schema::dropIfExists("transactions");
        Schema::dropIfExists("deliveries");
    }
};
