                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">Jenis Kendaraan</label>
                                                <select class="select2 form-control form-control-lg" id="jenis" name="jenis" required>
                                                    <option selected disabled>Jenis Kendaraan</option>
                                                    @foreach($jenis as $j)
                                                    <option value="{{$j}}">{{$j}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback select-j">Jenis harus diisi</div>
                                            </div>  
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">Merk</label>
                                                <input type="text" name="merk" class="form-control" placeholder="Merk" required />
                                                <div class="invalid-feedback">Merk harus diisi</div>
                                            </div>     
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">No. Reg</label>
                                                <input type="text" name="no_reg" class="form-control" placeholder="No. Reg" required />
                                                <div class="invalid-feedback">No. Reg harus diisi</div>
                                            </div>     