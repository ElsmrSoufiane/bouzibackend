<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une session - Admin DeutschMohammed</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 800px; margin: 0 auto; }
        .header { background: #CC0000; color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        textarea { height: 100px; resize: vertical; }
        .btn { background: #CC0000; color: white; border: none; padding: 12px 25px; border-radius: 5px; cursor: pointer; }
        .btn-secondary { background: #666; margin-left: 10px; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="header">
        <h1>➕ Créer une nouvelle session</h1>
        <a href="{{ route('admin') }}" style="color: white; text-decoration: none;">← Retour au tableau de bord</a>
    </div>
    
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                ❌ {{ $error }}<br>
            @endforeach
        </div>
    @endif
    
    <form method="POST" action="{{ route('admin.sessions.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="title">Titre de la session *</label>
            <input type="text" id="title" name="title" 
                   value="{{ old('title') }}" 
                   placeholder="Ex: Introduction à l'allemand" required>
        </div>
        
        <div class="form-group">
            <label for="course">Cours *</label>
            <input type="text" id="course" name="course" 
                   value="{{ old('course') }}" 
                   placeholder="Ex: A1 Débutant" required>
        </div>
        
        <div class="form-group">
            <label for="datetime">Date et heure *</label>
            <input type="datetime-local" id="datetime" name="datetime" 
                   value="{{ old('datetime') }}" required>
        </div>
        
        <div class="form-group">
            <label for="plan_type">Type de session *</label>
            <select id="plan_type" name="plan_type" required>
                <option value="group" {{ old('plan_type') == 'group' ? 'selected' : '' }}>Groupe</option>
                <option value="individual" {{ old('plan_type') == 'individual' ? 'selected' : '' }}>Individuel</option>
                <option value="both" {{ old('plan_type') == 'both' ? 'selected' : '' }}>Les deux</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" 
                      placeholder="Description détaillée de la session..." 
                      required>{{ old('description') }}</textarea>
        </div>
        
        <div>
            <button type="submit" class="btn">💾 Créer la session</button>
            <a href="{{ route('admin') }}" class="btn btn-secondary">❌ Annuler</a>
        </div>
    </form>
    
    <script>
        // Initialiser le datetime-local avec l'heure actuelle
        window.onload = function() {
            const now = new Date();
            const formattedNow = now.toISOString().slice(0, 16);
            const datetimeInput = document.getElementById('datetime');
            if (datetimeInput && !datetimeInput.value) {
                datetimeInput.value = formattedNow;
            }
        };
    </script>
</body>
</html>