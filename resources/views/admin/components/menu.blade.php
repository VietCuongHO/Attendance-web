<section id="menu">
    <div class="logo">
        <img src="{{asset('assets/img/logoBK.png');}}" alt="">
        <h2>HCMUT</h2>
    </div>
    <ul class="items" style="padding-left: 0px">
        <li @if ($page == 'dashboard') style="border-left: 4px solid #fff;" @endif ><i class="fa-solid fa-gauge"></i><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li @if ($page == 'staff') style="border-left: 4px solid #fff;" @endif ><i class="fa-regular fa-user"></i><a href="{{route('admin.staff.list')}}">Staff List</a></li>
        <li @if ($page == 'attendance') style="border-left: 4px solid #fff;" @endif>
            <i class="fa-regular fa-clock position-relative">
                {{-- <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden"></span>
                </span> --}}
                @if (isset($waitConfirm))
                    <span style="font-size: 10px" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                        {{ $waitConfirm <= 99 ? $waitConfirm : '99+' }}
                        <span class="visually-hidden">waiting for confirm</span>
                    </span>
                @endif
            </i>
            <a href="{{route('admin.attendance.list')}}">Attendance</a>
        </li>
        <li @if ($page == 'timesheet') style="border-left: 4px solid #fff;" @endif ><i class="fas fa-calendar-alt"></i><a href="{{route('admin.timesheet.list')}}">Timesheet</a></li>
        <li @if ($page == 'report') style="border-left: 4px solid #fff;" @endif ><i class="fa-regular fa-file-lines"></i><a href="{{route('admin.report.list')}}">Report</a></li>
    </ul>
</section>
{{-- border-left: 4px solid #fff;
{{ $page == 'dashboard' ? 'fa-solid' : 'fa-regular' }} --}}
