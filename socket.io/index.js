var http = require('http'),
	PORT = 3001;

var server = http.createServer(function(req, res) {});
var io = require('socket.io').listen(server);

io.on('connection', (socket) => {
  
  io.emit('new user', "New User!");
  console.log("New User!");

  socket.on('noti message', msg => {
    io.emit('new message', msg);
  });

});

server.listen(PORT, function() {
	console.log('Server is running on port ' + PORT + '...');
});
