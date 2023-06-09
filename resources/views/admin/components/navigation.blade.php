<div class="navigation">
    <div class="n1">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search">
        </div>
    </div>

    <div class="n2">
        <div class="notification" onclick="toggleNotifi()">
            <div class="notification-icon">
                <i class="fa-solid fa-bell">
                    @if (count($notification) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    @endif
                </i>
            </div>
            <div class="notification-box" id="list-notifi">
                <h3>Notifications <span>{{ count($notification) }}</span></h3>

                @foreach ($notification as $item)
                    <div class="noti-item">
                        <img src="{{asset('assets/img/quinhon.jpg');}}" alt="">
                        <div class="noti-text">
                            <h5>Viet Cuong</h5>
                            <p>{{ $item['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="account" onclick="toggleAcc()">
            <div class="account-avatar">
                <img src="{{asset($profile->avatar);}}" alt="">
            </div>
            <div class="account-box" id="list-acc">
                <div class="profile">
                    <img src="{{asset($profile->avatar);}}" alt="">
                    <div class="info">
                        <h3>{{ $profile->first_name . ' ' . $profile->last_name }}</h3>
                        <p>{{ '@' . $profile->position }}</p>
                    </div>
                </div>
                {{-- <a href="#" class="btn">
                    <i class="fa-solid fa-plus"></i>
                    Add profile
                </a> --}}
                <ul class="function">
                    {{-- <li>
                        <i class="fa-solid fa-pen-to-square"></i>
                        <a href="#">Edit profile</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-gears"></i>
                        <a href="#">Setting</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <a href="#">Account</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-question"></i>
                        <a href="#">Help</a>
                    </li> --}}
                    <li>
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a href="{{ route('admin.logout') }}">Log out</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
