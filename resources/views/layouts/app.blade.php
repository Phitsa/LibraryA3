<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioSys — @yield('title', 'Sistema de Biblioteca')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f0e0c;
            --surface: #1a1815;
            --surface2: #242220;
            --border: #2e2b28;
            --gold: #c9a84c;
            --gold-light: #e8c97a;
            --text: #e8e4de;
            --text-muted: #857f75;
            --red: #c0392b;
            --green: #27ae60;
            --radius: 8px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* NAV */
        nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--gold);
            text-decoration: none;
            letter-spacing: 0.02em;
            margin-right: auto;
        }

        .nav-brand span { color: var(--text-muted); font-weight: 400; font-size: 0.9rem; }

        nav a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.4rem 0.8rem;
            border-radius: var(--radius);
            transition: all 0.2s;
        }

        nav a:hover, nav a.active {
            color: var(--gold);
            background: rgba(201, 168, 76, 0.1);
        }

        /* MAIN */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
        }

        /* PAGE HEADER */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text);
        }

        .page-header h1 span { color: var(--gold); }

        /* CARDS */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.2rem;
        }

        .livro-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.4rem;
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
        }

        .livro-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px;
            height: 100%;
            background: var(--gold);
            opacity: 0;
            transition: opacity 0.25s;
        }

        .livro-card:hover { border-color: var(--gold); transform: translateY(-2px); }
        .livro-card:hover::before { opacity: 1; }

        .livro-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            margin-bottom: 0.3rem;
            color: var(--text);
        }

        .livro-card .autor {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .livro-card .meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
        }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.7rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-green { background: rgba(39, 174, 96, 0.15); color: #2ecc71; border: 1px solid rgba(39,174,96,0.3); }
        .badge-red { background: rgba(192, 57, 43, 0.15); color: #e74c3c; border: 1px solid rgba(192,57,43,0.3); }
        .badge-gold { background: rgba(201, 168, 76, 0.15); color: var(--gold); border: 1px solid rgba(201,168,76,0.3); }
        .badge-gray { background: rgba(133, 127, 117, 0.15); color: var(--text-muted); border: 1px solid var(--border); }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary {
            background: var(--gold);
            color: #0f0e0c;
        }
        .btn-primary:hover { background: var(--gold-light); }

        .btn-outline {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { border-color: var(--gold); color: var(--gold); }

        .btn-danger {
            background: rgba(192, 57, 43, 0.15);
            color: #e74c3c;
            border: 1px solid rgba(192,57,43,0.3);
        }
        .btn-danger:hover { background: rgba(192, 57, 43, 0.3); }

        .btn-sm { padding: 0.35rem 0.8rem; font-size: 0.8rem; }

        /* FORMS */
        .form-group { margin-bottom: 1.2rem; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 0.7rem 1rem;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--gold);
        }

        select option { background: var(--surface2); }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        thead th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:hover { background: var(--surface2); }
        tbody td { padding: 0.9rem 1rem; }

        /* ALERTS */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .alert-success { background: rgba(39,174,96,0.1); border: 1px solid rgba(39,174,96,0.3); color: #2ecc71; }
        .alert-error   { background: rgba(192,57,43,0.1); border: 1px solid rgba(192,57,43,0.3); color: #e74c3c; }

        /* ALGO BADGE — destaque didático para apresentação */
        .algo-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(201,168,76,0.08);
            border: 1px solid rgba(201,168,76,0.25);
            color: var(--gold);
            border-radius: 4px;
            padding: 0.2rem 0.6rem;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* STATS */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.2rem 1.4rem;
        }

        .stat-card .label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
        }

        .stat-card .value {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold);
        }

        /* SEARCH */
        .search-bar {
            display: flex;
            gap: 0.7rem;
            margin-bottom: 2rem;
            align-items: center;
        }

        .search-bar input {
            flex: 1;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 0.7rem 1rem;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--gold);
        }

        .search-info {
            background: rgba(201,168,76,0.05);
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: var(--radius);
            padding: 0.7rem 1rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .queue-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.7rem 0;
            border-bottom: 1px solid var(--border);
        }

        .queue-pos {
            width: 32px;
            height: 32px;
            background: var(--gold);
            color: var(--bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
                /* PAGINATION */
        nav[role="navigation"] {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        nav[role="navigation"] > div {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        nav[role="navigation"] a,
        nav[role="navigation"] span {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text-muted);
            padding: 0.45rem 0.8rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        nav[role="navigation"] a:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        nav[role="navigation"] .relative.inline-flex.items-center {
            min-width: 36px;
            min-height: 36px;
            justify-content: center;
        }

        nav[role="navigation"] svg {
            width: 16px;
            height: 16px;
        }

        nav[role="navigation"] span[aria-current="page"] span {
            background: var(--gold);
            color: var(--bg);
            border-color: var(--gold);
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('livros.index') }}" class="nav-brand">
            📚 BiblioSys <span>Sistema de Biblioteca</span>
        </a>
        <a href="{{ route('livros.index') }}" class="{{ request()->routeIs('livros.*') ? 'active' : '' }}">Acervo</a>
        <a href="{{ route('emprestimos.index') }}" class="{{ request()->routeIs('emprestimos.*') ? 'active' : '' }}">Empréstimos</a>
        <a href="{{ route('livros.create') }}" class="{{ request()->routeIs('livros.create') ? 'active' : '' }}">+ Novo Livro</a>
        <a href="{{ route('emprestimos.create') }}" class="{{ request()->routeIs('emprestimos.create') ? 'active' : '' }}">+ Emprestar</a>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">⚠ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
