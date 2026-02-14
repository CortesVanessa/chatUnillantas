<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatConversationController extends Controller
{
    public function index()
    {
        // Agrupar chats por sesión (usuario)
        $sessions = ChatMessage::select('session_id')
            ->groupBy('session_id')
            ->orderByDesc('id')
            ->get();

        return view('admin.chat.conversations', compact('sessions'));
    }

    public function show($session_id)
    {
        $messages = ChatMessage::where('session_id', $session_id)
            ->orderBy('created_at')
            ->get();

        return view('admin.chat.show', compact('messages', 'session_id'));
    }
}
