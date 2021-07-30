@yield('content')

<p>Auteur : {{ Auth::user()->display_name }}</p>

<p>The VWPP Database</p>
