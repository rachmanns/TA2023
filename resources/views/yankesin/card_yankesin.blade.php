<div class="row match-height">                    
    <div class="col-md-6 col-xl-3">
        <a href="/dashboard_yankesin">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/faskes.jpg')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">FASKES</h4>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="/yankesin/peta-sebaran-fasilitas?id=1" target="_blank">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/ambulance.jpg')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Fasilitas</h4>
            </div>
        </div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="/yankesin/peta-sebaran-posyandu">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/posyandu.jpeg')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Posyandu</h4>
            </div>
        </div>
        </a>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <a href="/yankesin/report-penyakit">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/penyakit.png')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Penyakit</h4>
            </div>
        </div>
        </a>
    </div>
    
    <!-- <div class="col-md-6 col-xl-3">
        <a href="#">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/yankestu.jpg')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Yankestu</h4>
            </div>
        </div>
        </a>
    </div> -->
    
    <div class="col-md-6 col-xl-3">
        <a href="/yankesin/bor-covid">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/bor.png')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Bed Occupancy Ratio</h4>
            </div>
        </div>
        </a>
    </div>
    
    <div class="col-md-6 col-xl-3" style="@if(session('covid_report')==0) display:none @endif">
        <a href="/yankesin/data-covid">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/pasien_covid.png')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Pasien Covid</h4>
            </div>
        </div>
        </a>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <a href="/dashboard_nakes">
        <div class="card">
            <img class="card-img-top" src="{{ url('img/fasilitas/nakes_tni.png')}}" height="200">
            <div class="card-body text-center">
                <h4 class="card-title">Data Nakes</h4>
            </div>
        </div>
        </a>
    </div>
</div>