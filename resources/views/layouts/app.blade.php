<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ ucfirst(auth()->user()->role) }} Panel | Pertamina System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="SiMerpatik Management System" />
    <meta name="author" content="Kyuusha Inc" />

    <link rel="shortcut icon" href="{{ asset('logo pertamina.png') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>

        *{
            font-family:'Inter',sans-serif;
            box-sizing:border-box;
        }

        body{
            margin:0;
            background:#f1f5f9;
            overflow-x:hidden;
            overflow-y:auto;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar{
            width:270px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            z-index:1000;

            background:
                linear-gradient(
                    180deg,
                    #002f6c 0%,
                    #003b88 40%,
                    #0066b3 100%
                );

            display:flex;
            flex-direction:column;

            border-right:1px solid rgba(255,255,255,.08);
            box-shadow:4px 0 25px rgba(0,0,0,.2);

            transition:.3s ease;
        }

        .sidebar-header{
            padding:24px;
            border-bottom:1px solid rgba(255,255,255,.08);
        }

        .brand{
            display:flex;
            align-items:center;
            gap:14px;
            text-decoration:none;
        }

        .brand img{
            width:48px;
            height:48px;
            object-fit:contain;
        }

        .brand-text{
            color:white;
        }

        .brand-title{
            font-size:1rem;
            font-weight:800;
            line-height:1.2;
        }

        .brand-subtitle{
            font-size:.72rem;
            opacity:.7;
            letter-spacing:.5px;
        }

        .role-badge{
            margin:18px 20px 0;
            padding:10px 14px;
            border-radius:12px;

            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.08);

            color:white;

            display:flex;
            align-items:center;
            gap:10px;

            font-size:.78rem;
            font-weight:600;
        }

        .role-dot{
            width:8px;
            height:8px;
            border-radius:999px;
            background:#00d26a;
            box-shadow:0 0 8px #00d26a;
        }

        /* NAVIGATION */

        .sidebar-nav{
            flex:1;
            overflow-y:auto;
            padding:20px 14px 120px;
        }

        .nav-label{
            color:rgba(255,255,255,.5);
            font-size:.68rem;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:1.5px;
            margin:18px 10px 10px;
        }

        .nav-link{
            display:flex;
            align-items:center;
            gap:14px;

            text-decoration:none;

            color:rgba(255,255,255,.82);

            padding:12px 14px;
            margin-bottom:6px;

            border-radius:14px;

            transition:.2s ease;

            position:relative;
        }

        .nav-link:hover{
            background:rgba(255,255,255,.08);
            transform:translateX(3px);
        }

        .nav-link.active{
            background:
                linear-gradient(
                    135deg,
                    rgba(0,210,106,.2),
                    rgba(255,255,255,.08)
                );

            border:1px solid rgba(0,210,106,.25);

            color:#fff;
        }

        .nav-link.active::before{
            content:'';
            position:absolute;
            left:0;
            top:50%;
            transform:translateY(-50%);
            width:3px;
            height:60%;
            background:#00d26a;
            border-radius:0 4px 4px 0;
        }

        .nav-icon{
            width:38px;
            height:38px;
            border-radius:10px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:rgba(255,255,255,.08);

            flex-shrink:0;
        }

        .nav-link:hover .nav-icon,
        .nav-link.active .nav-icon{
            background:rgba(0,210,106,.18);
        }

        /* =========================
           MAIN
        ========================= */

        .main-wrapper{
            margin-left:270px;
            min-height:100vh;
            height:100vh;

            display:flex;
            flex-direction:column;

            overflow:hidden;
        }

        /* TOPBAR */

        .topbar{
            height:72px;
            background:white;

            border-bottom:1px solid #e2e8f0;

            display:flex;
            align-items:center;
            justify-content:space-between;

            padding:0 28px;

            position:sticky;
            top:0;
            z-index:50;
        }

        .topbar-left{
            display:flex;
            align-items:center;
            gap:16px;
        }

        .sidebar-toggle{
            width:42px;
            height:42px;
            border:none;
            border-radius:12px;

            background:#f1f5f9;

            display:none;

            cursor:pointer;

            color:#334155;
        }

        .topbar-title{
            font-size:1rem;
            font-weight:700;
            color:#0f172a;
        }

        .topbar-subtitle{
            font-size:.78rem;
            color:#64748b;
        }

        .topbar-right{
            display:flex;
            align-items:center;
            gap:16px;
        }

        .clock{
            font-size:.82rem;
            color:#64748b;
            font-weight:600;
        }

        /* =========================
           USER DROPDOWN
        ========================= */

        .user-dropdown{
            position:relative;
        }

        .user-dropdown-btn{
            border:none;
            background:white;

            display:flex;
            align-items:center;
            gap:12px;

            padding:8px 12px;

            border-radius:14px;

            cursor:pointer;

            transition:.2s ease;

            border:1px solid #e2e8f0;
        }

        .user-dropdown-btn:hover{
            background:#f8fafc;
        }

        .avatar{
            width:42px;
            height:42px;
            border-radius:999px;

            background:
                linear-gradient(
                    135deg,
                    #0066b3,
                    #00d26a
                );

            color:white;

            display:flex;
            align-items:center;
            justify-content:center;

            font-weight:700;
        }

        .user-meta{
            text-align:left;
        }

        .user-name{
            font-size:.88rem;
            font-weight:700;
            color:#0f172a;
        }

        .user-role{
            font-size:.72rem;
            color:#94a3b8;
        }

        .dropdown-arrow{
            font-size:.72rem;
            color:#94a3b8;
        }

        .dropdown-menu{
            position:absolute;
            top:110%;
            right:0;

            width:240px;

            background:white;

            border-radius:18px;

            border:1px solid #e2e8f0;

            box-shadow:0 10px 30px rgba(0,0,0,.08);

            padding:14px;

            opacity:0;
            visibility:hidden;
            transform:translateY(10px);

            transition:.2s ease;

            z-index:999;
        }

        .dropdown-menu.show{
            opacity:1;
            visibility:visible;
            transform:translateY(0);
        }

        .dropdown-user-info{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .dropdown-avatar{
            width:48px;
            height:48px;
            border-radius:999px;

            background:
                linear-gradient(
                    135deg,
                    #0066b3,
                    #00d26a
                );

            color:white;

            display:flex;
            align-items:center;
            justify-content:center;

            font-weight:700;
        }

        .dropdown-name{
            font-size:.9rem;
            font-weight:700;
            color:#0f172a;
        }

        .dropdown-role{
            font-size:.75rem;
            color:#94a3b8;
        }

        .dropdown-divider{
            height:1px;
            background:#e2e8f0;
            margin:14px 0;
        }

        .dropdown-logout{
            width:100%;
            border:none;

            display:flex;
            align-items:center;
            gap:10px;

            padding:12px 14px;

            border-radius:12px;

            background:#fef2f2;
            color:#dc2626;

            font-weight:600;

            cursor:pointer;

            transition:.2s ease;
        }

        .dropdown-logout:hover{
            background:#fee2e2;
        }

        /* CONTENT */

        .page-content{
            flex:1;
            overflow-y:auto;
            overflow-x:hidden;

            padding:28px;

            height:calc(100vh - 72px);
        }

        .content-card{
            background:white;
            border-radius:22px;
            border:1px solid #e2e8f0;

            padding:24px;

            box-shadow:0 3px 14px rgba(0,0,0,.04);

            min-height:100%;
        }

        /* =========================
           SOFT SCROLLBAR
        ========================= */

        ::-webkit-scrollbar{
            width:4px;
            height:4px;
        }

        ::-webkit-scrollbar-track{
            background:transparent;
        }

        ::-webkit-scrollbar-thumb{
            background:rgba(255,255,255,0.08);
            border-radius:999px;
            transition:.2s;
        }

        ::-webkit-scrollbar-thumb:hover{
            background:rgba(255,255,255,0.18);
        }

        .page-content::-webkit-scrollbar-thumb,
        .sidebar-nav::-webkit-scrollbar-thumb{
            background:rgba(100,116,139,0.15);
        }

        .page-content::-webkit-scrollbar-thumb:hover,
        .sidebar-nav::-webkit-scrollbar-thumb:hover{
            background:rgba(100,116,139,0.28);
        }

        /* OVERLAY */

        .sidebar-overlay{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.4);
            z-index:999;

            opacity:0;
            visibility:hidden;

            transition:.3s;
        }

        .sidebar-overlay.show{
            opacity:1;
            visibility:visible;
        }

        /* RESPONSIVE */

        @media(max-width:1024px){

            .main-wrapper{
                height:auto;
            }

            .page-content{
                height:auto;
                overflow-y:auto;
            }

            .sidebar{
                transform:translateX(-100%);
            }

            .sidebar.open{
                transform:translateX(0);
            }

            .main-wrapper{
                margin-left:0;
            }

            .sidebar-toggle{
                display:flex;
                align-items:center;
                justify-content:center;
            }

            .topbar{
                padding:0 18px;
            }

            .page-content{
                padding:18px;
            }

            .clock{
                display:none;
            }

            .user-meta{
                display:none;
            }

            .dropdown-menu{
                right:-10px;
            }
        }

    </style>
</head>

<body>

<!-- OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">

    <div class="sidebar-header">

        <a href="#" class="brand">

            <img src="{{ asset('logo pertamina.png') }}" alt="Logo">

            <div class="brand-text">

                <div class="brand-title">
                    SI-MERPATIK
                </div>

                <div class="brand-subtitle">
                    MANAGEMENT SYSTEM
                </div>

            </div>

        </a>

    </div>

    <div class="role-badge">
        <div class="role-dot"></div>
        {{ ucfirst(auth()->user()->role) }} Panel
    </div>

    <nav class="sidebar-nav">

        {{-- MANAGEMENT --}}
@if(auth()->user()->role == 'management')

    <div class="nav-label">Management</div>

    <a href="/management/dashboard"
       class="nav-link {{ request()->is('management/dashboard') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-chart-pie"></i>
        </div>
        Dashboard
    </a>

    <a href="/management/karyawan"
       class="nav-link {{ request()->is('management/karyawan*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-users"></i>
        </div>
        Karyawan
    </a>

    <a href="/management/kontrak"
       class="nav-link {{ request()->is('management/kontrak*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-file-contract"></i>
        </div>
        Kontrak
    </a>

    <a href="/management/shift"
       class="nav-link {{ request()->is('management/shift*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-clock"></i>
        </div>
        Shift
    </a>

    <a href="/management/jadwal"
       class="nav-link {{ request()->is('management/jadwal*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-calendar-days"></i>
        </div>
        Jadwal
    </a>

    <a href="/management/monitoring-kehadiran"
       class="nav-link {{ request()->is('management/monitoring-kehadiran') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-clipboard-check"></i>
        </div>
        Monitoring Kehadiran
    </a>

    <a href="/management/approval-shift"
       class="nav-link {{ request()->is('management/approval-shift*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-rotate"></i>
        </div>
        Approval Shift
    </a>

    <a href="/management/riwayat-shift"
       class="nav-link {{ request()->is('management/riwayat-shift') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-clock-rotate-left"></i>
        </div>
        Riwayat
    </a>

@endif


{{-- LEADER --}}
@if(auth()->user()->role == 'leader')

    <div class="nav-label">Leader</div>

    <a href="/leader/dashboard"
       class="nav-link {{ request()->is('leader/dashboard') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        Dashboard
    </a>

    <a href="/leader/absensi"
       class="nav-link {{ request()->is('leader/absensi*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-fingerprint"></i>
        </div>
        Absensi
    </a>

    <a href="/leader/monitoring-operator"
       class="nav-link {{ request()->is('leader/monitoring-operator') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-user-check"></i>
        </div>
        Monitoring Operator
    </a>

    <a href="/leader/tukar-shift"
       class="nav-link {{ request()->is('leader/tukar-shift*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-rotate"></i>
        </div>
        Tukar Shift
    </a>

    <a href="/leader/approval-operator"
       class="nav-link {{ request()->is('leader/approval-operator*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-check-double"></i>
        </div>
        Approval Operator
    </a>

@endif


{{-- OPERATOR --}}
@if(auth()->user()->role == 'operator')

    <div class="nav-label">Operator</div>

    <a href="/operator/dashboard"
       class="nav-link {{ request()->is('operator/dashboard') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-house"></i>
        </div>
        Dashboard
    </a>

    <a href="/operator/jadwal-saya"
       class="nav-link {{ request()->is('operator/jadwal-saya') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-calendar"></i>
        </div>
        Jadwal Saya
    </a>

    <a href="/operator/absensi"
       class="nav-link {{ request()->is('operator/absensi*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-fingerprint"></i>
        </div>
        Absensi
    </a>

    <a href="/operator/tukar-shift"
       class="nav-link {{ request()->is('operator/tukar-shift*') ? 'active' : '' }}">
        <div class="nav-icon">
            <i class="fas fa-right-left"></i>
        </div>
        Tukar Shift
    </a>

@endif

    </nav>

</aside>

<!-- MAIN -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <header class="topbar">

        <div class="topbar-left">

            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <div>

                <div class="topbar-title">
                    Dashboard
                </div>

                <div class="topbar-subtitle">
                    {{ ucfirst(auth()->user()->role) }} Panel
                </div>

            </div>

        </div>

        <div class="topbar-right">

            <!-- CLOCK -->
            <div class="clock" id="clock"></div>

            <!-- USER DROPDOWN -->
            <div class="user-dropdown">

                <button class="user-dropdown-btn" id="userDropdownBtn">

                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name,0,1)) }}
                    </div>

                    <div class="user-meta">

                        <div class="user-name">
                            {{ auth()->user()->username ?? auth()->user()->name }}
                        </div>

                        <div class="user-role">
                            {{ ucfirst(auth()->user()->role) }}
                        </div>

                    </div>

                    <i class="fas fa-chevron-down dropdown-arrow"></i>

                </button>

                <!-- DROPDOWN -->
                <div class="dropdown-menu" id="dropdownMenu">

                    <div class="dropdown-user-info">

                        <div class="dropdown-avatar">
                            {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name,0,1)) }}
                        </div>

                        <div>

                            <div class="dropdown-name">
                                {{ auth()->user()->username ?? auth()->user()->name }}
                            </div>

                            <div class="dropdown-role">
                                {{ ucfirst(auth()->user()->role) }}
                            </div>

                        </div>

                    </div>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="/logout">
                        @csrf

                        <button class="dropdown-logout">
                            <i class="fas fa-right-from-bracket"></i>
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </header>

    <!-- CONTENT -->
    <main class="page-content">

        <div class="content-card">
            @yield('content')
        </div>

    </main>

</div>

<script>

    /* =========================
       CLOCK
    ========================= */

    function updateClock(){

        const now = new Date();

        const time = now.toLocaleTimeString('id-ID',{
            hour:'2-digit',
            minute:'2-digit',
            second:'2-digit'
        });

        const date = now.toLocaleDateString('id-ID',{
            weekday:'short',
            day:'numeric',
            month:'short',
            year:'numeric'
        });

        document.getElementById('clock').innerHTML =
            `${date} · ${time}`;
    }

    updateClock();
    setInterval(updateClock,1000);

    /* =========================
       SIDEBAR MOBILE
    ========================= */

    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    toggle.addEventListener('click', () => {

        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');

    });

    overlay.addEventListener('click', () => {

        sidebar.classList.remove('open');
        overlay.classList.remove('show');

    });

    /* =========================
       USER DROPDOWN
    ========================= */

    const dropdownBtn = document.getElementById('userDropdownBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownBtn.addEventListener('click', (e) => {

        e.stopPropagation();

        dropdownMenu.classList.toggle('show');

    });

    window.addEventListener('click', (e) => {

        if(
            !dropdownBtn.contains(e.target) &&
            !dropdownMenu.contains(e.target)
        ){
            dropdownMenu.classList.remove('show');
        }

    });

</script>

</body>
</html>