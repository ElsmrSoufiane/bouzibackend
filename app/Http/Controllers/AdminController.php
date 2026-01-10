<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\CallLink;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dans AdminController.php, ajoutez :
public function create()
{
    return view('sessions.create'); // Vous devrez créer cette vue
}
    // Page d'accueil admin
    public function index()
    {
        
        $courses = Session::with('callLink')
            ->orderBy('datetime', 'desc')
            ->paginate(10);
        
        return view('admin', compact('courses'));
    }
    
    // Stocker une nouvelle session
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'datetime' => 'required|date',
            'description' => 'required|string',
            'plan_type' => 'required|in:group,individual,both'
        ]);
        
        Session::create([
            'title' => $request->title,
            'course' => $request->course,
            'datetime' => $request->datetime,
            'description' => $request->description,
            'plan_type' => $request->plan_type,
            'duration_minutes' => 120
        ]);
        
        return redirect()->route('admin')
            ->with('success', 'Session créée avec succès');
    }
    
    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $session = Session::findOrFail($id);
        return view('edit', compact('session'));
    }
    
    // Mettre à jour une session
    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'datetime' => 'required|date',
            'description' => 'required|string',
            'plan_type' => 'required|in:group,individual,both'
        ]);
        
        $session->update($request->all());
        
        return redirect()->route('admin')
            ->with('success', 'Session mise à jour');
    }
    
    // Supprimer une session
    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();
        
        return redirect()->route('admin')
            ->with('success', 'Session supprimée');
    }
    
    // Stocker un lien d'appel
    public function storeCallLink(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|in:zoom,google_meet,teams',
            'meeting_id' => 'required|string',
            'join_url' => 'required|url',
            'meeting_password' => 'nullable|string'
        ]);
        
        // Désactiver les anciens liens
        CallLink::where('session_id', $id)
                ->update(['is_active' => false]);
        
        // Créer le nouveau lien
        CallLink::create([
            'session_id' => $id,
            'platform' => $request->platform,
            'meeting_id' => $request->meeting_id,
            'join_url' => $request->join_url,
            'meeting_password' => $request->meeting_password,
            'is_active' => true
        ]);
        
        return redirect()->route('admin')
            ->with('success', 'Lien d\'appel enregistré');
    }
    
    // API: Récupérer toutes les sessions
    public function getSessions()
    {
        $sessions = Session::with('callLink')
            ->orderBy('datetime', 'asc')
            ->get()
            ->map(function($session) {
                return [
                    'id' => $session->id,
                    'titre' => $session->title,
                    'cours' => $session->course,
                    'date' => $session->datetime->toISOString(),
                    'description' => $session->description,
                    'plan' => $session->plan_type,
                    'call_link' => $session->callLink ? [
                        'join_url' => $session->callLink->join_url,
                        'meeting_id' => $session->callLink->meeting_id,
                        'platform' => $session->callLink->platform
                    ] : null
                ];
            });
        
        return response()->json($sessions);
    }
    
    // API: Créer une session
    public function createSession(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'datetime' => 'required|date',
            'description' => 'required|string',
            'plan_type' => 'required|in:group,individual,both'
        ]);
        
        $session = Session::create($request->all());
        
        return response()->json([
            'message' => 'Session créée avec succès',
            'session' => $session
        ]);
    }
    
    // API: Mettre à jour un lien d'appel
    public function updateCallLink(Request $request, $sessionId)
    {
        $request->validate([
            'platform' => 'required|in:zoom,google_meet,teams',
            'meeting_id' => 'required|string',
            'join_url' => 'required|url',
            'meeting_password' => 'nullable|string'
        ]);
        
        CallLink::where('session_id', $sessionId)
                ->update(['is_active' => false]);
        
        $callLink = CallLink::create([
            'session_id' => $sessionId,
            'platform' => $request->platform,
            'meeting_id' => $request->meeting_id,
            'join_url' => $request->join_url,
            'meeting_password' => $request->meeting_password,
            'is_active' => true
        ]);
        
        return response()->json([
            'message' => 'Lien d\'appel enregistré',
            'call_link' => $callLink
        ]);
    }
    
    // API: Récupérer un lien d'appel
    public function getCallLink($sessionId)
    {
        $callLink = CallLink::where('session_id', $sessionId)
                          ->where('is_active', true)
                          ->first();
        
        if (!$callLink) {
            return response()->json([
                'message' => 'Aucun lien d\'appel actif'
            ], 404);
        }
        
        return response()->json($callLink);
    }
}