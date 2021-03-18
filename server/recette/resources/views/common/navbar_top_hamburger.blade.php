<div class="nav-wrapper-top-hamburger shadow">
    <div class="container">
        <nav class="navbar navbar-top-hamburger">
            <div class="navbar-dark d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Recette</h4>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse" id="navbarToggleExternalContent">
                <ul>
                    <li>
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                            <i class="mr-1 fas fa-folder-plus"></i>レシピ追加
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                            <i class="mr-1 fas fa-clipboard-list"></i>お気に入り
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                            <i class="mr-1 fas fa-folder-plus"></i>食材から献立
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                            <i class="mr-1 far fa-calendar-alt"></i>カレンダー
                        </a>
                    </li>
                </ul>
            </div>
            </div>
                <!-- <div class="container">
                    <div class="text-center" style="line-height: 25px;">
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                            <i class="fas fa-folder-plus fa-2x"></i>
                        </a>
                        <p class="nav-fix-bottom-menu-name">レシピ追加</p>
                    </div>
                    <div class="text-center" style="line-height: 25px;">
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                        </a>
                        <p class="nav-fix-bottom-menu-name">お気に入り</p>
                    </div>
                    <div class="text-center" style="line-height: 25px;">
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                        </a>
                        <p class="nav-fix-bottom-menu-name">食材から献立</p>
                    </div>
                    <div class="text-center" style="line-height: 25px;">
                        <a href="{{ route('recipe.create', ['user_id' => Auth::id()]) }}">
                        <i class="far fa-calendar-alt fa-2x"></i>
                        </a>
                        <p class="nav-fix-bottom-menu-name">カレンダー</p>
                    </div>
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
                </div> -->
        </nav>
    </div>
</div>