<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\ChatbotResponse;
use Illuminate\Support\Str;
use App\Models\Cita;
use App\Models\Solicitud;
use Carbon\Carbon;

class ChatbotController extends Controller
{

public function whatsappMessage(Request $request)
{
    $message = strtolower(trim($request->message));
    $phone = $request->phone;

    // guardar mensaje usuario
    ChatMessage::create([
        'session_id' => $phone,
        'sender' => 'user',
        'message' => $message
    ]);

    // buscar respuesta
    $response = ChatbotResponse::where('active', true)
        ->where('trigger', $message)
        ->first();

    if (!$response) {
        $response = ChatbotResponse::where('active', true)
            ->whereRaw('? like concat("%", trigger, "%")', [$message])
            ->first();
    }

    if (!$response) {
        $reply = "🤖 No entendí tu mensaje. Opciones:\n• Citas\n• Llantas\n• Asesor";
    } else {
        $reply = $response->reply;
    }

    // guardar respuesta
    ChatMessage::create([
        'session_id' => $phone,
        'sender' => 'bot',
        'message' => $reply
    ]);

    return response()->json([
        'reply' => $reply
    ]);
}
   
  public function index(Request $request)
{
    $sessionId = $request->session()->get('chat_session');

    if (!$sessionId) {
        $sessionId = Str::uuid();
        $request->session()->put('chat_session', $sessionId);

        ChatMessage::create([
            'session_id' => $sessionId,
            'sender' => 'bot',
            'message' => 'Hola 👋 Bienvenid@ a UNILLANTAS DE OAXACA,¿En que te podemos ayudar?'
        ]);
    }

    // cargar todos los mensajes de esta sesión
    $messages = ChatMessage::where('session_id', $sessionId)
                ->orderBy('created_at', 'asc')
                ->get();

    //return view('chatbot.chat', compact('messages'));
    return view('admin.chatbot.chat', compact('messages'));

}
/////////////////////////////////////////////////
public function update(Request $request, $id)
{
    $chatbot = ChatbotResponse::findOrFail($id);

    $chatbot->update([
        'trigger' => $request->trigger,
        'reply'   => $request->reply,
        'options' => $request->options
            ? array_map('trim', explode(',', $request->options))
            : []
    ]);

    return redirect()
        ->route('chatbot.index')
        ->with('success', 'Respuesta actualizada correctamente.');
}



/////////////////////////////////////////////////////////
    public function send(Request $request)
    {
        return $this->handleMessage($request);
    }

    
public function handleMessage(Request $request)
{
    $sessionId = $request->session()->get('chat_session');
    $step = session('chat_step');

    if (!$sessionId) {
        $sessionId = Str::uuid();
        $request->session()->put('chat_session', $sessionId);
    }

    $message = strtolower(trim($request->message));

    // guardar mensaje del usuario
    ChatMessage::create([
        'session_id' => $sessionId,
        'sender' => 'user',
        'message' => $message
    ]);

    // buscar respuesta exacta primero
    $response = ChatbotResponse::where('active', true)
        ->where('trigger', $message)
        ->first();

    // si no encuentra exacto, buscar parcial
    if (!$response) {
        $response = ChatbotResponse::where('active', true)
           ->whereRaw('? like concat("%", trigger, "%")', [$message])
            ->first();
    }

    // respuesta por defecto
    if (!$response) {
        $reply = "🤖 No entendí tu mensaje. Elige una opción:";
        $options = ['Citas', 'Llantas', 'Hablar con asesor'];
    } else {
        $reply = $response->reply;
        $options = $response->options ?? [];
    }

    // guardar respuesta del bot
    ChatMessage::create([
        'session_id' => $sessionId,
        'sender' => 'bot',
        'message' => $reply
    ]);

    return response()->json([
        'reply' => $reply,
        'options' => $options


    ]);


}



   

public function publicChat(Request $request)
{
    // Crear un nuevo chat único cada vez que alguien accede
    $sessionId = (string) Str::uuid();
    session(['chat_session' => $sessionId]);

    // Opciones del menú
    $menuOptions = [
        'Agendar cita',
        'Solicitud de llantas'
    ];
    // Mensaje inicial del bot
    ChatMessage::create([
        'session_id' => $sessionId,
        'sender' => 'bot',
        'message' => 'Hola 👋Bienvenid@ somos unillantas de oaxaca,¿En que podemos servirte?',
        
    ]);

    // Cargar mensajes (solo el inicial)
    $messages = ChatMessage::where('session_id', $sessionId)
                ->orderBy('created_at', 'asc')
                ->get();

    // Usar tu vista actual del chat
   return view('admin.chatbot.chat', compact('messages', 'menuOptions'));
}




///////////////////

}
