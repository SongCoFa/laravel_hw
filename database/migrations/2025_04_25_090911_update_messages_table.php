<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 檢查資料表是否存在
        if (!Schema::hasTable('messages')) {
            // 資料表不存在，建立新資料表
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->string('username_from', 20);
                $table->string('username_to', 20);
                $table->text('content')->nullable();
                $table->string('title')->nullable();
                $table->string('userid_from', 50);
                $table->string('userid_to', 50);
                $table->timestamps(); // 會自動建立 created_at 和 updated_at
            });
        } else {
            // 資料表已經存在，更新欄位
            Schema::table('messages', function (Blueprint $table) {
                // 在這裡你可以對資料表進行欄位修改
                // 例如，如果需要新增某個欄位
                if (!Schema::hasColumn('messages', 'userid_to')) {
                    $table->string('userid_to', 50)->nullable(false);
                } else {
                    $table->string('userid_to', 50)->nullable(false)->change();
                }
                if (!Schema::hasColumn('messages', 'userid_from')) {
                    $table->string('userid_from', 50)->nullable(false);
                } else {
                    $table->string('userid_from', 50)->nullable(false)->change();
                }

                // 其他欄位修改或新增邏輯
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'userid_to')) {
                $table->dropColumn('userid_to');
            }
            if (Schema::hasColumn('messages', 'userid_from')) {
                $table->dropColumn('userid_from');
            }
        });
    }
}
