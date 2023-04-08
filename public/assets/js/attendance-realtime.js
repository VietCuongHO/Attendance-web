import Echo from 'laravel-echo';
window.io = require('socket.io-client');

window.Echo = new Echo({
    namespace: 'App\\Events\\ServerCreated',
    broadcaster: 'socket.io',
    host:window.location.hostname +':6001'
});
window.Echo.channel('attendance')
    .listen('Attendance', (data) => {
        console.log(data);
    });
