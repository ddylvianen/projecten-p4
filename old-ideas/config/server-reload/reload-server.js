const http = require('http');
const WebSocket = require('ws');

// Maak een HTTP-server
const server = http.createServer((req, res) => {
    if (req.url === '/reload') {
        console.log("Bestanden gewijzigd - Stuur reload signaal");
        // Verstuur een reload-bericht naar alle verbonden clients
        wss.clients.forEach(client => {
            if (client.readyState === WebSocket.OPEN) {
                client.send('reload');
            }
        });
        res.end("OK");
    } else {
        res.end("Server is running");
    }
});

// Koppel de WebSocket-server aan de HTTP-server
const wss = new WebSocket.Server({ server });

server.listen(35729, () => {
    console.log("Live Reload WebSocket Server gestart op poort 35729");
});

// Afhandeling van WebSocket-verbindingen
wss.on('connection', (ws) => {
    console.log("Client verbonden");
    // Verstuur direct een bericht als de client verbindt
    ws.send('Hello from server');
    
    ws.on('message', (message) => {
        console.log("Ontvangen:", message);
    });
});

// Foutafhandeling
wss.on('error', (error) => {
    console.error("WebSocket error:", error);
});
