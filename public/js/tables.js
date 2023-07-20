// (function () {

var colums_table = {
    "data_keluarga": [
        {
            data: 'nama',
            name: 'nama'
        },
        {
            data: 'tempat_tgl_lahir',
            name: 'tempat_tgl_lahir'
        },
        {
            data: 'hubungan',
            name: 'hubungan'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }
    ],
    "data_pendidikan_umum": [
        {
            data: 'pendidikan_umum.tingkat_pendidikan',
            name: 'pendidikan_umum.tingkat_pendidikan'
        },
        {
            data: 'nama_sekolah',
            name: 'nama_sekolah'
        },
        {
            data: 'tahun_lulus',
            name: 'tahun_lulus'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_pendidikan_militer": [
        {
            data: 'kategori_pendidikan',
            name: 'kategori_pendidikan'
        },
        {
            data: 'kriteria_tingkat',
            name: 'kriteria_tingkat'
        },
        {
            data: 'nama_sekolah',
            name: 'nama_sekolah'
        },
        {
            data: 'tahun_lulus',
            name: 'tahun_lulus'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_riwayat_pangkat": [
        {
            data: 'pangkat.nama_pangkat',
            name: 'pangkat.nama_pangkat'
        },
        {
            data: 'tmt_pangkat',
            name: 'tmt_pangkat'
        },
        {
            data: 'no_skep_pangkat',
            name: 'no_skep_pangkat'
        },
        {
            data: 'tgl_skep_pangkat',
            name: 'tgl_skep_pangkat'
        },
        {
            data: 'no_sprin_pangkat',
            name: 'no_sprin_pangkat'
        },
        {
            data: 'tgl_sprin_pangkat',
            name: 'tgl_sprin_pangkat'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_riwayat_jabatan": [
        {
            data: 'jabatan.nama_jabatan',
            name: 'jabatan.nama_jabatan'
        },
        {
            data: 'tmt_jabatan',
            name: 'tmt_jabatan'
        },
        {
            data: 'no_skep_jabatan',
            name: 'no_skep_jabatan'
        },
        {
            data: 'tgl_skep_jabatan',
            name: 'tgl_skep_jabatan'
        },
        {
            data: 'no_sprin_jabatan',
            name: 'no_sprin_jabatan'
        },
        {
            data: 'tgl_sprin_jabatan',
            name: 'tgl_sprin_jabatan'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_penugasan_dn": [
        {
            data: 'tugas',
            name: 'tugas'
        },
        {
            data: 'tahun',
            name: 'tahun'
        },
        {
            data: 'lokasi',
            name: 'lokasi'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_penugasan_ln": [
        {
            data: 'tugas',
            name: 'tugas'
        },
        {
            data: 'tahun',
            name: 'tahun'
        },
        {
            data: 'lokasi',
            name: 'lokasi'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_bahasa": [
        {
            data: 'jenis',
            name: 'jenis'
        },
        {
            data: 'bahasa',
            name: 'bahasa'
        },
        {
            data: 'kompetensi',
            name: 'kompetensi'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "data_tanda_jasa": [
        {
            data: 'tanda_jasa.nama_jasa',
            name: 'tanda_jasa.nama_jasa'
        },
        {
            data: 'tahun',
            name: 'tahun'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
}


function ajax_table(url_data, column_data, target_data) {
    $(target_data).DataTable({
        processing: true,
        serverSide: true,
        ajax: url_data,
        columns: column_data,
        "drawCallback": function (settings) {
            feather.replace();
        }
    });
}

// })()
