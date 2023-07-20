<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Models\ConfigModel;
use App\Models\Kategori;
use App\Models\ListUkp;
use App\Models\Matra;
use App\Models\Pangkat;
use App\Models\Personil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPersonilController extends Controller
{
    public function index()
    {

        $kategori_aktif = Kategori::where('nama_kategori', Kategori::AKTIF)->first()->id_kategori;
        $jumlah_perwira = $this->chart_perwira($kategori_aktif);
        $active_menu = 'dashboard_personil';
        $riil = Personil::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->count();
        $dsp = ConfigModel::sum('var_dsp');
        $pie_dsp = [
            'RIIL' => $riil,
            'DSP' => $dsp
        ];

        $pns = Personil::whereHas(
            'korps',
            function ($query) {
                $query->where('kode_matra', 'PNS');
            }
        )->whereHas('kategori', function ($query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->count();

        $query_tni = Personil::with('korps')->whereHas(
            'korps',
            function ($query) {
                $query->where('kode_matra', '!=', 'PNS');
            }
        )->whereHas('kategori', function ($query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->get();

        $personil_tni = [];
        foreach ($query_tni as $key => $value) {
            $kode_matra = $value->korps->kode_matra;
            if (isset($personil_tni[$kode_matra])) {
                $personil_tni[$kode_matra]++;
            } else {
                $personil_tni[$kode_matra] = 1;
            }
        }

        $tni = $query_tni->count();

        $personil_riil = [
            'TNI' => $tni,
            'PNS' => $pns
        ];

        $pangkat = Pangkat::select('id_pangkat', 'nama_pangkat')->where('jenis_pangkat', 'like', 'Perwira%')->get();

        $pangkat_perwira = [];

        foreach ($pangkat as $key => $value) {
            array_push($pangkat_perwira, $value->nama_pangkat);
        }

        $month_now = date('n');
        $year_ukp = date('Y');
        $month_ukp = 4;

        if (in_array($month_now, range(5, 10))) {
            $month_ukp = 10;
        } elseif (in_array($month_now, range(11, 12))) {
            $year_ukp = date('Y', strtotime("+1 years"));
        }

        $date_ukp_kenkat = Carbon::parse($year_ukp . '-' . $month_ukp)->locale('id')->isoFormat('MMMM YYYY');

        $jumlah_ukp = ListUkp::whereNull('status')->whereMonth('periode', $month_ukp)->whereYear('periode', $year_ukp)->count();
        $jumlah_kenkat = ListUkp::whereNull('status')->whereMonth('target_tmt_kenkat', $month_ukp)->whereYear('target_tmt_kenkat', $year_ukp)->count();
        $birthday = Personil::with('pangkat')->whereMonth('tgl_lahir', date('m'))->whereHas(
            'kategori',
            function ($query) {
                $query->where('nama_kategori', Kategori::AKTIF);
            }
        )->get();

        $config = ConfigModel::first();
        $pensiun = [];
        foreach ($birthday as $key => $value) {
            $month_year_birthday = date('Y-m', strtotime($value->tgl_lahir));
            $age = Carbon::parse($month_year_birthday)->age;

            switch (strtolower($value->pangkat->jenis_pangkat)) {
                case 'bintara':
                    $usia_pensiun = $config->pensiun_bintara;
                    break;
                case 'tamtama':
                    $usia_pensiun = $config->pensiun_tamtama;
                    break;
                case 'perwira':
                    $usia_pensiun = $config->pensiun_perwira;
                    break;
                case 'pns':
                    $usia_pensiun = $config->pensiun_pns;
                    break;
                default:
                    $pensiun = [];
                    break;
            }

            if ($age >= $usia_pensiun) {
                $pensiun[] = $value->nama;
            }
        }
        $pensiun = count($pensiun);

        $birthday = $birthday->count();
        $bar_dsp = $this->bar_dsp();

        return view('bidum.personil.dashboard_personil', compact('active_menu', 'pie_dsp', 'personil_riil', 'personil_tni', 'pangkat_perwira', 'jumlah_ukp', 'jumlah_kenkat', 'birthday', 'pensiun', 'jumlah_perwira', 'date_ukp_kenkat', 'bar_dsp'));
    }

    public function chart_perwira($kategori_aktif)
    {
        $personil = Personil::with('korps')->where('id_kategori', $kategori_aktif)->get();
        $pangkat = Pangkat::where('jenis_pangkat', 'like', 'Perwira%')->get();
        $matra = Matra::whereIn('kode_matra', ['AD', 'AL', 'AU'])->get();
        // return $personil;
        $data = [];
        foreach ($pangkat as $key => $value) {
            foreach ($matra as $k => $v) {
                // $data[$v->kode_matra]['pangkat'] = 'TNI ' . $v->kode_matra;
                $data[$v->kode_matra][] = $personil->where('id_pangkat_terakhir', $value->id_pangkat)->where('korps.kode_matra', $v->kode_matra)->count();
                // $data[$v->kode_matra][$value->nama_pangkat] = $personil->where('id_pangkat_terakhir', $value->id_pangkat)->where('korps.kode_matra', $v->kode_matra)->count();
            }
        }
        return $data;
    }

    public function bar_dsp()
    {
        $dsp = ConfigModel::first()->var_dsp;
        $riil = Personil::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->count();

        return [
            'DSP' => $dsp,
            'RIIL' => $riil,
            'KOSONG' => $dsp - $riil,
        ];
    }
}
