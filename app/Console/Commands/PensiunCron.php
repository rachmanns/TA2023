<?php

namespace App\Console\Commands;

use App\Models\ConfigModel;
use App\Models\Kategori;
use App\Models\Personil;
use App\Models\RiwayatKategori;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PensiunCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pensiun:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $kategori = Kategori::get();
            $personil = Personil::with('pangkat')->whereHas(
                'kategori',
                function ($query) {
                    $query->where('nama_kategori', Kategori::AKTIF);
                }
            )->get();
            // $config = ConfigModel::first();
            // $pensiun = [];
            foreach ($personil as $key => $value) {
                $age = Carbon::parse($value->tgl_lahir)->age;
                $usia_pensiun = $value->pangkat->usia_pensiun;

                // switch (strtolower($value->pangkat->jenis_pangkat)) {
                //     case 'bintara':
                //         $usia_pensiun = $config->pensiun_bintara;
                //         break;
                //     case 'tamtama':
                //         $usia_pensiun = $config->pensiun_tamtama;
                //         break;
                //     case 'perwira':
                //         $usia_pensiun = $config->pensiun_perwira;
                //         break;
                //     case 'pns':
                //         $usia_pensiun = $config->pensiun_pns;
                //         break;
                //     default:
                //         $pensiun = [];
                //         break;
                // }

                if ($age >= $usia_pensiun) {
                    $tgl_lahir = date('m-d', strtotime($value->tgl_lahir));
                    $id_kategori = $kategori->where('nama_kategori', Kategori::PENSIUN)->first()->id_kategori;

                    Personil::where('id_personil', $value->id_personil)->update(['id_kategori' => $id_kategori]);

                    RiwayatKategori::create([
                        'id_kategori' => $id_kategori,
                        'id_personil' => $value->id_personil,
                        'tmt_kategori' => date('Y-' . $tgl_lahir)
                    ]);
                }
            }
            Log::info("Update Pensiun Success");
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
