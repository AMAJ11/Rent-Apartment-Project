@extends('layouts.dashboard')

@section('content')
<div class="app">
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="brand">
                <div class="avatar">A</div>
                <div>
                    <h1>Admin</h1>
                    <span>Super Admin</span>
                </div>
            </div>

            <nav class="nav">
                <a class="nav-item active" data-page="home">Dashboard</a>
                <a class="nav-item" data-page="users">Users</a>
                <a class="nav-item" data-page="appartments">Appartments</a>
            </nav>
        </div>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout" style="color:rgb(167, 63, 63)">
       logout
    </button>
</form>
        </div>
    </aside>

    <main style="width: calc(100% - 300px);">
        <section id="content"></section>
    </main>
</div>
@endsection
