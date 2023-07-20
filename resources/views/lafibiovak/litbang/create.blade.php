@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="/lafibiovak/litbang"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Litbang</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                      <form onsubmit="return false;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label> Judul Penelitian* </label>
                                        <input type="text" name="judul" class="form-control" placeholder="Judul Penelitian" value="{{$data->judul ?? ''}}" list="prods" required />
                                        <datalist id="prods">
                                        @foreach($prods as $p)
                                            <option value="{{ $p }}">
                                        @endforeach
                                        </datalist>
                                        <div class="invalid-feedback">Judul harus diisi</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label> Penanggung Jawab Penelitian* </label>
                                        <input type="text" class="form-control" name="pj" id="pj" placeholder="Penanggung Jawab" value="{{$data->pj ?? ''}}" required />
                                        <div class="invalid-feedback">Penanggung Jawab harus diisi</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label> Penyelenggara </label>
                                        <select name="id_jalur" class="select2" id="jalur">
                                            <option disabled selected>Pilih Jalur Company</option>
                                        @foreach($comps as $c)
                                            <option value="{{ $c->id_jalur_company }}" id="comp{{ $c->id_jalur_company }}" data-loc="{{ $c->alamat }}" @if(isset($data) && $data->id_jalur_company == $c->id_jalur_company)selected @endif>{{ $c->nama_jalur }}</option>
                                        @endforeach
                                        </select>
                                        <div class="invalid-feedback select-j">Jalur Company harus diisi</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label> Tempat Pelaksanaan </label>
                                        <input type="text" class="form-control" id="tempat" placeholder="Tempat pelaksanaan" readonly />
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 my-1">
                                    <div class="table-responsive rounded border">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="min-width: 200px">Jenis Litbang</th>
                                                    <th style="min-width: 400px">Tahap Pelaksanaan</th>
                                                    <th class="text-center">Persentase Pelaksanaan</th>
                                                    <th class="text-center" style="min-width: 100px">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($jenis as $j)
                                                <tr>
                                                    <td>{{ $j->deskripsi }}</td>
                                                    <td>
                                                        <ol type="a">
                                                        @foreach($j->tahap as $t)
                                                            <li>{{ $t->tahap_pelaksanaan }}</li>
                                                        @endforeach
                                                        </ol>
                                                    </td>
                                                    <td class="text-center" id="jenis{{ $j->id_jenis }}">{{ $persen[$j->id_jenis] ?? '-'}}</td>
                                                    <td class="text-center"><a data-toggle='modal' data-target='#edit_jenis{{ $j->id_jenis }}'><button title="Edit" class="btn text-primary p-0"><i data-feather="edit" class="font-medium-4"></i></button></a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                @foreach($jenis as $j)
                                    <!-- Modal Jenis {{ $j->deskripsi }} -->
                                    <div class="modal fade text-left" id="edit_jenis{{ $j->id_jenis }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-title">Edit Tahap Pelaksanaan - {{ $j->deskripsi }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body">
                                                        @php $num = 'a'; @endphp
                                                        @foreach($j->tahap as $t)
                                                        <div class="custom-control custom-checkbox mb-25">
                                                            <input type="checkbox" class="custom-control-input jenis{{ $j->id_jenis }}" name="checks[{{ $t->id_tahap }}]" id="customCheck{{ $t->id_tahap }}" data-jenis="{{ $j->id_jenis }}" @if(isset($checks[$t->id_tahap]) && $checks[$t->id_tahap]->status == 1) checked @endif />
                                                            <label class="custom-control-label" for="customCheck{{ $t->id_tahap }}">{{ $num++ }}) {{ $t->tahap_pelaksanaan }}</label>
                                                        </div>
                                                        <div class="form-group" id="upload{{ $t->id_tahap }}" style="display:{{ isset($checks[$t->id_tahap]) && $checks[$t->id_tahap]->status == 1 ? '' : 'none' }}">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile{{ $t->id_tahap }}" name="files{{ $t->id_tahap }}" />
                                                                <label class="custom-file-label" for="customFile{{ $t->id_tahap }}">Upload Laporan</label>
                                                             </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Simpan</button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                                <!--
                                <div class="col-md-12 col-12">
                                    <div class="form-group form-input">
                                        <label>Hasil Laporan dan evaluasi/LOA/NIE</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" />
                                            <label class="custom-file-label" for="customFile1">Hasil Laporan dan evaluasi/LOA/NIE</label>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                        @csrf
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('page_script')
    <script>
        var id = "{{ request()->segment(3)=='create'?'':request()->segment(3) }}";
        $(function(){
            $(".card-footer button").click(function() {
                if ($('form')[0].checkValidity() && $('#jalur').val() != null) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('lafibiovak/litbang') }}/" + id,
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: new FormData($('form')[0]),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/litbang';
                            });
                        }
                    }).always(function() {
                        $(".btn-save").prop('disabled', false);
                        $(".btn-save").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if ($('#jalur').val() == null) $('.select-j').css('display', 'block');
                }
            });
            $('#jalur').change(function() {
                $('#tempat').val($('#comp' + $(this).val()).attr('data-loc'));
                $('#pj').val('Kepala ' + $('#comp' + $(this).val()).html());
                $('.select-j').css('display', 'none');
            });
            $('input[type=checkbox]').change(function() {
                $('#upload' + $(this).attr('id').substr(11)).css('display', ($(this).prop('checked') ? '' : 'none'));
                jenis = $(this).data('jenis');
                per = 100 * $('.jenis' + jenis + ':checked').length / $('.jenis' + jenis).length;
                $('#jenis' + jenis).html(per + '%');
            });
            @if(request()->segment(3) != 'create')
            pj = $('#pj').val();
            $('#jalur').val('{{ $data->id_jalur_company }}').trigger('change');
            $('#pj').val(pj);
            @endif
        });
    </script>
@endsection