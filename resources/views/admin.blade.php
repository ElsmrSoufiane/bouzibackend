<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DeutschMohammed - Gestion des Cours</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --warning-color: #f39c12;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 20px;
            padding-bottom: 50px;
        }
        
        /* Header Styles */
        .admin-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            position: relative;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .header-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .header-icon {
            font-size: 2.2rem;
            color: var(--secondary-color);
            background: white;
            padding: 12px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .header-text h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
            color: white;
        }
        
        .header-text p {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 0;
            color: var(--light-color);
        }
        
        /* Logout Button */
        .logout-btn {
            background: white;
            color: var(--accent-color) !important;
            border: 2px solid white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .logout-btn:hover {
            background: var(--accent-color);
            color: white !important;
            border-color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Stats Cards */
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: transform 0.3s ease;
            border-left: 5px solid var(--secondary-color);
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-card i {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .stats-card h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stats-card p {
            color: #666;
            margin-bottom: 0;
        }
        
        /* Table Styling */
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .table-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
        }
        
        .add-btn {
            background: var(--success-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .add-btn:hover {
            background: #219653;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        
        .action-btn {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            margin: 0 3px;
            transition: all 0.2s ease;
        }
        
        .edit-btn {
            background: var(--warning-color);
            color: white;
            border: none;
        }
        
        .edit-btn:hover {
            background: #e67e22;
            color: white;
        }
        
        .delete-btn {
            background: var(--accent-color);
            color: white;
            border: none;
        }
        
        .delete-btn:hover {
            background: #c0392b;
            color: white;
        }
        
        .zoom-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s ease;
        }
        
        .zoom-btn:hover {
            background: #2980b9;
            color: white;
            text-decoration: none;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-active {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }
        
        .status-pending {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }
        
        .status-cancelled {
            background: rgba(231, 76, 60, 0.1);
            color: var(--accent-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .header-title {
                justify-content: center;
            }
            
            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
        }
        
        /* Alert Messages */
        .alert-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state h4 {
            color: #777;
            margin-bottom: 10px;
        }
        
        /* ========== NOUVEAUX STYLES POUR LES FORMULAIRES DE LIEN D'APPEL ========== */
        
        /* Pour les formulaires de lien d'appel */
        .hidden {
            display: none !important;
        }

        .call-link-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 15px;
            border: 1px solid #dee2e6;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .call-link-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .call-link-form .form-group {
            margin-bottom: 15px;
        }

        .call-link-form label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
            font-size: 0.9rem;
            display: block;
        }

        .call-link-form input,
        .call-link-form select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .call-link-form input:focus,
        .call-link-form select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }
        
        /* Style pour les boutons d'action */
        .btn-action {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            margin: 0 3px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-link {
            background: var(--secondary-color);
            color: white;
        }
        
        .btn-link:hover {
            background: #2980b9;
        }
        
        .btn-edit {
            background: var(--warning-color);
            color: white;
        }
        
        .btn-edit:hover {
            background: #e67e22;
        }
        
        .btn-delete {
            background: var(--accent-color);
            color: white;
        }
        
        .btn-delete:hover {
            background: #c0392b;
        }
        
        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    @if(session('success'))
    <div class="alert-container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert-container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="main-container">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-content">
                <div class="header-title">
                    <div class="header-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="header-text">
                        <h1>🛠️ Admin DeutschMohammed</h1>
                        <p>Gérez l'emploi du temps et les liens d'appel Zoom/Meet</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion ({{ Auth::user()->name }})
                    </button>
                </form>
            </div>
        </header>

        <!-- Stats Section -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>{{ $courses->where('status', 'active')->count() }}</h3>
                    <p>Cours Actifs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-clock"></i>
                    <h3>{{ $courses->where('status', 'pending')->count() }}</h3>
                    <p>Cours en Attente</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-users"></i>
                    <h3>{{ $courses->count() }}</h3>
                    <p>Total des Cours</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-video"></i>
                    <h3>{{ $courses->whereNotNull('meeting_link')->count() }}</h3>
                    <p>Avec Lien de Réunion</p>
                </div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-list me-2"></i> Liste des Cours</h2>
                <a href="{{ route('admin.sessions.create') }}" class="add-btn">
                    <i class="fas fa-plus"></i> Ajouter un Cours
                </a>
            </div>

            @if($courses->count() > 0)
            <div class="table-responsive">
                <table id="coursesTable" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Titre du Cours</th>
                            <th>Date & Heure</th>
                            <th>Durée</th>
                            <th>Type</th>
                            <th>Lien Réunion</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td><strong>#{{ $course->id }}</strong></td>
                            <td>
                                <div class="fw-bold">{{ $course->title }}</div>
                                <small class="text-muted">{{ $course->description ? Str::limit($course->description, 50) : 'Pas de description' }}</small>
                            </td>
                            <td>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($course->date_time)->format('d/m/Y') }}</div>
                                <div class="text-muted">{{ \Carbon\Carbon::parse($course->date_time)->format('H:i') }}</div>
                            </td>
                            <td>{{ $course->duration }} min</td>
                            <td>
                                @if($course->type == 'zoom')
                                <span class="badge bg-primary"><i class="fab fa-zoom me-1"></i> Zoom</span>
                                @elseif($course->type == 'meet')
                                <span class="badge bg-success"><i class="fab fa-google me-1"></i> Meet</span>
                                @else
                                <span class="badge bg-secondary">Présentiel</span>
                                @endif
                            </td>
                           <td>
    @if($course->callLink)
    <a href="{{ $course->callLink->join_url }}" target="_blank" class="zoom-btn">
        <i class="fas fa-external-link-alt me-1"></i> Rejoindre
    </a>
    <br>
    <small class="text-muted">
        <i class="fas fa-{{ $course->callLink->platform == 'zoom' ? 'video' : 'video' }} me-1"></i>
        {{ $course->callLink->platform }}
    </small>
    @else
    <span class="text-muted">-</span>
    @endif
</td>
                            <td>
                                @if($course->status == 'active')
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle me-1"></i> Actif
                                </span>
                                @elseif($course->status == 'pending')
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock me-1"></i> En attente
                                </span>
                                @else
                                <span class="status-badge status-cancelled">
                                    <i class="fas fa-times-circle me-1"></i> Annulé
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Bouton pour ouvrir le formulaire de lien d'appel -->
                                    <button type="button" onclick="showCallLinkForm({{ $course->id }})"
                                            class="btn-action btn-link">
                                        <i class="fas fa-link"></i> Lien
                                    </button>
                                    
                                    <!-- Lien pour modifier la session -->
                                    <a href="{{ route('admin.sessions.edit', $course->id) }}" 
                                       class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <!-- Formulaire pour supprimer -->
                                    <form method="POST" action="{{ route('admin.sessions.destroy', $course->id) }}" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Supprimer cette session ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Formulaire inline pour lien d'appel (caché par défaut) -->
                                <div id="callLinkForm-{{ $course->id }}" class="call-link-section hidden">
                              
                                    <form method="POST" action="/admin/sessions/{{$course->id}}/call-link">
                                        @csrf
                                        <h5 class="mb-3"><i class="fas fa-video me-2"></i>Configurer le lien d'appel</h5>
                                        
                                        <div class="call-link-form">
                                            <div class="form-group">
                                                <label>Platform *</label>
                                                <select name="platform" class="form-control" required>
                                                    <option value="zoom" {{ $course->meeting_link && str_contains($course->meeting_link, 'zoom') ? 'selected' : '' }}>
                                                        Zoom
                                                    </option>
                                                    <option value="google_meet" {{ $course->meeting_link && str_contains($course->meeting_link, 'meet.google.com') ? 'selected' : '' }}>
                                                        Google Meet
                                                    </option>
                                                    <option value="teams" {{ $course->meeting_link && str_contains($course->meeting_link, 'teams.microsoft.com') ? 'selected' : '' }}>
                                                        Teams
                                                    </option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Meeting ID *</label>
                                                <input type="text" name="meeting_id" class="form-control"
                                                       value="{{ $course->meeting_id ?? '' }}"
                                                       placeholder="Ex: 123 456 7890" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Mot de passe (optionnel)</label>
                                                <input type="text" name="meeting_password" class="form-control"
                                                       value="{{ $course->meeting_password ?? '' }}"
                                                       placeholder="Ex: 123456">
                                            </div>
                                            
                                            <div class="form-group" style="grid-column: span 2;">
                                                <label>URL de participation *</label>
                                                <input type="url" name="join_url" class="form-control"
                                                       value="{{ $course->meeting_link ?? '' }}"
                                                       placeholder="https://zoom.us/j/123456789" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-buttons">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-2"></i> Sauvegarder
                                            </button>
                                            <button type="button" onclick="hideCallLinkForm({{ $course->id }})" 
                                                    class="btn btn-secondary">
                                                <i class="fas fa-times me-2"></i> Annuler
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h4>Aucun cours programmé</h4>
                <p>Commencez par ajouter votre premier cours</p>
                <a href="{{ route('admin.sessions.create') }}" class="add-btn mt-3">
                    <i class="fas fa-plus"></i> Ajouter un Cours
                </a>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <footer class="text-center mt-5 mb-4">
            <p class="text-muted">
                <i class="fas fa-copyright"></i> {{ date('Y') }} DeutschMohammed Admin Panel 
                | Version 1.0
            </p>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#coursesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                },
                "order": [[2, 'asc']],
                "pageLength": 10,
                "responsive": true
            });

            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);

            // Copy meeting link to clipboard
            $('.copy-link').click(function(e) {
                e.preventDefault();
                var link = $(this).data('link');
                navigator.clipboard.writeText(link).then(function() {
                    var btn = $(e.target);
                    btn.html('<i class="fas fa-check"></i> Copié!');
                    setTimeout(function() {
                        btn.html('<i class="fas fa-copy"></i> Copier');
                    }, 2000);
                });
            });
        });
        
        // ========== FONCTIONS POUR LES FORMULAIRES DE LIEN D'APPEL ==========
        
        // Afficher le formulaire de lien d'appel
        function showCallLinkForm(courseId) {
            // Masquer tous les autres formulaires d'abord
            document.querySelectorAll('.call-link-section').forEach(form => {
                form.classList.add('hidden');
            });
            
            // Afficher le formulaire demandé
            document.getElementById(`callLinkForm-${courseId}`).classList.remove('hidden');
            
            // Faire défiler jusqu'au formulaire
            document.getElementById(`callLinkForm-${courseId}`).scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
        
        // Masquer le formulaire de lien d'appel
        function hideCallLinkForm(courseId) {
            document.getElementById(`callLinkForm-${courseId}`).classList.add('hidden');
        }
        
        // Auto-remplir l'URL basée sur la plateforme et l'ID
        document.addEventListener('change', function(e) {
            if (e.target.name === 'platform') {
                const form = e.target.closest('form');
                const platform = e.target.value;
                const meetingIdInput = form.querySelector('input[name="meeting_id"]');
                const joinUrlInput = form.querySelector('input[name="join_url"]');
                
                if (meetingIdInput.value && !joinUrlInput.value) {
                    const cleanId = meetingIdInput.value.replace(/\s/g, '');
                    
                    if (platform === 'zoom') {
                        joinUrlInput.value = `https://zoom.us/j/${cleanId}`;
                    } else if (platform === 'google_meet') {
                        joinUrlInput.value = `https://meet.google.com/${cleanId}`;
                    }
                }
            }
        });
        
        // Initialiser le datetime-local avec l'heure actuelle
        window.onload = function() {
            const now = new Date();
            const formattedNow = now.toISOString().slice(0, 16);
            const datetimeInput = document.querySelector('input[type="datetime-local"]');
            if (datetimeInput && !datetimeInput.value) {
                datetimeInput.value = formattedNow;
            }
        };
    </script>
</body>
</html>