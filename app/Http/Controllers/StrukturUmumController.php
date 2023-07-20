<?php

namespace App\Http\Controllers;

use App\Models\BidangStruktur;
use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturUmumController extends Controller
{
    public function index()
    {
        $orgdata = [];
        $data = BidangStruktur::with("detail.riwayat_jabatan_latest.person:id_personil,nama,foto","detail.riwayat_jabatan_latest.jabatan:id_jabatan,nama_jabatan")->where('kode', 'PUSKES')->first();

        foreach ($data->detail as $key => $value) {

            $person ="Unknown";
            $jabatan ="Unknown";
            $src='';

            if($value->riwayat_jabatan_latest->isNotEmpty()){
                $person = $value->riwayat_jabatan_latest[0]->person->nama ?? 'Unknown';
                $jabatan = $value->riwayat_jabatan_latest[0]->jabatan->nama_jabatan ?? 'Unknown';
                $src = ($value->riwayat_jabatan_latest[0]->person->foto) ? asset('personil/' . $value->riwayat_jabatan_latest[0]->person->foto) : '';
            }
            
            $orgdata[] = array(
                "id" => $value->id,
                "name" => $jabatan,
                "org_id" => $data->id,
                "description" => ($person=="Unknown") ? '-' : '<div>
                    <table>
                    <tr>
                        <td width="50"><img class="img-fluid rounded-circle" src="' . $src . '"></td>    
                        <td class="pl-1 pt-2">' . $person . ' </td>
                    </tr>
                    </table>
                </div>',
                "parent" => $value->parent
            );
        }
        $orgdata = json_encode($orgdata);

        $active_menu = 'struktur_umum';
        return view('struktur_organisasi_bidang', compact('active_menu', 'data', 'orgdata'));
    }

    public function personil()
    {
        $kasimin = Personil::where('nrp', 21940142190274)->first()->foto ?? null;
        $kaurdata = Personil::where('nrp', 197007021994022001)->first()->foto ?? null;
        $komp1 = Personil::where('nrp', 112831)->first()->foto ?? null;
        $komp2 = Personil::where('nrp', 85390)->first()->foto ?? null;
        $kode = base64_encode("SUBBIDMINPERS");
        return view('struktur_organisasi', [
            'active_menu' => 'struktur_personil',
            'kasimin' => $kasimin,
            'kaurdata' => $kaurdata,
            'komp1' => $komp1,
            'komp2' => $komp2,
            'kode' => $kode
        ]);
    }

    public function anggaran()
    {
        $kasubbid = Personil::where('nrp', 522798)->first()->foto ?? null;
        $kasiren = Personil::where('nrp', 21950239120173)->first()->foto ?? null;
        $kasiedvok = Personil::where('nrp', 196711211989031001)->first()->foto ?? null;
        $kauredvok = Personil::where('nrp', 196906201991082001)->first()->foto ?? null;
        $opskomp1 = Personil::where('nrp', 94446)->first()->foto ?? null;
        $kode = base64_encode("SUBBIDRENPROGAR");
        return view('struktur_organisasi', [
            'active_menu' => 'struktur_anggaran',
            'kasubbid' => $kasubbid,
            'kasiren' => $kasiren,
            'kasiedvok' => $kasiedvok,
            'kauredvok' => $kauredvok,
            'opskomp1' => $opskomp1,
            "kode" => $kode
        ]);
    }

    public function logistik()
    {
        $kasilog = Personil::where('nrp', 11060009770285)->first()->foto ?? null;
        $kaurminlog = Personil::where('nrp', 19111)->first()->foto ?? null;
        $kaursimak = Personil::where('nrp', 11110040220690)->first()->foto ?? null;
        $opkomp = Personil::where('nrp', 21090271321090)->first()->foto ?? null;
        $opkompsimak = Personil::where('nrp', 98509302010121003)->first()->foto ?? null;
        $kode = base64_encode("SUBBIDLOG");

        return view('struktur_organisasi', [
            'active_menu' => 'struktur_bidlog',
            'kasilog' => $kasilog,
            'kaurminlog' => $kaurminlog,
            'kaursimak' => $kaursimak,
            'opkomp' => $opkomp,
            'opkompsimak' => $opkompsimak,
            'kode' => $kode
        ]);
    }

    public function taud()
    {
        $kasitu = Personil::where('nrp', 589625)->first()->foto ?? null;
        $oprkomp = Personil::where('nrp', 198505232006042004)->first()->foto ?? null;
        $takurir = Personil::where('nrp', 31010853671180)->first()->foto ?? null;
        $baharwat = Personil::where('nrp', 31930571180673)->first()->foto ?? null;
        $tamudi1 = Personil::where('nrp', 83001)->first()->foto ?? null;
        $tamudi2 = Personil::where('nrp', 539845)->first()->foto ?? null;
        $kode = base64_encode("TAUD");

        return view('struktur_organisasi', [
            'active_menu' => 'organisasi_taud',
            'kasitu' => $kasitu,
            'oprkomp' => $oprkomp,
            'takurir' => $takurir,
            'baharwat' => $baharwat,
            'tamudi1' => $tamudi1,
            'tamudi2' => $tamudi2,
            'kode' => $kode

        ]);
    }

    public function bangkes()
    {
        $kode = base64_encode("BANGKES");

        return view('struktur_organisasi', [
            'active_menu' => 'struktur_organisasi_bangkes',
            'kode' => $kode

        ]);
    }
}
