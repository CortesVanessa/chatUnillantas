<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\ChatbotResponse;
use Illuminate\Support\Str;
use App\Models\Cita;
use App\Models\Solicitude;
use Carbon\Carbon;

class ChatbotController extends Controller
{

public function whatsappMessage(Request $request)
{
    $message = strtolower(trim($request->message));
    $phone = $request->phone;
  $step = session('chat_step');
    // guardar mensaje usuario
    ChatMessage::create([
        'session_id' => $phone,
        'sender' => 'user',
        'message' => $message
    ]);
         

          // INICIAR FLUJO DE CITA
    if ($message == 'cita') {
        session(['chat_step' => 'cita_nombre']);

        return response()->json([
            'reply' => 'Perfecto, vamos a agendar tu cita 😊\n¿Cuál es tu nombre?'
        ]);
    }

    //  FLUJO DE PREGUNTAS

    if ($step == 'cita_nombre') {
        session(['cita_nombre' => $message, 'chat_step' => 'cita_correo']);

        return response()->json([
            'reply' => '¿Cuál es tu correo?'
        ]);
    }

    if ($step == 'cita_correo') {
        session(['cita_correo' => $message, 'chat_step' => 'cita_telefono']);

        return response()->json([
            'reply' => '¿Cuál es tu teléfono?'
        ]);
    }

    if ($step == 'cita_telefono') {
        session(['cita_telefono' => $message, 'chat_step' => 'cita_servicio']);

        return response()->json([
            'reply' => '¿Qué servicio deseas? (alineacion,balanceo,cambio/aceite)'
        ]);
    }

    if ($step == 'cita_servicio') {
        session(['cita_servicio' => $message, 'chat_step' => 'cita_producto']);

        return response()->json([
            'reply' => '¿modelo de la llanta que quieres? (ejemplo PRIMACY 4)'
        ]);
    }

    if ($step == 'cita_producto') {
        session(['cita_producto' => $message, 'chat_step' => 'cita_fecha']);

        return response()->json([
            'reply' => '¿Qué fecha deseas? (YYYY-MM-DD, disponibles de lunes a sabado)'
        ]);
    }

    if ($step == 'cita_fecha') {
        session(['cita_fecha' => $message, 'chat_step' => 'cita_hora']);

        return response()->json([
            'reply' => '¿Qué hora deseas? (HH:MM,disponibilidad(10:30-13:00))'
        ]);
    }

    if ($step == 'cita_hora') {
        session(['cita_hora' => $message, 'chat_step' => 'cita_asunto']);

        return response()->json([
            'reply' => '¿si añadiste un producto o servicioy no lo requiere puede anotarlo aqui?'
        ]);
    }

    // 💾 GUARDAR CITA
    if ($step == 'cita_asunto') {

        Cita::create([
            'nombre' => session('cita_nombre'),
            'correo' => session('cita_correo'),
            'telefono' => session('cita_telefono'),
            'servicio_id' => session('cita_servicio'),
            'producto_id' => session('cita_producto'),
            'fecha' => session('cita_fecha'),
            'hora' => session('cita_hora'),
            'asunto' => $message,
        ]);

        // limpiar sesión
        session()->forget([
            'chat_step',
            'cita_nombre',
            'cita_correo',
            'cita_telefono',
            'cita_servicio',
            'cita_producto',
            'cita_fecha',
            'cita_hora',
        ]);

        return response()->json([
            'reply' => '✅ Tu cita ha sido agendada correctamente'
        ]);
    }

     // INICIAR FLUJO DE SOLICITUD
    if ($message == 'solicitud') {
        session(['chat_step' => 'solicitud_nombre']);

        return response()->json([
            'reply' => 'Perfecto, realizar tu solicitud 😊\n¿Cuál es tu nombre?(JUAN PEREZ)'
        ]);
    }

    //  FLUJO DE PREGUNTAS

    if ($step == 'solicitud_nombre') {
        session(['solicitud_nombre' => $message, 'chat_step' => 'solicitud_correo']);

        return response()->json([
            'reply' => '¿Cuál es tu correo?'
        ]);
    }

    if ($step == 'solicitud_correo') {
        session(['solicitud_correo' => $message, 'chat_step' => 'solicitud_telefono']);

        return response()->json([
            'reply' => '¿Cuál es tu teléfono?'
        ]);
    }

    if ($step == 'solicitud_telefono') {
        session(['solicitud_telefono' => $message, 'chat_step' => 'solicitud_marca']);

        return response()->json([
            'reply' => '¿Qué marca de llantas deseas? (BFGODRICH,MICHELIN,UNIROYAL,BRIDGESTONE)'
        ]);
    }

    if ($step == 'solicitud_marca') {
        session(['solicitud_marca' => $message, 'chat_step' => 'solicitud_modelo']);

        return response()->json([
            'reply' => '¿modelo de la llanta que quieres? (ejemplo PRIMACY 4)'
        ]);
    }

    if ($step == 'solicitud_modelo') {
        session(['solicitud_modelo' => $message, 'chat_step' => 'solicitud_medida']);

        return response()->json([
            'reply' => '¿Qué medida desea? (ejemplo 205/12 R16)'
        ]);
    }

        
 
 
    // 💾 GUARDAR OLICITUD
    if ($step == 'solicitud_nmedida') {

        Solicitude::create([
            'nombre' => session('solicitud_nombre'),
            'correo' => session('solicitud_correo'),
            'telefono' => session('solicitud_telefono'),
            'marca' => session('solicitud_marca'),
            'modelo' => session('solicitud_modelo'),
            'medida' => session('solicitud_medida'),
            'status' => 'pendiente',
        ]);

        // limpiar sesión
        session()->forget([
            'chat_step',
            'solicitud_nombre',
            'solicitud_correo',
            'solicitud_telefono',
            'solicitud_marca',
            'solicitud_modelo',
            'solicitud_medida',
        ]);

        return response()->json([
            'reply' => '✅ Tu cita ha sido agendada correctamente'
        ]);
    }






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


//////////////////////////////////////
   
 public function index(Request $request)
{
    $sessionId = $request->session()->get('chat_session');

    if (!$sessionId) {
        $sessionId = Str::uuid();
        $request->session()->put('chat_session', $sessionId);

        ChatMessage::create([
            'session_id' => $sessionId,
            'sender' => 'bot',
            'message' => 'Hola 👋 Bienvenid@ a UNILLANTAS DE OAXACA, ¿En qué te podemos ayudar?'
        ]);
    }

 $messages = ChatMessage::where('session_id', $sessionId)
        ->orderBy('created_at', 'asc')
        ->get();
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
}