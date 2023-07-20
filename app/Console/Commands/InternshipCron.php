<?php

namespace App\Console\Commands;

use App\Models\Internship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InternshipCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'internship:cron';

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
            $internship = Internship::whereNull('tgl_selesai')->get();
            $date_now = date('Y-m-d');
            foreach ($internship as $key => $value) {
                $date_selesai = date('Y-m-d', strtotime('+1 year', strtotime($value->tgl_mulai)));
                if ($date_now >= $date_selesai) $internship[$key]->update(['tgl_selesai' => $date_selesai]);
            }
            Log::info("Internship Success");
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
