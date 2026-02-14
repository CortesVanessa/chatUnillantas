<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotResponse;
use Illuminate\Http\Request;

class ChatbotResponseController extends Controller
{
    public function index()
    {
        $responses = ChatbotResponse::all();
        return view('admin.chatbot.index', compact('responses'));
    }

    public function create()
    {
        return view('admin.chatbot.create');
    }

    public function store(Request $request)
    {
        ChatbotResponse::create([
            'trigger' => $request->trigger,
            'reply' => $request->reply,
            'options' => $request->options ? explode(',', $request->options) : null,
        ]);

        return redirect()->route('chatbot.index')->with('success', 'Respuesta creada');
    }

    public function edit(ChatbotResponse $chatbot)
    {
        return view('admin.chatbot.edit', compact('chatbot'));
    }

    public function update(Request $request, ChatbotResponse $chatbot)
    {
        $chatbot->update([
            'trigger' => $request->trigger,
            'reply' => $request->reply,
            'options' => $request->options ? explode(',', $request->options) : null,
        ]);

        return redirect()->route('chatbot.index')->with('success', 'Respuesta actualizada');
    }

    public function destroy(ChatbotResponse $chatbot)
    {
        $chatbot->delete();
        return back()->with('success', 'Respuesta eliminada');
    }
}
