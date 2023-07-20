<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Tipe Pos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('dukkesops/tipe-pos') }}" class="default-form" autocomplete="off">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="tipe" name="tipe">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    {{-- <div class="form-group form-input">
                        <label for="tipe">Tipe Pos</label>
                        <input type="text" id="tipe" class="form-control" placeholder="Tipe Pos" name="tipe" />
                        <div class="invalid-feedback"></div>
                    </div> --}}
                    <div class="media">
                        <img src="{{ url('img/dashboard/kapal.png')}}" alt="users avatar" id="icon" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer icon" height="90" width="90" />
                        <div class="media-body my-auto">
                            <div class="col-12 d-flex mt-1 px-0">
                                <div class="form-group form-input">
                                    <p>Recommended size is 66 x 66</p>
                                    <label class="btn btn-outline-primary mr-75 mb-0" for="change-picture">
                                        <span class="d-none d-sm-block">Upload Icon</span>
                                        <input class="form-control" name="image" type="file" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg" />
                                        <span class="d-block d-sm-none">
                                            <i class="mr-0" data-feather="edit"></i>
                                        </span>
                                    </label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
