<!DOCTYPE html>
<html lang="id">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">    <title>V9.ai| Premium</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            background: #050505; 
            color: #d4af37; 
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-container {
            width: 85%;
            height: 90vh;
            background: rgba(10, 10, 10, 0.95);
            border: 1px solid #2a2200;
            border-radius: 40px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 0 50px rgba(212, 175, 55, 0.1);
        }

        .profile-sidebar {
            width: 250px;
            border-right: 1px solid #2a2200;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(180deg, #121212 0%, #050505 100%);
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px double #d4af37;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
            object-fit: cover;
            margin-bottom: 20px;
        }

        .name { font-size: 1.5rem; font-weight: 800; letter-spacing: 3px; color: #fff; }

        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #chatBox {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .bubble {
            padding: 15px 25px;
            border-radius: 20px;
            max-width: 60%;
            font-size: 1.1rem;
        }

        .ai-bubble { align-self: flex-start; background: #1a1a1a; border: 1px solid #332900; color: #eee; }
        .user-bubble { align-self: flex-end; background: #1a1a1a;  border: 1px solid #332900; color: #eee; }

        .input-area {
            padding: 30px;
            background: #080808;
            border-top: 1px solid #2a2200;
        }

        #userInput {
            width: 100%;
            background: #000;
            border: 1px solid #d4af37;
            padding: 20px;
            border-radius: 30px;
            color: #fff;
            outline: none;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="profile-sidebar">
        <img src="data:image/jpeg;base64,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" class="avatar">
        <div class="name">VIKTOR</div>
    </div>

    <div class="chat-area">
        <div id="chatBox"></div>
        <div class="input-area">
            <input type="text" id="userInput" placeholder="Tuliskan sesuatu..." onkeydown="if(event.key==='Enter') send()">
        </div>
    </div>
</div>

<script>
async function send() {
    let input = document.getElementById('userInput');
    let chatBox = document.getElementById('chatBox');
    let msg = input.value.trim();
    if (!msg) return;

    chatBox.innerHTML += `<div class="bubble user-bubble">${msg}</div>`;
    input.value = '';
    chatBox.scrollTop = chatBox.scrollHeight;

    chatBox.innerHTML += `<div class="bubble ai-bubble" id="loading">Vesper sedang berpikir...</div>`;
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
        let res = await fetch('/chat-send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: msg })
        });
        
        let data = await res.json();
        
        document.getElementById('loading').remove();
        
        chatBox.innerHTML += `<div class="bubble ai-bubble">${data.reply || data.error}</div>`;
    } catch (err) {
        document.getElementById('loading').remove();
        chatBox.innerHTML += `<div class="bubble ai-bubble">Maaf, koneksi gagal. Pastikan Ollama jalan!</div>`;
    }
    chatBox.scrollTop = chatBox.scrollHeight;
}    
</script>
</body>
</html>