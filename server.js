var io = require('socket.io').listen(3000);
var clients = [];
io.sockets.on('connection', function(client){
    
    io.emit('clients', clients);

    client.on('client-info', function(data){
        clients.push(data);
        io.emit('clients', clients);
        client.custom_id = data.id;
        client.current_page = data.url;
        // save to database with id as key
    });
    client.on('disconnect', function() {
        if( client.custom_id ){
            for(var i=0; i<clients.length; i++){
                if( clients[i].id== client.custom_id && clients[i].url == client.current_page ){
                    clients.splice(clients[i], 1);
                    break;
                }
            }
        }
        io.emit('clients', clients);
    });
});

