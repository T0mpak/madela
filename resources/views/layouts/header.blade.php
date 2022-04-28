<!-- Header starts -->

@php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
@endphp

<header>
    <div class="header">
        <div class="logo">
            <a href="{{ \App\Providers\RouteServiceProvider::HOME }}" onMouseOver="this.style.color='#FFFFFF'" onMouseOut="this.style.color='#e1e8e3'">
                MADELA SHOP
            </a>
        </div>

        <div class="navigation">
            <nav class="first-navbar-items-list">
                <ul>
                    <li>
                        <a href="{{ route('categories.index') }}">All categories</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}">All products</a>
                    </li>
                    <li>
                        <a href="{{ route('promotions.index') }}">Promotions</a>
                    </li>
                    <li>
                        <a href="{{ route('contacts') }}">Contacts</a>
                    </li>
                </ul>
            </nav>
            <nav class="second-navbar-items-list">
                <ul>
                    <li>
                        <a href="{{ route('basket.index') }}">Basket (
                            <span id="count_basket">
                                @if(isset($_SESSION['overall_count_basket']))
                                    {{ $_SESSION['overall_count_basket'] }}
                                @else
                                    {{0}}
                                @endif
                            </span>)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" id="orders">Orders</a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                    @auth()
                        @if(auth()->user()->role_id == 1)
                            <li>
                                <a href="{{ route('admin') }}" style="color: white; opacity: 1;">Admin</a>
                            </li>
                        @elseif(auth()->user()->role_id == 2)
                            <li>
                                <a href="{{ route('users.index', auth()->user()->id) }}" style="color: white; opacity: 1;">{{ auth()->user()->name }}</a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <input type="submit" value="Logout">
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- Header ends -->
