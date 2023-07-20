<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        $data = [
            ['nama_jabatan' => 'KAPUSKES TNI', 'created_at' => $time, 'updated_at' => $time],
            ['nama_jabatan' => 'WAKA PUSKES TNI', 'created_at' => $time, 'updated_at' => $time],
            [
                'nama_jabatan' => 'KABIDRENDALDISI LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAJANGUM LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABIDRENDALPROD LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KADOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABIDYANKESIN PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAUNIT KERMABAKTIKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KALAFIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KALITBANG LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABIDDUKKESOPS PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDDALDISINVEN BIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDDALADA RENDALDISI LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDDALPROD RENDALPROD LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIRENPROD RENDALPROD LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDLOG BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBDID RENPROGAR BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDKESKUREHAB BIDYANKESIN PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDDALDIA RENDALDISI LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBIDSIAPDUKKES BIDDUKKESOPS PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KATAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABAG TRANSDISI DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABAG LITBANG SDM & ALPROD LITBANG LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBID SDM BIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASIBATKATKES DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASIPAM BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASUBBAGMINLOG JANGUM LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASI BAKTIKES KERMABAKTIKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASI TU TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASI KB KES KERMABAKTIKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASI REN PROGAR BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASIMIN BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASILOG BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASIRIKKES BIDDUKKESOPS PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAURMINLOG BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAURBANGMAT BIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAUR REN PROGAR BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'PAURMIN DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'PS. SMIN KAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAURBATKATKES 3 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 KABIDYANKESIN PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER RENDALDIA LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 KABIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 RENPROGAR BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 3 KAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 KABIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 KABIDDUKKESOPS PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAURBATKATKES 4 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAURBATKATKES 2 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 KABIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAURMATUM DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAURBATKATKES 1 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAUR TRANSDISI DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER RENDALDISI LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER LOG BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 KAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER KABIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 KABIDDUKKESOPS PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 KAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER JANGUM LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAURYAR 1 KU PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 KABIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 MINPERS BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 1 KERMABAKTIKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 KABIDYANKESIN PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 4 KAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'SPRI KALAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAUR ALKES 1 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI 1 TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI 1 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TABAN DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAKURIR 2 TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI KABIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI KAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI KABIDDUKKESOPS PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TAMUDI WAKAPUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASIALKES & MATUM DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KABAG LITBANGFAR LITBANG LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASI PROFKES BIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASIJABFUNGKES BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAUR TRANSDISI DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAURMIN TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAUR INVENT BIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KASI EVDOK PROGAR BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAURBATKATKES DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'KAURMINPROD RENDALPROD LAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'KAUR EVDOK BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'KAURBANG SDM BIDBANGKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'KAURREN BIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'KAURDATA BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'KAUR MATUM DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'KAURADA BIDMATFASKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'BAMIN AGENDA 1 TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'BA/TUR URDAL DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER KALAVIBIOVAK PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'BAURBATKATKES 5 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'BA/TUR OPR KOM SIMAK BMN BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'nama_jabatan' => 'BAURYAR 2 KU PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 2 KERMABAKTIKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA HARWAT TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAREPROD TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BAUR ALKES 2 DOBEKKES PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'BA/TUR OPERATOR KOMPUTER 3 RENPROGAR BIDUM PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_jabatan' => 'TABAN 1 TAUD PUSKES TNI',
                'created_at' => $time,
                'updated_at' => $time
            ]

        ];

        Jabatan::truncate();

        foreach ($data as $key => $value) {

            Jabatan::create($data[$key]);
        }
    }
}
