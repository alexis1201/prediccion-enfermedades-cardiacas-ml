<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Heart Disease ML</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* ── Variables ── */
        :root {
            --blue:     #2563eb;
            --blue-l:   #eff6ff;
            --blue-d:   #1d4ed8;
            --green:    #16a34a;
            --green-l:  #f0fdf4;
            --red:      #dc2626;
            --red-l:    #fef2f2;
            --orange:   #ea580c;
            --orange-l: #fff7ed;
            --purple:   #7c3aed;
            --purple-l: #f5f3ff;
            --g50:  #f9fafb;
            --g100: #f3f4f6;
            --g200: #e5e7eb;
            --g300: #d1d5db;
            --g400: #9ca3af;
            --g500: #6b7280;
            --g600: #4b5563;
            --g700: #374151;
            --g800: #1f2937;
            --g900: #111827;
            --white: #ffffff;
            --r: 12px;
            --rs: 8px;
            --sh: 0 1px 3px rgba(0,0,0,.08);
            --shm: 0 4px 12px rgba(0,0,0,.10);
        }

        /* ── Reset ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--g50);
            color: var(--g800);
            min-height: 100vh;
            font-size: 15px;
            line-height: 1.65;
            -webkit-text-size-adjust: 100%;
        }
        img { display: block; max-width: 100%; height: auto; }

        /* ── Topbar ── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--g200);
            padding: .7rem 1.25rem;
            display: flex;
            align-items: center;
            gap: .6rem;
            position: sticky;
            top: 0;
            z-index: 200;
            box-shadow: var(--sh);
        }
        .topbar-logo { font-size: 1.2rem; flex-shrink: 0; }
        .topbar-info { min-width: 0; flex: 1; }
        .topbar-info .ttitle {
            font-size: .85rem;
            font-weight: 700;
            color: var(--g900);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .topbar-info .tsub {
            font-size: .7rem;
            color: var(--g400);
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .topbar-badge {
            flex-shrink: 0;
            background: var(--blue-l);
            color: var(--blue);
            border: 1px solid #bfdbfe;
            border-radius: 20px;
            padding: .2rem .65rem;
            font-size: .68rem;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
        }

        /* ── Page ── */
        .page { max-width: 960px; margin: 0 auto; padding: 1.25rem 1rem 5rem; }

        /* ── Hero header ── */
        .hero {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 60%, #3b82f6 100%);
            border-radius: var(--r);
            padding: 1.75rem 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--white);
            box-shadow: var(--shm);
        }
        .hero h1 {
            font-size: clamp(.95rem, 2.5vw, 1.25rem);
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: .75rem;
        }
        .hero-pills {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
        }
        .hero-pill {
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            padding: .2rem .65rem;
            font-size: .7rem;
            color: rgba(255,255,255,.9);
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── Tab nav ── */
        .tab-nav {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: .4rem;
            margin-bottom: 1.25rem;
            background: var(--white);
            border: 1px solid var(--g200);
            border-radius: var(--r);
            padding: .4rem;
            box-shadow: var(--sh);
        }
        .tab-btn {
            border: none;
            background: transparent;
            border-radius: var(--rs);
            padding: .6rem .25rem;
            font-size: .72rem;
            font-weight: 600;
            color: var(--g500);
            cursor: pointer;
            transition: all .18s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .25rem;
            line-height: 1.2;
            text-align: center;
        }
        .tab-btn .ti { font-size: 1.1rem; }
        .tab-btn .tl { font-size: .65rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; }
        .tab-btn .ts { font-size: .6rem; color: var(--g400); font-family: 'JetBrains Mono', monospace; }
        .tab-btn:hover { background: var(--g100); color: var(--g700); }
        .tab-btn.active { background: var(--blue); color: var(--white); }
        .tab-btn.active .ts { color: rgba(255,255,255,.7); }

        /* ── Panels ── */
        .panel { display: none; }
        .panel.active { display: block; }

        /* ── Cards ── */
        .card {
            background: var(--white);
            border: 1px solid var(--g200);
            border-radius: var(--r);
            padding: 1.25rem;
            margin-bottom: 1.25rem;
            box-shadow: var(--sh);
        }
        .card-label {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--g400);
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: .85rem;
            padding-bottom: .6rem;
            border-bottom: 1px solid var(--g100);
        }

        /* ── Stat grid ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: .65rem;
            margin-bottom: 1.25rem;
        }
        .stat-item {
            background: var(--white);
            border: 1px solid var(--g200);
            border-radius: var(--rs);
            padding: .9rem .75rem;
            text-align: center;
            box-shadow: var(--sh);
        }
        .stat-item .sv {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--blue);
        }
        .stat-item .sl { font-size: .68rem; color: var(--g500); margin-top: .15rem; }

        /* ── Chart card ── */
        .chart-card {
            background: var(--white);
            border: 1px solid var(--g200);
            border-radius: var(--r);
            padding: 1.1rem;
            margin-bottom: 1.1rem;
            box-shadow: var(--sh);
        }
        .chart-card .chart-label {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--g400);
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: .75rem;
            padding-bottom: .55rem;
            border-bottom: 1px solid var(--g100);
        }
        .chart-card img { border-radius: 6px; width: 100%; }

        /* ── Obs ── */
        .obs {
            border-radius: var(--rs);
            padding: 1rem 1.1rem;
            margin-top: .85rem;
        }
        .obs.s1 { background: var(--blue-l); border: 1px solid #bfdbfe; }
        .obs.s2 { background: var(--green-l); border: 1px solid #bbf7d0; }
        .obs.s3 { background: var(--purple-l); border: 1px solid #ddd6fe; }
        .obs.s4 { background: var(--orange-l); border: 1px solid #fed7aa; }
        .obs h4 {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: .55rem;
            font-family: 'JetBrains Mono', monospace;
        }
        .obs.s1 h4 { color: var(--blue); }
        .obs.s2 h4 { color: var(--green); }
        .obs.s3 h4 { color: var(--purple); }
        .obs.s4 h4 { color: var(--orange); }
        .obs ul { padding-left: 1.15rem; font-size: .83rem; color: var(--g700); }
        .obs li { margin-bottom: .28rem; }
        .obs strong { color: var(--g900); }
        .obs code {
            font-family: 'JetBrains Mono', monospace;
            font-size: .75rem;
            background: rgba(0,0,0,.06);
            border-radius: 3px;
            padding: .1rem .28rem;
        }

        /* ── S1 info cards ── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: .75rem;
            margin-bottom: 1rem;
        }
        .info-card {
            background: var(--white);
            border: 1px solid var(--g200);
            border-radius: var(--rs);
            padding: 1rem;
            box-shadow: var(--sh);
        }
        .info-card .ic-icon { font-size: 1.5rem; margin-bottom: .4rem; }
        .info-card .ic-title { font-size: .83rem; font-weight: 700; color: var(--g900); margin-bottom: .25rem; }
        .info-card .ic-text { font-size: .8rem; color: var(--g600); line-height: 1.5; }

        /* ── S4 table ── */
        .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius: var(--rs); }
        .model-table { width: 100%; border-collapse: collapse; font-size: .8rem; min-width: 460px; }
        .model-table th {
            background: var(--g50);
            color: var(--g500);
            padding: .55rem .75rem;
            text-align: center;
            border-bottom: 2px solid var(--g200);
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
        }
        .model-table th:first-child { text-align: left; }
        .model-table td {
            padding: .55rem .75rem;
            border-bottom: 1px solid var(--g100);
            text-align: center;
            font-family: 'JetBrains Mono', monospace;
            color: var(--g600);
            white-space: nowrap;
        }
        .model-table td:first-child {
            text-align: left;
            color: var(--g800);
            font-family: 'Inter', sans-serif;
            font-size: .8rem;
            white-space: normal;
        }
        .model-table .best td { background: var(--green-l); }
        .model-table .best td:first-child { color: var(--green); font-weight: 600; }
        .hi { color: var(--green); font-weight: 700; }
        .lo { color: var(--g400); }
        .best-badge {
            display: inline-block;
            background: var(--green);
            color: #fff;
            border-radius: 4px;
            font-size: .58rem;
            padding: .05rem .3rem;
            margin-left: .3rem;
            vertical-align: middle;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
        }

        /* ── S5 form ── */
        .s5-hero {
            background: linear-gradient(135deg, #0f172a, #1e3a5f);
            border-radius: var(--r);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
            color: var(--white);
        }
        .s5-hero h2 { font-size: 1rem; font-weight: 700; margin-bottom: .25rem; }
        .s5-hero p { font-size: .78rem; color: rgba(255,255,255,.6); }
        .s5-pills { display: flex; flex-wrap: wrap; gap: .35rem; margin-top: .75rem; }
        .s5-pill {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 20px;
            padding: .18rem .6rem;
            font-size: .67rem;
            color: rgba(255,255,255,.8);
            font-family: 'JetBrains Mono', monospace;
        }
        .s5-pill.hl { background: var(--blue); border-color: var(--blue); color: #fff; }

        .section-divider {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--blue);
            margin: 1.35rem 0 .75rem;
            display: flex;
            align-items: center;
            gap: .5rem;
            font-family: 'JetBrains Mono', monospace;
        }
        .section-divider::after { content: ''; flex: 1; height: 1px; background: var(--g200); }

        .cases-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: .65rem;
            margin-bottom: 1.25rem;
        }
        .case-btn {
            background: var(--white);
            border: 1.5px solid var(--g200);
            border-radius: var(--rs);
            padding: .9rem .5rem;
            cursor: pointer;
            text-align: center;
            transition: all .18s;
            -webkit-tap-highlight-color: transparent;
        }
        .case-btn:hover, .case-btn.on { border-color: var(--blue); background: var(--blue-l); }
        .case-btn .ci { font-size: 1.3rem; display: block; margin-bottom: .3rem; }
        .case-btn .cl { font-size: .6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--g400); display: block; }
        .case-btn .cn { font-size: .78rem; font-weight: 600; color: var(--g800); display: block; margin-top: .12rem; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .9rem;
        }
        .field label {
            display: block;
            font-size: .78rem;
            font-weight: 500;
            color: var(--g600);
            margin-bottom: .38rem;
        }
        .field label code {
            font-family: 'JetBrains Mono', monospace;
            font-size: .72rem;
            color: var(--blue);
            background: var(--blue-l);
            padding: .08rem .28rem;
            border-radius: 3px;
        }
        .field select {
            width: 100%;
            background: var(--white);
            border: 1.5px solid var(--g300);
            border-radius: var(--rs);
            padding: .55rem .75rem;
            color: var(--g800);
            font-size: .85rem;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right .7rem center;
            background-size: 12px;
        }
        .field select:focus { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-l); }

        .range-row { display: flex; align-items: center; gap: .6rem; }
        .range-row input[type=range] {
            flex: 1;
            -webkit-appearance: none;
            appearance: none;
            height: 5px;
            border-radius: 99px;
            background: var(--g200);
            outline: none;
            cursor: pointer;
            min-width: 0;
        }
        .range-row input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px; height: 20px;
            border-radius: 50%;
            background: var(--blue);
            cursor: pointer;
            border: 3px solid var(--white);
            box-shadow: 0 1px 5px rgba(37,99,235,.4);
        }
        .range-row input[type=range]::-moz-range-thumb {
            width: 20px; height: 20px;
            border-radius: 50%;
            background: var(--blue);
            cursor: pointer;
            border: 3px solid var(--white);
        }
        .rval {
            font-family: 'JetBrains Mono', monospace;
            font-size: .8rem;
            font-weight: 600;
            color: var(--blue);
            min-width: 3rem;
            text-align: right;
            background: var(--blue-l);
            border-radius: 6px;
            padding: .18rem .45rem;
            flex-shrink: 0;
        }

        .alert-err {
            background: var(--red-l);
            border: 1px solid #fecaca;
            border-radius: var(--rs);
            padding: .85rem 1rem;
            margin-bottom: 1rem;
            font-size: .82rem;
            color: var(--red);
        }
        .alert-err ul { padding-left: 1.1rem; }

        .btn-run {
            width: 100%;
            margin-top: 1.35rem;
            padding: 1rem;
            background: var(--blue);
            color: var(--white);
            font-size: .95rem;
            font-weight: 700;
            border: none;
            border-radius: var(--rs);
            cursor: pointer;
            letter-spacing: .03em;
            transition: background .18s, box-shadow .18s;
            box-shadow: 0 4px 12px rgba(37,99,235,.35);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }
        .btn-run:hover { background: var(--blue-d); box-shadow: 0 6px 16px rgba(37,99,235,.45); }
        .btn-run:active { opacity: .9; }

        /* ── Resultado ── */
        .result-wrap {
            border-radius: var(--r);
            padding: 1.5rem;
            margin-top: 1.5rem;
            animation: fadeUp .35s ease;
        }
        @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
        .result-wrap.pos { background: var(--red-l); border: 2px solid #fca5a5; }
        .result-wrap.neg { background: var(--green-l); border: 2px solid #86efac; }

        .result-icon { text-align: center; font-size: 2.8rem; line-height: 1; margin-bottom: .65rem; }
        .result-label { text-align: center; font-size: 1.05rem; font-weight: 700; margin-bottom: 1.1rem; }
        .result-wrap.pos .result-label { color: var(--red); }
        .result-wrap.neg .result-label { color: var(--green); }

        .prob-label { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--g500); font-family: 'JetBrains Mono', monospace; margin-bottom: .4rem; }
        .prob-track { height: 12px; background: rgba(0,0,0,.08); border-radius: 99px; overflow: hidden; margin-bottom: .35rem; }
        .prob-fill { height: 100%; border-radius: 99px; transition: width 1.2s cubic-bezier(.4,0,.2,1); }
        .pos .prob-fill { background: linear-gradient(90deg, #fca5a5, var(--red)); }
        .neg .prob-fill { background: linear-gradient(90deg, #86efac, var(--green)); }
        .prob-nums { display: flex; justify-content: space-between; font-size: .72rem; color: var(--g500); font-family: 'JetBrains Mono', monospace; }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: .5rem;
            margin-top: 1.1rem;
        }
        .detail-item { background: rgba(255,255,255,.7); border-radius: var(--rs); padding: .55rem .65rem; }
        .detail-item .dk { font-size: .65rem; color: var(--g500); font-family: 'JetBrains Mono', monospace; display: block; }
        .detail-item .dv { font-size: .82rem; font-weight: 600; color: var(--g800); display: block; }

        .result-actions { display: flex; gap: .65rem; margin-top: 1.1rem; }
        .btn-sec {
            flex: 1;
            padding: .65rem;
            background: rgba(255,255,255,.8);
            border: 1.5px solid var(--g300);
            border-radius: var(--rs);
            font-size: .82rem;
            font-weight: 600;
            color: var(--g600);
            cursor: pointer;
            text-align: center;
            transition: all .15s;
            -webkit-tap-highlight-color: transparent;
        }
        .btn-sec:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-l); }

        .disclaimer { font-size: .7rem; color: var(--g400); text-align: center; margin-top: 1rem; font-style: italic; }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .page { padding: 1rem .75rem 5rem; }
            .hero { padding: 1.25rem 1rem; }
            .topbar-badge { display: none; }
            .tab-btn .ts { display: none; }
            .form-grid { grid-template-columns: 1fr; }
            .detail-grid { grid-template-columns: repeat(2, 1fr); }
            .result-actions { flex-direction: column; }
        }
        @media (max-width: 380px) {
            body { font-size: 14px; }
            .tab-btn { padding: .5rem .15rem; font-size: .65rem; }
            .tab-btn .ti { font-size: .95rem; }
            .tab-btn .tl { font-size: .58rem; }
            .hero h1 { font-size: .9rem; }
            .cases-grid { grid-template-columns: 1fr; gap: .4rem; }
            .case-btn { display: flex; align-items: center; gap: .65rem; text-align: left; padding: .75rem; }
            .case-btn .ci { margin: 0; font-size: 1.1rem; }
            .detail-grid { grid-template-columns: 1fr 1fr; }
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 601px) and (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr 1fr; }
            .detail-grid { grid-template-columns: repeat(3, 1fr); }
        }
    </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <span class="topbar-logo">🫀</span>
    <div class="topbar-info">
        <div class="ttitle">Heart Disease ML</div>
        <div class="tsub">proyecto_ML_heart_disease_V5.ipynb</div>
    </div>
    <span class="topbar-badge">KNN k=11 · F1=0.858</span>
</div>

<div class="page">

    <!-- Hero -->
    <div class="hero">
        <h1>Predicción de Enfermedades Cardíacas<br>mediante Aprendizaje Automático</h1>
        <div class="hero-pills">
            <span class="hero-pill">Materia: Aprendizaje Automático</span>
            <span class="hero-pill">UCI Heart Disease · Kaggle</span>
            <span class="hero-pill">302 instancias únicas</span>
            <span class="hero-pill">2025</span>
        </div>
    </div>

    <!-- Tab nav -->
    <div class="tab-nav" role="tablist">
        <button class="tab-btn" onclick="showTab('s1',this)" role="tab">
            <span class="ti">📋</span>
            <span class="tl">S1</span>
            <span class="ts">Problema</span>
        </button>
        <button class="tab-btn" onclick="showTab('s2',this)" role="tab">
            <span class="ti">📊</span>
            <span class="tl">S2</span>
            <span class="ts">Datos</span>
        </button>
        <button class="tab-btn" onclick="showTab('s3',this)" role="tab">
            <span class="ti">⚙️</span>
            <span class="tl">S3</span>
            <span class="ts">Preproceso</span>
        </button>
        <button class="tab-btn" onclick="showTab('s4',this)" role="tab">
            <span class="ti">🤖</span>
            <span class="tl">S4</span>
            <span class="ts">Modelos</span>
        </button>
        <button class="tab-btn active" onclick="showTab('s5',this)" role="tab">
            <span class="ti">🔬</span>
            <span class="tl">S5</span>
            <span class="ts">Aplicación</span>
        </button>
    </div>

    <!-- ══ S1 — Definición del Problema ══ -->
    <div id="tab-s1" class="panel">
        <div class="info-grid">
            <div class="info-card">
                <div class="ic-icon">🎯</div>
                <div class="ic-title">¿Qué se predice?</div>
                <div class="ic-text">Si un paciente <strong>tiene o no enfermedad cardíaca</strong> a partir de indicadores clínicos. Clasificación binaria: <strong>1</strong> = con enfermedad, <strong>0</strong> = sin enfermedad.</div>
            </div>
            <div class="info-card">
                <div class="ic-icon">🌍</div>
                <div class="ic-title">¿Por qué es importante?</div>
                <div class="ic-text">Las enfermedades cardiovasculares causan <strong>17.9 millones de muertes/año</strong> (OMS). En México son la <strong>primera causa de mortalidad general</strong>.</div>
            </div>
            <div class="info-card">
                <div class="ic-icon">🩺</div>
                <div class="ic-title">Apoyo al diagnóstico</div>
                <div class="ic-text">El sistema apoya al personal médico en el <strong>diagnóstico temprano</strong>, especialmente en zonas con acceso limitado a especialistas.</div>
            </div>
            <div class="info-card">
                <div class="ic-icon">🔬</div>
                <div class="ic-title">Enfoque del proyecto</div>
                <div class="ic-text">Se evaluaron <strong>4 algoritmos</strong> (Baseline, Árbol, KNN, SVM) con validación cruzada de <strong>10 pliegues</strong>. Métrica principal: <strong>F1-Score</strong>.</div>
            </div>
        </div>
        <div class="card">
            <div class="card-label">Variables del dataset — 14 atributos</div>
            <div class="table-wrap">
                <table class="model-table">
                    <thead>
                        <tr><th>#</th><th>Variable</th><th>Tipo</th><th>Descripción</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">age</code></td><td>Numérica continua</td><td>Edad del paciente (años)</td></tr>
                        <tr><td>2</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">sex</code></td><td>Binaria</td><td>1 = masculino, 0 = femenino</td></tr>
                        <tr><td>3</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">cp</code></td><td>Ordinal 0–3</td><td>Tipo de dolor en el pecho</td></tr>
                        <tr><td>4</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">trestbps</code></td><td>Numérica continua</td><td>Presión arterial reposo (mm Hg)</td></tr>
                        <tr><td>5</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">chol</code></td><td>Numérica continua</td><td>Colesterol sérico (mg/dl)</td></tr>
                        <tr><td>6</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">fbs</code></td><td>Binaria</td><td>Glucosa en ayunas &gt; 120 mg/dl</td></tr>
                        <tr><td>7</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">restecg</code></td><td>Ordinal 0–2</td><td>ECG en reposo</td></tr>
                        <tr><td>8</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rm;border-radius:3px">thalach</code></td><td>Numérica continua</td><td>FC máxima alcanzada (lpm)</td></tr>
                        <tr><td>9</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">exang</code></td><td>Binaria</td><td>Angina inducida por ejercicio</td></tr>
                        <tr><td>10</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">oldpeak</code></td><td>Numérica continua</td><td>Depresión del segmento ST</td></tr>
                        <tr><td>11</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">slope</code></td><td>Ordinal 0–2</td><td>Pendiente del segmento ST</td></tr>
                        <tr><td>12</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">ca</code></td><td>Discreta 0–4</td><td>Vasos coloreados (fluoroscopía)</td></tr>
                        <tr><td>13</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--blue-l);color:var(--blue);padding:.05rem .25rem;border-radius:3px">thal</code></td><td>Ordinal 0–3</td><td>Talasemia</td></tr>
                        <tr><td>14</td><td><code style="font-family:'JetBrains Mono',monospace;font-size:.75rem;background:var(--red-l);color:var(--red);padding:.05rem .25rem;border-radius:3px">target</code></td><td><strong>Variable objetivo</strong></td><td>1 = con enfermedad · 0 = sin enfermedad</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="obs s1">
            <h4>Observaciones — Sección 1</h4>
            <ul>
                <li>Problema de <strong>clasificación binaria supervisada</strong>.</li>
                <li>El sistema no reemplaza al médico — actúa como <strong>apoyo a la decisión clínica</strong>.</li>
                <li>Se priorizó el <strong>Recall</strong> para minimizar falsos negativos (no detectar enfermedad cuando sí existe).</li>
            </ul>
        </div>
    </div>

    <!-- ══ S2 — Datos ══ -->
    <div id="tab-s2" class="panel">
        <div class="stat-grid">
            <div class="stat-item"><div class="sv">1,025</div><div class="sl">Registros orig.</div></div>
            <div class="stat-item"><div class="sv">302</div><div class="sl">Únicas (dedup)</div></div>
            <div class="stat-item"><div class="sv">14</div><div class="sl">Atributos</div></div>
            <div class="stat-item"><div class="sv">0</div><div class="sl">Valores nulos</div></div>
            <div class="stat-item"><div class="sv">54.3%</div><div class="sl">Clase 1</div></div>
        </div>
        <div class="chart-card">
            <div class="chart-label">Distribución de la Variable Objetivo — target</div>
            <img src="<?= $s2_distribucion_target ?>" alt="Distribución target">
        </div>
        <div class="obs s2">
            <h4>Observaciones — Sección 2</h4>
            <ul>
                <li><strong>1,025 registros</strong> de Kaggle · 723 duplicados eliminados → <strong>302 instancias únicas</strong>.</li>
                <li>Distribución balanceada: <strong>164</strong> con enfermedad (54.3%) · <strong>138</strong> sin enfermedad (45.7%).</li>
                <li>Sin valores nulos. Variables numéricas continuas y categóricas mixtas.</li>
            </ul>
        </div>
    </div>

    <!-- ══ S3 — Preprocesamiento ══ -->
    <div id="tab-s3" class="panel">
        <div class="chart-card">
            <div class="chart-label">3.1 — Atípicos (IQR) · Boxplots variables continuas</div>
            <img src="<?= $s3_boxplots ?>" alt="Boxplots">
        </div>
        <div class="chart-card">
            <div class="chart-label">3.2 — Histogramas · Variables Numéricas Continuas</div>
            <img src="<?= $s3_histogramas ?>" alt="Histogramas">
        </div>
        <div class="chart-card">
            <div class="chart-label">3.2 — Distribución de Variables Categóricas</div>
            <img src="<?= $s3_categoricas ?>" alt="Categóricas">
        </div>
        <div class="chart-card">
            <div class="chart-label">3.2 — Matriz de Correlación (triángulo inferior)</div>
            <img src="<?= $s3_correlacion ?>" alt="Correlación">
        </div>
        <div class="chart-card">
            <div class="chart-label">3.2 — Variables Continuas según Clase (target)</div>
            <img src="<?= $s3_continuas_target ?>" alt="Continuas vs target">
        </div>
        <div class="chart-card">
            <div class="chart-label">3.4 — Selección de Características: ANOVA F-score ∩ Random Forest</div>
            <img src="<?= $s3_seleccion ?>" alt="Selección features">
        </div>
        <div class="obs s3">
            <h4>Observaciones — Sección 3</h4>
            <ul>
                <li><strong>Limpieza:</strong> Sin nulos. 723 duplicados eliminados. Atípicos conservados (médicamente plausibles).</li>
                <li><strong>EDA:</strong> <code>thalach</code>, <code>cp</code> y <code>ca</code> mayor separación entre clases.</li>
                <li><strong>Normalización:</strong> MinMaxScaler → <code>age, trestbps, chol, thalach, oldpeak</code>.</li>
                <li><strong>Selección:</strong> ANOVA (p&lt;0.05) ∩ RF (≥0.05) → <strong>9 features finales.</strong></li>
            </ul>
        </div>
    </div>

    <!-- ══ S4 — Modelos ══ -->
    <div id="tab-s4" class="panel">
        <div class="card">
            <div class="card-label">Tabla comparativa — CV-10 dobleces · StratifiedKFold · random_state=42</div>
            <div class="table-wrap">
                <table class="model-table">
                    <thead>
                        <tr><th>Modelo</th><th>Accuracy</th><th>Precision</th><th>Recall</th><th>F1-Score</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Baseline A — most_frequent</td><td class="lo">0.5430</td><td class="lo">0.5430</td><td class="lo">1.0000</td><td class="lo">0.7037</td></tr>
                        <tr><td>Baseline B — stratified</td><td class="lo">0.5426</td><td class="lo">0.5684</td><td class="lo">0.6588</td><td class="lo">0.6102</td></tr>
                        <tr><td>Árbol de Decisión — max_depth=3</td><td>0.7885</td><td>0.7730</td><td>0.8680</td><td>0.8151</td></tr>
                        <tr><td>Árbol de Decisión — max_depth=5</td><td>0.7554</td><td>0.7545</td><td>0.8250</td><td>0.7840</td></tr>
                        <tr><td>KNN Config A — k=5</td><td>0.8245</td><td>0.8153</td><td>0.8849</td><td>0.8457</td></tr>
                        <tr class="best"><td>KNN Config B — k=11 <span class="best-badge">★ MEJOR</span></td><td class="hi">0.8344</td><td class="hi">0.8126</td><td class="hi">0.9158</td><td class="hi">0.8580</td></tr>
                        <tr><td>SVM Config A — rbf C=1</td><td>0.8277</td><td>0.8016</td><td>0.9154</td><td>0.8521</td></tr>
                        <tr><td>SVM Config B — rbf C=10</td><td>0.8344</td><td>0.8192</td><td>0.9037</td><td>0.8559</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="chart-card">
            <div class="chart-label">4.5 — Comparativa de Métricas por Modelo (CV-10)</div>
            <img src="<?= $s4_comparativa ?>" alt="Comparativa modelos">
        </div>
        <div class="chart-card">
            <div class="chart-label">4.3 — KNN: F1-Score vs Número de Vecinos (k impares 1–21)</div>
            <img src="<?= $s4_knn_k ?>" alt="KNN k óptimo">
        </div>
        <div class="chart-card">
            <div class="chart-label">4.2 / 4.3 / 4.4 — Matrices de Confusión (mejores configuraciones)</div>
            <img src="<?= $s4_confusion ?>" alt="Matrices de confusión">
        </div>
        <div class="obs s4">
            <h4>Observaciones — Sección 4</h4>
            <ul>
                <li><strong>Baseline:</strong> Cota mínima ~54%. Todo modelo útil la supera.</li>
                <li><strong>Árbol depth=3</strong> (F1=0.815) supera a depth=5 (F1=0.784) en este dataset.</li>
                <li><strong>KNN k=11:</strong> Mejor F1 (0.858) y Recall (0.916) → modelo final seleccionado.</li>
                <li><strong>SVM:</strong> Muy competitivo, C=1 y C=10 similares (~0.852–0.856 F1).</li>
                <li><strong>F1-Score</strong> como métrica principal — equilibra FN y FP en contexto clínico.</li>
            </ul>
        </div>
    </div>

    <!-- ══ S5 — Aplicación ══ -->
    <div id="tab-s5" class="panel active">

        <div class="s5-hero">
            <h2>🔬 Predictor de Diagnóstico Cardíaco</h2>
            <p>Ingresa los datos clínicos del paciente para obtener la predicción del modelo.</p>
            <div class="s5-pills">
                <span class="s5-pill hl">KNN k=11</span>
                <span class="s5-pill">Distancia euclidiana</span>
                <span class="s5-pill">MinMaxScaler</span>
                <span class="s5-pill">n=302</span>
                <span class="s5-pill">9 features</span>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert-err">
            <ul><?php foreach ($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul>
        </div>
        <?php endif; ?>

        <p style="font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--g400);font-family:'JetBrains Mono',monospace;margin-bottom:.6rem;">// 5.2 Casos de prueba del notebook</p>
        <div class="cases-grid">
            <div class="case-btn" id="cb-A" onclick="fillCase('A')">
                <span class="ci">✅</span>
                <span class="cl">Paciente A</span>
                <span class="cn">Bajo riesgo</span>
            </div>
            <div class="case-btn" id="cb-B" onclick="fillCase('B')">
                <span class="ci">⚠️</span>
                <span class="cl">Paciente B</span>
                <span class="cn">Alto riesgo</span>
            </div>
            <div class="case-btn" id="cb-C" onclick="fillCase('C')">
                <span class="ci">❓</span>
                <span class="cl">Paciente C</span>
                <span class="cn">Caso límite</span>
            </div>
        </div>

        <form id="frm" action="<?= site_url('heart-disease/predict') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="section-divider">Variables numéricas continuas</div>
            <div class="form-grid">
                <div class="field">
                    <label>Edad del paciente (años)</label>
                    <div class="range-row">
                        <input type="range" id="r_age" min="21" max="80" step="1"
                               value="<?= esc($old['age'] ?? 54) ?>"
                               oninput="syn('age',this.value)">
                        <span class="rval" id="rv_age"><?= esc($old['age'] ?? 54) ?></span>
                    </div>
                    <input type="hidden" name="age" id="age" value="<?= esc($old['age'] ?? 54) ?>">
                </div>
                <div class="field">
                    <label>Presión arterial en reposo (mm Hg)</label>
                    <div class="range-row">
                        <input type="range" id="r_trestbps" min="81" max="210" step="1"
                               value="<?= esc($old['trestbps'] ?? 130) ?>"
                               oninput="syn('trestbps',this.value)">
                        <span class="rval" id="rv_trestbps"><?= esc($old['trestbps'] ?? 130) ?></span>
                    </div>
                    <input type="hidden" name="trestbps" id="trestbps" value="<?= esc($old['trestbps'] ?? 130) ?>">
                </div>
                <div class="field">
                    <label>Frecuencia cardíaca máxima alcanzada (latidos por minuto)</label>
                    <div class="range-row">
                        <input type="range" id="r_thalach" min="61" max="210" step="1"
                               value="<?= esc($old['thalach'] ?? 150) ?>"
                               oninput="syn('thalach',this.value)">
                        <span class="rval" id="rv_thalach"><?= esc($old['thalach'] ?? 150) ?></span>
                    </div>
                    <input type="hidden" name="thalach" id="thalach" value="<?= esc($old['thalach'] ?? 150) ?>">
                </div>
                <div class="field">
                    <label>Alteración del ritmo cardíaco en la prueba de esfuerzo (oldpeak)</label>
                    <div class="range-row">
                        <input type="range" id="r_oldpeak" min="0" max="6.5" step="0.1"
                               value="<?= esc($old['oldpeak'] ?? 1.0) ?>"
                               oninput="syn('oldpeak',this.value,true)">
                        <span class="rval" id="rv_oldpeak"><?= number_format((float)($old['oldpeak'] ?? 1.0),1) ?></span>
                    </div>
                    <input type="hidden" name="oldpeak" id="oldpeak" value="<?= esc($old['oldpeak'] ?? 1.0) ?>">
                </div>
            </div>

            <div class="section-divider">Variables categóricas / ordinales</div>
            <div class="form-grid">
                <div class="field">
                    <label><code>cp</code> — Tipo de dolor en el pecho</label>
                    <select name="cp" id="cp">
                        <option value="0" <?=(($old['cp']??'')==='0')?'selected':''?>>0 — Asintomático</option>
                        <option value="1" <?=(($old['cp']??'')==='1')?'selected':''?>>1 — Angina atípica</option>
                        <option value="2" <?=(($old['cp']??'')==='2')?'selected':''?>>2 — Dolor no anginoso</option>
                        <option value="3" <?=(($old['cp']??'')==='3')?'selected':''?>>3 — Angina típica</option>
                    </select>
                </div>
                <div class="field">
                    <label><code>ca</code> — Vasos coloreados (fluoroscopía)</label>
                    <select name="ca" id="ca">
                        <?php for($i=0;$i<=4;$i++): ?>
                        <option value="<?=$i?>" <?=(($old['ca']??'')==$i)?'selected':''?>><?=$i?> <?= $i===0?'(ninguno)':($i===1?'(uno)':($i===2?'(dos)':($i===3?'(tres)':'(cuatro)'))) ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="field">
                    <label><code>thal</code> — Talasemia</label>
                    <select name="thal" id="thal">
                        <option value="0" <?=(($old['thal']??'')==='0')?'selected':''?>>0 — Normal</option>
                        <option value="1" <?=(($old['thal']??'')==='1')?'selected':''?>>1 — Defecto fijo</option>
                        <option value="2" <?=(($old['thal']??'')==='2')?'selected':''?>>2 — Defecto reversible</option>
                        <option value="3" <?=(($old['thal']??'')==='3')?'selected':''?>>3 — Nulo</option>
                    </select>
                </div>
                <div class="field">
                    <label><code>exang</code> — Angina por ejercicio</label>
                    <select name="exang" id="exang">
                        <option value="0" <?=(($old['exang']??'')==='0')?'selected':''?>>No (0)</option>
                        <option value="1" <?=(($old['exang']??'')==='1')?'selected':''?>>Sí (1)</option>
                    </select>
                </div>
                <div class="field">
                    <label><code>slope</code> — Pendiente segmento ST</label>
                    <select name="slope" id="slope">
                        <option value="0" <?=(($old['slope']??'')==='0')?'selected':''?>>0 — Ascendente</option>
                        <option value="1" <?=(($old['slope']??'')==='1')?'selected':''?>>1 — Plano</option>
                        <option value="2" <?=(($old['slope']??'')==='2')?'selected':''?>>2 — Descendente</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-run">🔍 Predecir diagnóstico</button>
        </form>

        <!-- Resultado inline -->
        <?php if (isset($prediction)): ?>
        <?php
            $isPos   = ($prediction == 1);
            $boxCls  = $isPos ? 'pos' : 'neg';
            $icon    = $isPos ? '⚠️' : '✅';
            $label   = $isPos ? 'CON ENFERMEDAD CARDÍACA (clase 1)' : 'SIN ENFERMEDAD CARDÍACA (clase 0)';
            $pct     = round($probability * 100, 1);
            $cpLbl   = [0=>'Asintomático',1=>'Angina atípica',2=>'No anginoso',3=>'Angina típica'];
            $thalLbl = [0=>'Normal',1=>'Def. fijo',2=>'Def. reversible',3=>'Nulo'];
            $slopLbl = [0=>'Ascendente',1=>'Plano',2=>'Descendente'];
            $exLbl   = [0=>'No',1=>'Sí'];
        ?>
        <div class="result-wrap <?= $boxCls ?>" id="resultado">
            <div class="result-icon"><?= $icon ?></div>
            <div class="result-label"><?= $label ?></div>

            <div class="prob-label">Probabilidad clase 1 (con enfermedad)</div>
            <div class="prob-track">
                <div class="prob-fill" id="probFill" style="width:0%"></div>
            </div>
            <div class="prob-nums">
                <span>0%</span>
                <strong style="color:<?= $isPos?'var(--red)':'var(--green)' ?>"><?= $pct ?>%</strong>
                <span>100%</span>
            </div>

            <div class="detail-grid">
                <div class="detail-item"><span class="dk">age</span><span class="dv"><?= esc($input['age']) ?> años</span></div>
                <div class="detail-item"><span class="dk">trestbps</span><span class="dv"><?= esc($input['trestbps']) ?> mmHg</span></div>
                <div class="detail-item"><span class="dk">thalach</span><span class="dv"><?= esc($input['thalach']) ?> lpm</span></div>
                <div class="detail-item"><span class="dk">oldpeak</span><span class="dv"><?= esc($input['oldpeak']) ?></span></div>
                <div class="detail-item"><span class="dk">cp</span><span class="dv"><?= esc($cpLbl[$input['cp']] ?? '-') ?></span></div>
                <div class="detail-item"><span class="dk">ca</span><span class="dv"><?= esc($input['ca']) ?> vasos</span></div>
                <div class="detail-item"><span class="dk">thal</span><span class="dv"><?= esc($thalLbl[$input['thal']] ?? '-') ?></span></div>
                <div class="detail-item"><span class="dk">exang</span><span class="dv"><?= esc($exLbl[$input['exang']] ?? '-') ?></span></div>
                <div class="detail-item"><span class="dk">slope</span><span class="dv"><?= esc($slopLbl[$input['slope']] ?? '-') ?></span></div>
            </div>

            <div class="result-actions">
                <button class="btn-sec" onclick="window.print()">🖨️ Imprimir</button>
                <button class="btn-sec" onclick="limpiar()">↩ Nueva consulta</button>
            </div>
        </div>
        <?php endif; ?>

        <p class="disclaimer">⚕️ Resultado orientativo — no sustituye el diagnóstico médico profesional.</p>
    </div>

</div><!-- /page -->

<script>
var _active = 's5';

function showTab(id, btn) {
    document.querySelectorAll('.panel').forEach(function(p){ p.classList.remove('active'); });
    document.querySelectorAll('.tab-btn').forEach(function(b){ b.classList.remove('active'); });
    document.getElementById('tab-'+id).classList.add('active');
    btn.classList.add('active');
    _active = id;
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function syn(n, v, fl) {
    document.getElementById(n).value = v;
    document.getElementById('rv_'+n).textContent = fl ? parseFloat(v).toFixed(1) : v;
}

var CASES = {
    A: {age:45, trestbps:120, cp:'1', ca:'0', thal:'2', exang:'0', oldpeak:0.5, slope:'2', thalach:170},
    B: {age:65, trestbps:160, cp:'0', ca:'3', thal:'1', exang:'1', oldpeak:4.2, slope:'0', thalach:100},
    C: {age:55, trestbps:140, cp:'2', ca:'1', thal:'2', exang:'0', oldpeak:1.5, slope:'1', thalach:145}
};

function fillCase(k) {
    document.querySelectorAll('.case-btn').forEach(function(b){ b.classList.remove('on'); });
    document.getElementById('cb-'+k).classList.add('on');
    var c = CASES[k];
    ['age','trestbps','thalach'].forEach(function(f){
        document.getElementById('r_'+f).value = c[f];
        syn(f, c[f], false);
    });
    document.getElementById('r_oldpeak').value = c.oldpeak;
    syn('oldpeak', c.oldpeak, true);
    ['cp','ca','thal','exang','slope'].forEach(function(f){
        document.getElementById(f).value = c[f];
    });
}

function limpiar() {
    var r = document.getElementById('resultado');
    if (r) r.remove();
    document.getElementById('frm').reset();
    document.querySelectorAll('.case-btn').forEach(function(b){ b.classList.remove('on'); });
    // Reset sliders display
    syn('age', 54, false);
    syn('trestbps', 130, false);
    syn('thalach', 150, false);
    syn('oldpeak', 1.0, true);
    document.getElementById('r_age').value = 54;
    document.getElementById('r_trestbps').value = 130;
    document.getElementById('r_thalach').value = 150;
    document.getElementById('r_oldpeak').value = 1.0;
    window.scrollTo({top: document.getElementById('frm').offsetTop - 80, behavior: 'smooth'});
}

window.addEventListener('load', function() {
    <?php if (isset($prediction)): ?>
    // Activar S5 y animar barra
    document.querySelectorAll('.panel').forEach(function(p){ p.classList.remove('active'); });
    document.querySelectorAll('.tab-btn').forEach(function(b){ b.classList.remove('active'); });
    document.getElementById('tab-s5').classList.add('active');
    document.querySelectorAll('.tab-btn')[4].classList.add('active');
    setTimeout(function(){
        var fill = document.getElementById('probFill');
        if (fill) fill.style.width = '<?= $pct ?? 0 ?>%';
        var res = document.getElementById('resultado');
        if (res) res.scrollIntoView({behavior:'smooth', block:'nearest'});
    }, 250);
    <?php endif; ?>
});
</script>
</body>
</html>