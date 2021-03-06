<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankLogoDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $logo = new Illuminate\Http\UploadedFile(
            storage_path('app/files/banks/logos/banco_sem_imagem.png'),
            env('BANK_LOGO_DEFAULT')
        );

        $name = env('BANK_LOGO_DEFAULT');
        $destFile = \CodeFin\Models\Bank::logosDir();

        \Storage::disk('public')->putFileAs($destFile, $logo, $name);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $file_name = env("BANK_LOGO_DEFAULT");
        $filePath = \CodeFin\Models\Bank::logosDir().'/'.$file_name;
        Storage::disk('public')->delete($filePath);
        echo "** Imagem $file_name deletada\n";
    }
}
