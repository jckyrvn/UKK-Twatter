            <!-- bagian layout untuk di panggil di folder lain -->
            <aside>
            <img src="{{ asset('images/small-icon.png') }}">

            <div class="link-sidebar">
                <div class="second-sidebar">
                <a href="{{ route('welcome') }}">
                <i class="bi bi-house-door-fill"></i> 
                <span>Home</span>
                </a>
                </div>
                    <!-- untuk mengirim routing ke routing web -->
                <form action="{{ url('profileView') }}/{{ Auth::user()->id }}" method="GET" class="main-tweet">
                @csrf
                <div class="second-sidebar">
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                <a href="{{ url('/profile/'. Auth::user()->id) }}">
                <i class="bi bi-person-circle"></i> 
                <span>{{ Auth::user()->name }}</span>
                </a>
                </div>
                </form>
                

                <div class="second-sidebar">
                <a href="{{ route('main.tweet') }}">
                <i class="bi bi-plus-square"></i> 
                <span>Create</span>
                </a>
                </div>

                <form action="{{ route('logout') }}" method="post">
                <div class="second-sidebar">
                <a href="{{ route('auth.login') }}">
                <i class="bi bi-box-arrow-left"></i> 
                <span>Log Out</span>
                </a>
                </div>
                </form>

            
            </div>

        </aside>
    