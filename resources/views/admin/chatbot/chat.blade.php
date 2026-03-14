@extends('tablar::page')

@section('title', 'Chatbot')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>💬CHATBOT</h3>
    </div>

    <div class="card-body d-flex flex-column" style="height:500px;">

        <!-- Contenedor de mensajes -->
        <div id="chatBox" class="flex-grow-1 mb-2 p-3" style="overflow-y:auto; background:#0f172a; border-radius:10px;">

            @foreach($messages as $msg)
                <div class="{{ $msg->sender == 'user' ? 'text-end' : 'text-start' }} mb-2">
                    <span class="p-2 rounded {{ $msg->sender=='user'?'bg-primary':'bg-success' }} text-white" 
                          style="max-width:70%; display:inline-block;">
                        {{ $msg->message }}
                        
                    </span>
                    
                </div>
            @endforeach
              <!-- Opciones de botones del menu -->
             @if(isset($menuOptions))
    <div class="mt-2 ms-2">
        @foreach($menuOptions as $option)
            <button 
                class="btn btn-success m-1"
                onclick="sendOption('{{ $option }}')">
                {{ $option }}
            </button>
        @endforeach
    </div>
@endif  
        </div>

        <!-- Opciones de botones -->
        <div id="optionsBox" class="mb-2"></div>

        <!-- Input del usuario -->
        <div class="input-group">
            <input type="text" id="userInput" class="form-control" placeholder="Escribe algo...">
            <button class="btn btn-primary" onclick="sendMessage()">Enviar</button>
        </div>
    </div>
</div>

<script>
async function sendMessage(text=null) {
    let input = text ?? document.getElementById('userInput').value;
    if(!input) return;

    addMessage(input, 'user'); // agrega mensaje del usuario
    document.getElementById('userInput').value = '';

    // enviar al backend
    let res = await fetch("{{ route('chatbot.send') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({message: input})
    });

    let data = await res.json();

    addMessage(data.reply, 'bot'); // agrega mensaje del bot
    showOptions(data.options);     // agrega botones de opciones
}

function addMessage(text, type){
    let chat = document.getElementById('chatBox');
    let div = document.createElement('div');
    div.className = type === 'user' ? 'text-end mb-2' : 'text-start mb-2';
    div.innerHTML = `<span class="p-2 rounded ${type==='user'?'bg-primary':'bg-success'} text-white" style="max-width:70%; display:inline-block;">${text}</span>`;
    chat.appendChild(div);
    chat.scrollTop = chat.scrollHeight; // scroll automático al final
}

function showOptions(options){
    let box = document.getElementById('optionsBox');
    box.innerHTML = '';

    if(!options || options.length === 0) return;

    options.forEach(opt => {
        let btn = document.createElement('button');
        btn.className = "btn btn-sm btn-outline-light m-1";
        btn.innerText = opt;
        btn.onclick = () => sendMessage(opt);
        box.appendChild(btn);
    });
}
</script>
@endsection
<script>
function sendOption(text) {
    fetch("{{ url('chatbot/send') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ message: text })
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    });
}
</script>
<script>
function sendOption(option) {
    sendMessage(option);
}

function sendMessage(message) {

    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        addMessage('bot', data.reply);
    });
}
</script>