#!/bin/bash
echo "Watchdog gestart - monitoring file changes..."

while inotifywait -e modify,create,delete -r /var/www/html; do
    echo "Bestanden gewijzigd, herstart Apache..."
    apachectl -k restart

    # Stuur een WebSocket signaal naar de reload-server
    curl -s http://localhost:35729/reload
done
