<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SIMERPATIK | Login System</title>

    <meta name="description" content="Shifting Master RTC Pertamina Patra Logistik" />
    <meta name="author" content="Kyuusha Inc" />

    <link rel="shortcut icon" href="{{ asset('logo pertamina.png') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body{
            min-height:100vh;
            overflow-y:auto;   /* scroll vertikal aktif */
            overflow-x:hidden; /* horizontal tetap aman */

            position:relative;

            display:flex;
            align-items:center;
            justify-content:center;

            padding:24px;

            background:
                radial-gradient(circle at top left, rgba(0,102,179,.45), transparent 30%),
                radial-gradient(circle at bottom right, rgba(0,210,106,.25), transparent 30%),
                linear-gradient(135deg,#001f4d 0%,#003b88 45%,#0066b3 100%);
                }

        /* =========================
           BACKGROUND EFFECT
        ========================= */

        .bg-blur{
            position:absolute;
            border-radius:999px;
            filter:blur(80px);
            opacity:.45;
            z-index:0;
        }

        .blur-1{
            width:300px;
            height:300px;
            background:#00d26a;
            top:-80px;
            left:-80px;
        }

        .blur-2{
            width:280px;
            height:280px;
            background:#00a8ff;
            bottom:-100px;
            right:-60px;
        }

        /* =========================
           LOGIN CARD
        ========================= */

        .login-wrapper{
            width:100%;
            max-width:1100px;
            min-height:680px;

            position:relative;
            z-index:2;

            display:grid;
            grid-template-columns:1fr 480px;

            border-radius:32px;

            overflow:hidden;

            background:rgba(255,255,255,.08);

            border:1px solid rgba(255,255,255,.12);

            backdrop-filter:blur(24px);

            box-shadow:
                0 20px 80px rgba(0,0,0,.35);
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-left{
            position:relative;
            padding:60px;

            display:flex;
            flex-direction:column;
            justify-content:space-between;

            overflow:hidden;
        }

        .login-left::before{
            content:'';
            position:absolute;
            inset:0;

            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,.04),
                    rgba(255,255,255,.02)
                );

            pointer-events:none;
        }

        .brand{
            position:relative;
            z-index:2;

            display:flex;
            align-items:center;
            gap:16px;
        }

        .brand img{
            width:64px;
            height:64px;
            object-fit:contain;

            filter:drop-shadow(0 10px 18px rgba(0,0,0,.2));
        }

        .brand-text h1{
            font-size:1.6rem;
            font-weight:800;
            color:white;
            letter-spacing:.5px;
        }

        .brand-text p{
            color:rgba(255,255,255,.7);
            font-size:.88rem;
            margin-top:4px;
        }

        .hero-content{
            position:relative;
            z-index:2;

            max-width:520px;
        }

        .hero-badge{
            display:inline-flex;
            align-items:center;
            gap:10px;

            padding:10px 16px;

            border-radius:999px;

            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.08);

            color:#dbeafe;

            font-size:.82rem;
            font-weight:600;

            margin-bottom:24px;
        }

        .hero-dot{
            width:8px;
            height:8px;
            border-radius:999px;
            background:#00d26a;
            box-shadow:0 0 10px #00d26a;
        }

        .hero-title{
            font-size:3rem;
            line-height:1.15;
            font-weight:900;
            color:white;
            margin-bottom:18px;
        }

        .hero-title span{
            background:linear-gradient(135deg,#00d26a,#7dffb1);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .hero-description{
            font-size:.95rem;
            line-height:1.7;
            color:rgba(255,255,255,.75);
            max-width:480px;
        }

        .hero-stats{
            display:grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap:14px;
            margin-top:30px;
        }

        .hero-stat{
            padding:14px 14px;
            border-radius:18px;

            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.08);
            backdrop-filter:blur(12px);
        }

        .hero-stat h3{
            color:white;
            font-size:1.1rem; /* sebelumnya 1.5rem */
            font-weight:800;
            margin-bottom:4px;
        }

        .hero-stat p{
            color:rgba(255,255,255,.65);
            font-size:.75rem; /* diperkecil */
            line-height:1.4;
        }

        .hero-footer{
            position:relative;
            z-index:2;

            display:flex;
            align-items:center;
            justify-content:space-between;

            margin-top:40px;

            color:rgba(255,255,255,.55);
            font-size:.82rem;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-right{
            background:white;
            padding:54px 42px;

            display:flex;
            flex-direction:column;
            justify-content:center;

            position:relative;
        }

        .login-right::before{
            content:'';
            position:absolute;
            top:0;
            left:0;

            width:100%;
            height:6px;

            background:
                linear-gradient(
                    90deg,
                    #0066b3,
                    #00d26a
                );
        }

        .login-header{
            margin-bottom:34px;
        }

        .login-header h2{
            font-size:2rem;
            font-weight:800;
            color:#0f172a;
            margin-bottom:10px;
        }

        .login-header p{
            color:#64748b;
            line-height:1.7;
            font-size:.95rem;
        }

        /* ERROR */

        .alert-error{
            background:#fef2f2;
            border:1px solid #fecaca;

            color:#dc2626;

            padding:14px 16px;
            border-radius:14px;

            font-size:.9rem;

            margin-bottom:20px;

            display:flex;
            align-items:center;
            gap:10px;
        }

        /* FORM */

        .form-group{
            margin-bottom:20px;
        }

        .form-label{
            display:block;
            margin-bottom:10px;

            font-size:.88rem;
            font-weight:600;

            color:#334155;
        }

        .input-wrapper{
            position:relative;
        }

        .input-icon{
            position:absolute;
            top:50%;
            left:16px;

            transform:translateY(-50%);

            color:#94a3b8;
            font-size:.9rem;
        }

        .form-input{
            width:100%;
            height:56px;

            border-radius:16px;

            border:1px solid #dbe2ea;

            background:#f8fafc;

            padding:0 18px 0 48px;

            font-size:.95rem;

            transition:.25s ease;
        }

        .form-input:focus{
            outline:none;

            border-color:#0066b3;

            background:white;

            box-shadow:
                0 0 0 4px rgba(0,102,179,.12);
        }

        .form-input::placeholder{
            color:#94a3b8;
        }

        /* BUTTON */

        .login-btn{
            width:100%;
            height:56px;

            border:none;
            border-radius:16px;

            cursor:pointer;

            background:
                linear-gradient(
                    135deg,
                    #0066b3,
                    #00a0e9
                );

            color:white;

            font-size:.95rem;
            font-weight:700;

            transition:.25s ease;

            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;

            margin-top:12px;

            box-shadow:
                0 12px 24px rgba(0,102,179,.22);
        }

        .login-btn:hover{
            transform:translateY(-2px);

            box-shadow:
                0 18px 30px rgba(0,102,179,.28);
        }

        /* FOOTER */

        .login-footer{
            margin-top:28px;

            text-align:center;

            font-size:.8rem;
            color:#94a3b8;
            line-height:1.7;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width:980px){

            body{
                overflow:auto;
            }

            .login-wrapper{
                grid-template-columns:1fr;
                max-width:520px;
                min-height:auto;
            }

            .login-left{
                display:none;
            }

            .login-right{
                padding:42px 28px;
            }

            .login-header h2{
                font-size:1.7rem;
            }
        }

        @media(max-width:480px){

            body{
                padding:14px;
            }

            .login-right{
                padding:34px 22px;
            }

            .form-input{
                height:52px;
            }

            .login-btn{
                height:52px;
            }
        }

    </style>
</head>

<body>

    <!-- BLUR -->
    <div class="bg-blur blur-1"></div>
    <div class="bg-blur blur-2"></div>

    <!-- LOGIN -->
    <div class="login-wrapper">

        <!-- LEFT -->
        <div class="login-left">

            <!-- BRAND -->
            <div class="brand">

                <img src="{{ asset('logo pertamina.png') }}" alt="Pertamina Logo">

                <div class="brand-text">
                    <h1>SIMERPATIK</h1>
                    <p>Management System</p>
                </div>

            </div>

            <!-- HERO -->
            <div class="hero-content">

                <h2 class="hero-title">
                    Smart Shift &
                    Workforce <span>Management</span>
                </h2>

                <p class="hero-description">
                    Sistem modern untuk mengelola jadwal shift,
                    monitoring operator, approval kerja,
                    serta manajemen operasional secara real-time
                    dengan performa tinggi dan tampilan profesional.
                </p>

                <div class="hero-stats">

                    <div class="hero-stat">
                        <h3>24/7</h3>
                        <p>Monitoring System</p>
                    </div>

                    <div class="hero-stat">
                        <h3>Real-Time</h3>
                        <p>Attendance Tracking</p>
                    </div>

                    <div class="hero-stat">
                        <h3>Secure</h3>
                        <p>Enterprise Access</p>
                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="hero-footer">
                <span>© {{ date('Y') }} SIMERPATIK System</span>
                <span>Powered by Kyuusha Inc</span>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <div class="login-header">

                <h2>Welcome Back 👋</h2>

                <p>
                    Silakan login menggunakan akun yang telah diberikan
                    untuk mengakses dashboard sistem.
                </p>

            </div>

            <!-- ERROR -->
            @if(session('error'))
                <div class="alert-error">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="/">

                @csrf

                <!-- EMAIL -->
                <div class="form-group">

                    <label class="form-label">
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <i class="fas fa-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            required
                            class="form-input"
                            placeholder="you@example.com"
                        >

                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <i class="fas fa-lock input-icon"></i>

                        <input
                            type="password"
                            name="password"
                            required
                            class="form-input"
                            placeholder="••••••••"
                        >

                    </div>

                </div>

                <!-- BUTTON -->
                <button type="submit" class="login-btn">

                    <i class="fas fa-right-to-bracket"></i>
                    Login to Dashboard

                </button>

            </form>

            <!-- FOOTER -->
            <div class="login-footer">
                Secure Access • Pertamina Workforce Management System
            </div>

        </div>

    </div>

</body>
</html>