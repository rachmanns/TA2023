<?php

namespace App\Console\Commands;

use App\Models\Kategori;
use App\Models\ListUkp;
use App\Models\Personil;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class UkpCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ukp:cron';

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
            // $month_now = date('n');
            $personil = Personil::with('pangkat')->whereHas('pangkat', function (Builder $query) {
                $query->where('masa_kenkat', '<>', 0);
            })->whereHas('kategori', function (Builder $query) {
                $query->where('nama_kategori', Kategori::AKTIF);
            })->get();

            // $data=[];
            foreach ($personil as $key => $value) {
                $month = date('n', strtotime($value->tmt_pangkat_terakhir));

                if (in_array($month, range(5, 10))) {
                    $target_tmt_kenkat = date('Y-10-01', strtotime("+" . $value->pangkat->masa_kenkat . " years", strtotime($value->tmt_pangkat_terakhir)));
                    $periode = date('Y-04-d', strtotime($target_tmt_kenkat));
                } elseif (in_array($month, range(11, 12))) {
                    $target_tmt_kenkat = date('Y-04-01', strtotime("+" . $value->pangkat->masa_kenkat . " years", strtotime($value->tmt_pangkat_terakhir)));
                    $periode = date('Y-10-d', strtotime("-1 years", strtotime($target_tmt_kenkat)));
                } elseif (in_array($month, range(1, 4))) {
                    $target_tmt_kenkat = date('Y-04-01', strtotime("+" . $value->pangkat->masa_kenkat . " years", strtotime($value->tmt_pangkat_terakhir)));
                    $periode = date('Y-10-d', strtotime("-1 years", strtotime($target_tmt_kenkat)));
                }

                $list_ukp = ListUkp::create([
                    'periode' => $periode,
                    'id_personil' => $value->id_personil,
                    'pangkat_terakhir' => $value->nama_pangkat_terakhir,
                    'tmt_pangkat_terakhir' => $value->tmt_pangkat_terakhir,
                    'target_tmt_kenkat' => $target_tmt_kenkat
                ]);
            }
            Log::info("Generate UKP Success");
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
