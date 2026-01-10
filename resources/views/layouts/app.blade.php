<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin DeutschMohammed')</title>

        <!-- Styles -->
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: Arial, sans-serif; background: #f5f5f5; }
        </style>
        
        @stack('styles')
    </head>
    <body>
        <div style="min-height: 100vh;">
            <!-- Navigation simple -->
            <nav style="background: #CC0000; color: white; padding: 15px 20px;">
                <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('admin') }}" style="color: white; text-decoration: none; font-size: 18px; font-weight: bold;">
                        🇩🇪 DeutschMohammed Admin
                    </a>
                    
                    @auth
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <span>{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" style="background: white; color: #CC0000; border: none; padding: 5px 15px; border-radius: 5px; cursor: pointer;">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </nav>

            <!-- Page Content -->
            <main style="padding: 20px;">
                <div style="max-width: 1200px; margin: 0 auto;">
                    @if(session('success'))
                        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                            @foreach($errors->all() as $error)
                                ❌ {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>

        @stack('scripts')
    </body>
</html>