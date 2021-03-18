<div class="nav-wrapper-top shadow">    
    <div class="container">
        <nav class="navbar navbar-top shadow-sm">
            <div class="navbar-dark d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Recette</h4>
                <ul class="p-0 mb-0 d-flex justify-content-between align-items-center">
                    <li>
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        レシピ追加</a>
                    </li>
                    <li>
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        お気に入り</a>
                    </li>
                    <li class="text-center" style="line-height: 25px;">
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        食材から献立</a>
                    </li>
                    <li class="text-center" style="line-height: 25px;">
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        カレンダー</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('レシピを追加 ') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                </ul>
            </div>
        </nav>
    </div>
</div>