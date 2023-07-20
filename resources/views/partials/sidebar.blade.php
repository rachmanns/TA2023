<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <i class="bx bxl-c-plus-plus"></i>
            <div class="logo_name">CRM</div>
        </div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav_list">
        <li>
            <a href="#">
                <i class="bx bx-search "></i>
                <i class="bx bx-search bx-tada"></i>
                <input type="text" placeholder=" Search...">
            </a>
            <span class="tooltip">Search</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-grid-alt"></i>
                <i class="bx bx-grid-alt bx-tada"></i>
                <span class="links_name"> Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="/customers/index" class="ico">
                <i class="bx bx-user"></i>
                <i class="bx bx-user bx-tada"></i>
                <span class="links_name"> Customers</span>
            </a>
            <span class="tooltip">Customers</span>
        </li>
        <li>
            <a href="/events/index">
                <i class='bx bxs-calendar-event'></i>
                <i class='bx bxs-calendar-event bx-tada'></i>
                <span class="links_name"> Events</span>
            </a>
            <span class="tooltip">Events</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-school'></i>
                <i class='bx bxs-school bx-tada'></i>
                <span class="links_name"> Companys</span>
            </a>
            <span class="tooltip">Companys</span>
        </li>
        <li>
            <a href="/users/index">
                <i class='bx bxs-cog'></i>
                <i class='bx bxs-cog bx-tada'></i>
                <span class="links_name"> User</span>
            </a>
            <span class="tooltip">User</span>
        </li>
        <li>
            <a href="/roles/index">
                <i class='bx bxs-cog'></i>
                <i class='bx bxs-cog bx-tada'></i>
                <span class="links_name"> Role</span>
            </a>
            <span class="tooltip">Role</span>
        </li>
        <li>
            <a href="/permissions/index">
                <i class='bx bxs-cog'></i>
                <i class='bx bxs-cog bx-tada'></i>
                <span class="links_name"> Permissions</span>
            </a>
            <span class="tooltip">Permissions</span>
        </li>
    </ul>
    <div class="profile_content">
        <div class="profile">
            <div class="profile_details">
                <img src="/img/kanna.jpg" alt="">
                <div class="name_job">
                    <div class="name">Jhon Wick</div>
                    <div class="job">Web Designer</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
        
                <a class="nav-link px-3" href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="bx bx-log-out" id="log_out"></i>
            </a>
            </form>
            {{-- <i class="bx bx-log-out" id="log_out"></i> --}}
        </div>
        
    </div>
</div>
