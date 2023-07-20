<?php

namespace App\Services;

use App\Http\Requests\PosSatgasRequest;
use App\Models\DetailBekkes;
use App\Models\Dokter;
use App\Models\Fasilitas;
use App\Models\FasilitasRS;
use App\Models\Paramedis;
use App\Models\PosSatgas;
use App\Models\RSPemdaSwasta;
use App\Models\RSPos;
use App\Models\RumahSakit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PosSatgasService
{
    public static function store(PosSatgasRequest $request): PosSatgas
    {
        $result = DB::transaction(function () use ($request) {
            $pos_satgas = PosSatgas::create($request->validated());

            if ($request->rs_pemda_swasta) {
                foreach ($request->rs_pemda_swasta as $k => $v) {
                    $rps = RSPemdaSwasta::find($v['id_rs_pem_swas']);
                    if ($rps === null) $rps = RSPemdaSwasta::create(['nama_rs' => $v['id_rs_pem_swas']]);

                    RSPos::create([
                        'id_pos' => $pos_satgas->id_pos,
                        'id_rs_pem_swas' => $rps->id_rs_pem_swas,
                        'evakuasi' => $v['evakuasi']
                    ]);
                }
            }

            return $pos_satgas;
        });

        return $result;
    }

    public static function update(PosSatgasRequest $request, PosSatgas $pos_satgas): PosSatgas
    {
        $result = DB::transaction(function () use ($request, $pos_satgas) {
            $pos_satgas->update($request->validated());

            if ($request->rs_pemda_swasta) {
                foreach ($request->rs_pemda_swasta as $k => $v) {
                    $rps = RSPemdaSwasta::find($v['id_rs_pem_swas']);
                    if ($rps === null) $rps = RSPemdaSwasta::create(['nama_rs' => $v['id_rs_pem_swas']]);

                    RSPos::create([
                        'id_pos' => $pos_satgas->id_pos,
                        'id_rs_pem_swas' => $rps->id_rs_pem_swas,
                        'evakuasi' => $v['evakuasi']
                    ]);
                }
            }

            return $pos_satgas;
        });

        return $result;
    }

    public static function destroy(PosSatgas $pos_satgas): bool
    {
        return $pos_satgas->deleteOrFail();
    }

    public static function dataTable(): JsonResponse
    {
        $pos_satgas = PosSatgas::with('satgas_ops')->get();
        return DataTables::of($pos_satgas)
            ->addIndexColumn()
            ->addColumn('satgas_ops', function ($row) {
                return $row->satgas_ops->nama_kat_satgas ?? null;
            })
            ->addColumn('endemik', function ($row) {

                $label_endemik = 'success';
                $status_endemik = 'Tidak';
                if ($row->status_endemik === 1) {
                    $label_endemik = 'danger';
                    $status_endemik = 'Ya';
                }

                return "<div class='text-center'><div class='badge badge-" . $label_endemik . " font-small-4'>" . $status_endemik . "</div></div>";
            })
            ->addColumn('geomedik', function ($row) {
                // return '<div class="text-center"><a title="Detail" class="btn pr-0 text-primary" data-id="' . $row->id_geografis . '" onclick="show_geomedik($(this))" data-toggle="modal" data-target="#geomedik"><u>Lihat Selengkapnya</u></a></div>';
                return '<div class="text-center"><a title="Detail" class="btn pr-0 text-primary" data-id="' . $row->id_pos . '" onclick="show_pos_satgas($(this))" ><u>Lihat Selengkapnya</u></a></div>';
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><a type="button" class="text-primary pr-75" title="Detail" href="' . url('dukkesops/pos-satgas/' . $query->id_pos) . '"><i data-feather="file-text" class="font-medium-4"></i></button></a><a type="button" class="text-primary pr-75" title="Edit" href="' . url('dukkesops/pos-satgas/' . $query->id_pos . '/edit') . '"><i data-feather="edit" class="font-medium-4"></i></button></a><a title="Delete" type="button" data-id="' . $query->id_pos . '" data-url="' . url('dukkesops/pos-satgas') . '" class="delete-data"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>';
            })
            ->rawColumns([
                'satgas_ops',
                'endemik',
                'geomedik',
                'action'
            ])
            ->toJson();
    }

    public static function list_bekkes($id_mas_bek): JsonResponse
    {
        $detail_bekkes = DetailBekkes::where('id_mas_bek', $id_mas_bek)->with('kategori_brg')->get();
        return DataTables::of($detail_bekkes)
            ->addIndexColumn()
            ->addColumn('nama_kategori_brg', function ($row) {
                return $row->kategori_brg->nama_kategori ?? '-';
            })
            ->rawColumns(['nama_kategori_brg'])
            ->toJson();
    }

    public static function detail_faskes(Request $request)
    {
        $id_rs = $request->id_rs;
        $fas = Fasilitas::selectRaw('id_fasilitas, nama_fasilitas')
            ->whereIn('id_kategori', ['G', 'I', 'J'])
            ->orWhere('id_fasilitas', '1')
            ->orderBy('id_fasilitas')
            ->get();
        $namafas = array();
        $takeout_namafas = [
            'trauma',
            'eracs',
            'ursz',
            'antiaging',
            'cbct',
            'abus',
            'aestheticcenter',
            'estetika/anti-aging/kecantikan',
            'laserholmium',
            'phacomulsikasi'
        ];

        $takeout_id_fas = [];

        foreach ($fas as $d) {
            $nama_fasilitas = strtolower(str_replace(' ', '', $d->nama_fasilitas));
            if (!in_array($nama_fasilitas, $takeout_namafas)) {
                $namafas[$d->id_fasilitas] = $d->nama_fasilitas;
            } else {
                $takeout_id_fas[] = $d->id_fasilitas;
            }
        }
        $fas_filter = array_diff($fas->pluck('id_fasilitas')->toArray(), $takeout_id_fas);
        $data = Dokter::selectRaw('id_rs, nama_spesialis, id_kategori_dokter, COUNT(*) AS jumlah')
            ->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
            ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
            ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
            ->where('id_rs', $id_rs)
            ->groupBy('id_rs', 'nama_spesialis')
            ->having('jumlah', '>', '0')
            ->orderByRaw('id_rs, id_kategori_dokter, nama_spesialis')
            ->get();
        $jmldok = array();
        foreach ($data as $d) {
            if (!isset($jmldok[$d->id_rs])) $jmldok[$d->id_rs] = array();
            $jmldok[$d->id_rs][] = (object)['kat' => $d->id_kategori_dokter, 'sp' => $d->nama_spesialis, 'jml' => $d->jumlah];
        }
        $data = Paramedis::selectRaw('id_rs, nama_jenis_paramedis, COUNT(*) AS jumlah')
            ->join('praktek_p', 'praktek_p.id_paramedis', 'paramedis.id_paramedis')
            ->join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', 'paramedis.id_jenis_paramedis')
            ->where('id_rs', $id_rs)
            ->groupBy('id_rs', 'paramedis.id_jenis_paramedis')
            ->having('jumlah', '>', '0')
            ->orderByRaw('id_rs, paramedis.id_jenis_paramedis')
            ->get();
        $jmlpar = array();
        foreach ($data as $d) {
            if (!isset($jmlpar[$d->id_rs])) $jmlpar[$d->id_rs] = array();
            $jmlpar[$d->id_rs][] = (object)['kat' => $d->nama_jenis_paramedis, 'jml' => $d->jumlah];
        }
        $data = Fasilitas::selectRaw('id_rs, nama_fasilitas, SUM(jumlah) AS jumlah')
            ->join('fasilitas_rs', 'fasilitas_rs.id_fasilitas', 'fasilitas.id_fasilitas')
            ->where('id_rs', $id_rs)
            ->where('id_kategori', 'N')
            ->groupBy('id_rs', 'fasilitas.id_fasilitas')
            ->having('jumlah', '>', '0')
            ->orderBy('id_rs')
            ->get();
        $jmllain = array();
        foreach ($data as $d) {
            if (!isset($jmllain[$d->id_rs])) $jmllain[$d->id_rs] = array();
            $jmllain[$d->id_rs][] = (object)['kat' => $d->nama_fasilitas, 'jml' => $d->jumlah];
        }
        $rs = RumahSakit::selectRaw('rs.*,nama_tingkat_rs, kode_matra')
            ->with(['fasilitas' => function ($q) use ($fas, $fas_filter) {
                $q->selectRaw('id_rs, id_fasilitas, jumlah')
                    // ->whereIn('id_fasilitas', $fas->pluck('id_fasilitas'));
                    ->whereIn('id_fasilitas', $fas_filter);
            }])
            ->withCount(['praktek_d' => function ($q) {
                $q->where('status', 'Disetujui');
            }, 'praktek_p' => function ($q) {
                $q->where('status', 'Disetujui');
            }])
            ->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')
            ->leftJoin('tingkat_rs', 'tingkat_rs.id_tingkat_rs', 'rs.id_tingkat_rs')
            ->where('id_rs', $id_rs)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('id_rs')
            ->first();

        foreach ($rs->fasilitas as $f) $f->nama_fasilitas = $namafas[$f->id_fasilitas];
        $jml = 0;
        $rs->detaildok = $jmldok[$rs->id_rs] ?? [];
        foreach ($rs->detaildok as $k) {
            $jml += $k->jml;
        }
        $rs->dokter = $jml;
        $jml = 0;
        $rs->detailpar = $jmlpar[$rs->id_rs] ?? [];
        foreach ($rs->detailpar as $k) {
            $jml += $k->jml;
        }
        $rs->paramedis = $jml;
        $jml = 0;
        $rs->detaillain = $jmllain[$rs->id_rs] ?? [];
        foreach ($rs->detaillain as $k) {
            $jml += $k->jml;
        }
        $rs->nakeslain = $jml;

        $rs->tempat_tidur = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->where('id_kategori', 'D')->where('id_rs', $rs->id_rs)->sum('jumlah');

        $doku = '-';
        $dokg = '-';
        if (!empty($rs->detaildok)) {
            $key_doku = array_search(1, array_column($rs->detaildok, 'kat'));
            $key_dokg = array_search(3, array_column($rs->detaildok, 'kat'));
            if ($key_doku !== false) {
                $doku = $rs->detaildok[$key_doku]->jml;
            } else if ($key_dokg !== false) {
                $dokg = $rs->detaildok[$key_dokg]->jml;
            }
        }

        (strpos($rs->jenis_rs, 'RSS') === false) ? $jenis_rs = $rs->jenis_rs : $jenis_rs = '-Ops';
        $badge = ['AD' => 'badge-success', 'AL' => 'badge-info', 'AU' => 'badge-primary', 'MABES' => 'badge-warning'];

        $html = '
        <p class="font-weight-bolder mb-25" id="namafaskes">' . $rs->nama_rs . '</p>

        <span class="badge badge-secondary badge-pill mr-50 pr-1 pl-1" id="jenisfaskes">' . $jenis_rs . '</span>
        <span class="badge ' . $badge[$rs->kode_matra] . ' badge-pill pr-1 pl-1" id="matra"> ' . $rs->kode_matra . ' </span>

        <hr>

        <ul class="list-unstyled">
            <li class="d-flex align-items-center">
                <i data-feather="map-pin" class="mr-1"></i><span id="alamat">' . $rs->alamat . '</span>
            </li>
            <li class="d-flex align-items-center">
                <i data-feather="phone" class="mr-1"></i><span id="telp">' . $rs->telp . '</span>
            </li>
        </ul>

        <hr>

        <h6 class="font-weight-bolder">Informasi Faskes</h6>

        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Tingkat</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="tingkat">' . $rs->nama_tingkat_rs . '</b></label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>No Izin Operasional</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="noopr">' . $rs->no_ijin_opr . '</b></label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Pengelolaan Keuangan</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="keuangan">' . $rs->keuangan . '</b></label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Akreditasi</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="akre">' . $rs->akreditasi . '</b></label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>IMB</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="imb">' . $rs->imb . '</b></label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>IPAL</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="ipal">' . $rs->ipal . '</b></label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Kerjasama dengan BPJS</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <span class="badge badge-success badge-pill pr-1 pl-1 float-right" id="bpjs">' . $rs->bpjs . '</span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Jumlah Tempat Tidur</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right"><b class="text-break" id="tempat_tidur">' . $rs->tempat_tidur . '</b></label>
            </div>
        </div>

        <hr>

        <h6 class="font-weight-bolder">Fasilitas Unggulan</h6>

        <div class="row" id="fasunggul">';

        if (!empty($rs->fasilitas)) {
            for ($i = 0; $i < count($rs->fasilitas); $i++) {
                $html .= '<div class="col-sm-9 col-md-9 col-lg-9 col-12">
                            <label>- ' . $rs->fasilitas[$i]['nama_fasilitas'] . '</label>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-12">
                            <label class="float-right font-weight-bolder">' . ($rs->fasilitas[$i]['id_fasilitas'] == 1 ? $rs->fasilitas[$i]['jumlah'] : ($rs->fasilitas[$i]['jumlah'] == 0 ? 'Tidak Ada' : 'Ada')) . '</label>
                        </div>';
            }
        } else {
            $html .= '<div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="font-weight-bolder">-</label>
                </div>';
        }

        $html .= '</div>

        <hr>

        <h6 class="font-weight-bolder">Rekapitulasi Nakes</h6>

        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Dokter</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right font-weight-bolder" id="dokter">' . $rs->dokter . '</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Paramedis</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right font-weight-bolder" id="paramedis">' . $rs->paramedis . '</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label>Nakes Lainnya</label>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                <label class="float-right font-weight-bolder" id="nakeslain">' . $rs->nakeslain . '</label>
            </div>
        </div>
            <div id="rekapitulasi">
                <div class="d-flex justify-content-between">
                    <label>Dokter Umum</label>
                    <label class="float-right font-weight-bolder" id="doku">' . $doku . '</label>
                </div>
                <div class="d-flex justify-content-between">
                    <label>Dokter Gigi</label>
                    <label class="float-right font-weight-bolder" id="dokg">' . $dokg . '</label>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-bolder mt-50">Spesialis</h6>
                </div>
                <div id="doksp">';
        if (!empty($rs->detaildok)) {
            for ($i = 0; $i < count($rs->detaildok); $i++) {
                if (($rs->detaildok[$i]->kat == 1) || ($rs->detaildok[$i]->kat == 3)) {
                } else {
                    $html .= '<div class="d-flex justify-content-between">
                        <label>' . $rs->detaildok[$i]->sp . $rs->detaildok[$i]->kat . '</label>
                                    <label class="float-right font-weight-bolder">' . $rs->detaildok[$i]->jml . '</label>
                                </div>';
                }
            }
        } else {
            $html .= '<div class="col-sm-6 col-md-6 col-lg-6 col-12">
                        <label class="font-weight-bolder">-</label>
                        </div>';
        }
        $html .= '</div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-bolder mt-50">Paramedis</h6>
                </div>
                <div id="prmds">';
        if (!empty($rs->detailpar)) {
            for ($i = 0; $i < count($rs->detailpar); $i++) {
                $html .= '<div class="d-flex justify-content-between">
                    <label>' . $rs->detailpar[$i]->kat . '</label>
                                        <label class="float-right font-weight-bolder">' . $rs->detailpar[$i]->jml . '</label>
                                    </div>';
            }
        } else {
            $html .= '<div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                <label class="font-weight-bolder">-</label>
                                </div>';
        }
        $html .= '</div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-bolder mt-50">Nakes Lainnya</h6>
                </div>
                <div id="nkslain">';
        if (!empty($rs->detaillain)) {
            for ($i = 0; $i < count($rs->detaillain); $i++) {
                $html .= '<div class="d-flex justify-content-between">
                    <label>' . $rs->detaillain[$i]->kat . '</label>
                                                <label class="float-right font-weight-bolder">' . $rs->detaillain[$i]->jml . '</label>
                                            </div>';
            }
        } else {
            $html .= '<div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                        <label class="font-weight-bolder">-</label>
                                        </div>';
        }
        $html .= '</div>
            </div>  

        <hr>
        
        ';

        return $html;
    }
}
