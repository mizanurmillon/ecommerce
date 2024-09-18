<div class="left">
    <div class="item">
        <div class="shop__fl__body">
            <div class="profile__head">
                <div class="user_name">
                    @if(Auth::user()->avatar==NULL)
                    <img src="{{ asset('public/frontend') }}/assets/user/avatar-2.jpg" style="width: 120px;" class="user_image" alt="Not Found Image">
                    @else
                    <img src="{{ Auth::user()->avatar }}" class="user_image" alt="Not Found Image">
                    @endif
                    <h3>{{ Auth::user()->name }}</h3>
                </div>
            </div>
            <div class="list-group">
                <ul class="list-item ">
                    <li class="active"><a href="{{ route('home') }}"><i class="icon ri-home-2-line"></i> Dashboard</a></li>
                    <li><a href="#"><i class="icon ri-money-dollar-circle-fill"></i> Purchase History</a></li>
                    <li><a href="#"><i class="icon ri-download-fill"></i> Download</a></li>
                    <li><a href="{{ route('wishlist') }}" ><i class="icon ri-heart-fill"></i> Wishlist</a></li>
                    <li><a href="{{ route('my.order') }}"><i class="icon ri-money-dollar-circle-fill"></i> My Orders</a></li>
                    <li><a href="{{ route('support.ticket') }}"><i class="icon ri-ticket-2-line"></i> Support Ticket</a></li>
                    <li><a href="{{ route('user.review') }}"><i class="icon ri-pencil-fill"></i> Write a Review</a></li>
                    <li><a href="{{ route('password') }}"><i class="icon ri-lock-line"></i> Password Change</a></li>
                    <li><a href="{{ route('logout') }}" id="logout"><i class="icon ri-logout-box-r-line"></i> Logout</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>