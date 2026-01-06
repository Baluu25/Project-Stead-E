@extends('layouts.dashboard_app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-layout">
        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <div class="sidebar-header">
                    <h3>Dashboard</h3>
                </div>
                <ul class="nav-items">
                    <li class="nav-item active">
                        <a href="#">
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <span class="nav-text">Statistics</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <span class="nav-text">Explore</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <span class="nav-text">Goals</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <span class="nav-text">Challenges</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="dashboard-main">
            <header class="dashboard-header">
                <h1>Welcome, {{ Auth::user()->username ?? 'Felhasználó' }}!</h1>
                <p class="motivation-text">Every step counts. Stay consistent!</p>
            </header>
        </main>
    </div>
</div>
@endsection