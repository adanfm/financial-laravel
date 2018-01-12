<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use CodeFin\Repositories\BankRepository;

class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var \CodeFin\Repositories\BankRepository $repository */
        $repository = app(\CodeFin\Repositories\BankRepository::class);
        foreach ($this->getData() as $bank) {
            $repository->create($bank);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /** @var BankRepository $repository */
        $repository = app(BankRepository::class);
        $repository->skipPresenter(true);
        $count = count($this->getData());
        foreach (range(1,$count) as $id) {
            $bank = $repository->find($id);
            $path = \CodeFin\Models\Bank::logosDir() . '/' . $bank->logo;
            Storage::disk('public')->delete($path);
            echo "** Imagem do '$bank->name' deletada: " . $bank->logo . "\n";
            $bank->delete();
        }
    }

    public function getData()
    {
        return [
            [
                'name' => 'Bradesco',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/bradesco.JPG'),
                    'bradesco.JPG'
                )
            ],
            [
                'name' => 'Banco do Brasil',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/brasil.gif'),
                    'brasil.gif'
                )
            ],
            [
                'name' => 'Caixa',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/caixa.png'),
                    'caixa.png'
                )
            ],
            [
                'name' => 'Itaú',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/itau.jpg'),
                    'itau.jpg'
                )
            ],
            [
                'name' => 'Santander',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/santander.png'),
                    'santander.png'
                )
            ],
        ];
    }
}
