<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Session - Admin DeutschMohammed</title>
    <style>
        body { 
            font-family: Arial; 
            padding: 20px; 
            max-width: 800px; 
            margin: 0 auto;
            background: #f5f5f5;
        }
        .header { 
            background: #CC0000; 
            color: white; 
            padding: 20px; 
            border-radius: 10px; 
            margin-bottom: 30px; 
            position: relative;
        }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            font-size: 16px;
        }
        textarea { height: 100px; resize: vertical; }
        .btn { 
            background: #CC0000; 
            color: white; 
            border: none; 
            padding: 12px 25px; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary { 
            background: #666; 
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        /* Bouton retour */
        .back-btn {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✏️ Modifier la session</h1>
        <a href="{{ route('admin') }}" class="back-btn">← Retour au tableau de bord</a>
    </div>
    
    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    ❌ {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.sessions.update', $session->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Titre de la session *</label>
                <input type="text" id="title" name="title" 
                       value="{{ old('title', $session->title) }}" 
                       placeholder="Ex: Introduction à l'allemand" required>
            </div>
            
            <div class="form-group">
                <label for="course">Cours *</label>
                <input type="text" id="course" name="course" 
                       value="{{ old('course', $session->course) }}" 
                       placeholder="Ex: A1 Débutant" required>
            </div>
            
            <div class="form-group">
                <label for="datetime">Date et heure *</label>
                <input type="datetime-local" id="datetime" name="datetime" 
                       value="{{ old('datetime', $session->datetime->format('Y-m-d\TH:i')) }}" required>
            </div>
            
            <div class="form-group">
                <label for="plan_type">Type de session *</label>
                <select id="plan_type" name="plan_type" required>
                    <option value="group" {{ old('plan_type', $session->plan_type) == 'group' ? 'selected' : '' }}>Groupe</option>
                    <option value="individual" {{ old('plan_type', $session->plan_type) == 'individual' ? 'selected' : '' }}>Individuel</option>
                    <option value="both" {{ old('plan_type', $session->plan_type) == 'both' ? 'selected' : '' }}>Les deux</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" 
                          placeholder="Description détaillée de la session..." 
                          required>{{ old('description', $session->description) }}</textarea>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn">💾 Mettre à jour</button>
                <a href="{{ route('admin') }}" class="btn-secondary">❌ Annuler</a>
            </div>
        </form>
    </div>
    
    <script>
        // Initialiser le datetime-local si vide
        window.onload = function() {
            const datetimeInput = document.getElementById('datetime');
            if (datetimeInput && !datetimeInput.value) {
                const now = new Date();
                const formattedNow = now.toISOString().slice(0, 16);
                datetimeInput.value = formattedNow;
            }
        };
    </script>
</body>
</html>