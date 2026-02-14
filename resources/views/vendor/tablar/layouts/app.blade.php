
@extends('tablar::page')
<div id="chatbot-widget">
    <button id="chat-toggle">💬</button>

    <div id="chat-window">
        <div id="chat-header">🤖 UNILLANTAS OAXACA</div>
        <div id="chat-body"></div>
    </div>
</div>

<style>
#chat-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #206bc4;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 24px;
    cursor: pointer;
    z-index: 9999;
}

#chat-window {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 320px;
    height: 450px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,.2);
    display: none;
    flex-direction: column;
    z-index: 9999;
}

#chat-header {
    background: #206bc4;
    color: white;
    padding: 10px;
    font-weight: bold;
}

#chat-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
}

.msg {
    margin: 5px 0;
    padding: 8px 12px;
    border-radius: 15px;
    max-width: 75%;
}
.bot { background: #e7f1ff; }
.user { background: #206bc4; color: white; margin-left: auto; }

.options button {
    margin: 3px;
    padding: 6px 10px;
    border-radius: 8px;
    border: 1px solid #206bc4;
    background: white;
    cursor: pointer;
}
</style>
<script>
const chatWindow = document.getElementById('chat-window');
const chatBody = document.getElementById('chat-body');
const toggleBtn = document.getElementById('chat-toggle');

toggleBtn.onclick = () => {
    chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
};

function addMessage(text, type='bot') {
    const div = document.createElement('div');
    div.className = 'msg ' + type;
    div.innerText = text;
    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function addOptions(options) {
    const div = document.createElement('div');
    div.className = 'options';
    options.forEach(opt => {
        const btn = document.createElement('button');
        btn.innerText = opt;
        btn.onclick = () => sendMessage(opt);
        div.appendChild(btn);
    });
    chatBody.appendChild(div);
}

function sendMessage(text) {
    addMessage(text, 'user');

    fetch('/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: text })
    })
    .then(res => res.json())
    .then(data => {
        addMessage(data.reply, 'bot');
        if (data.options && data.options.length > 0) {
            addOptions(data.options);
        }
    });
}

// mensaje inicial
setTimeout(() => sendMessage('hola'), 500);
</script>
