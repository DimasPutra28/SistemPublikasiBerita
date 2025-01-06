@if (Route::is('login'))
    <h1 style="font-weight: 900; font-size: 25px;">LOGIN</h1>
@elseif (Route::is('register'))
    <h1 style="font-weight: 900; font-size: 25px;">REGISTER</h1>
@endif
