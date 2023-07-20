
function edit_pend_militer_pers(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            if (response.kategori_pendidikan == 'Dikbangspes') {
                $("#edit-kategori-pendidikan2").prop("checked", true);
            } else {
                $("#edit-kategori-pendidikan1").prop("checked", true);
            }

            $('#id-pend-militer-pers').val(response.id_pend_militer_pers);
            $('#edit-tahun-lulus-militer').val(response.tahun_lulus);
            $('#edit-nama-sekolah-militer').val(response.nama_sekolah);
            $('#edit-kriteria-tingkat').val(response.kriteria_tingkat);
            $('#edit-pend-militer-pers').modal('show');
        }
    });
}

function edit_pend_umum_pers(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $('#id_pend_umum_pers').val(response.id_pend_umum_pers);
            $('#edit_id_pend_umum').val(response.id_pend_umum);
            $('#edit_nama_sekolah_umum').val(response.nama_sekolah);
            $('#edit_tahun_lulus_umum').val(response.tahun_lulus);
            $('#edit-pend-umum-pers').modal('show');
        }
    });
}

function edit_riwayat_pangkat(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $('#id_riwayat_pangkat').val(response.id_riwayat_pangkat);
            $('#edit_id_pangkat').val(response.id_pangkat);
            $('#edit_tmt_pangkat').val(response.tmt_pangkat);
            $('#edit_no_skep_pangkat').val(response.no_skep_pangkat);
            $('#edit_tgl_skep_pangkat').val(response.tgl_skep_pangkat);
            $('#edit_no_sprin_pangkat').val(response.no_sprin_pangkat);
            $('#edit_tgl_sprin_pangkat').val(response.tgl_sprin_pangkat);
            $('#edit_riwayat_pangkat').modal('show');
        }
    });
}

function edit_riwayat_jabatan(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $('#id_riwayat_jabatan').val(response.id_riwayat_jabatan);
            $('#edit_tmt_jabatan').val(response.tmt_jabatan);
            $('#edit_no_skep_jabatan').val(response.no_skep_jabatan);
            $('#edit_tgl_skep_jabatan').val(response.tgl_skep_jabatan);
            $('#edit_no_sprin_jabatan').val(response.no_sprin_jabatan);
            $('#edit_tgl_sprin_jabatan').val(response.tgl_sprin_jabatan);
            $('#edit_riwayat_jabatan').modal('show');
        }
    });
}

function edit_keluarga(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $('#id_keluarga').val(response.id_keluarga);
            $('#edit_nama').val(response.nama);
            $('#edit_tempat_lahir').val(response.tempat_lahir);
            $('#edit_tgl_lahir').val(response.tgl_lahir);
            $('#edit_hubungan').val(response.hubungan);
            $('#edit_keluarga').modal('show');
        }
    });
}

function edit_bahasa(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $('#id_bahasa').val(response.id_bahasa);
            $('#edit_bahasa').val(response.bahasa);
            if (response.jenis == 'asing') {
                $("#edit_jenis_asing").prop("checked", true);
            } else {
                $("#edit_jenis_daerah").prop("checked", true);
            }
            if (response.kompetensi == 'aktif') {
                $("#edit_kompetensi_aktif").prop("checked", true);
            } else {
                $("#edit_kompetensi_pasif").prop("checked", true);
            }
            $('#edit_bahasa_modal').modal('show');
        }
    });
}

function edit_tanda_jasa_pers(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $('#id_jasa_pers').val(response.id_jasa_pers);
            $('#edit_id_jasa').val(response.id_jasa);
            $('#edit_tahun_jasa').val(response.tahun);
            $('#edit_tanda_jasa_pers').modal('show');
        }
    });
}

function edit_penugasan(e) {
    let url = e.attr('data-url');

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            $(`#id_penugasan_${response.jenis}`).val(response.id_penugasan);
            $(`#edit_tugas_${response.jenis}`).val(response.tugas);
            $(`#edit_tahun_${response.jenis}`).val(response.tahun);
            $(`#edit_lokasi_${response.jenis}`).val(response.lokasi);
            $(`#edit_penugasan_${response.jenis}`).modal('show');
        }
    });
}
