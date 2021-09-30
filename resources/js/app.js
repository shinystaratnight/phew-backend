import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.private('phew-notification.' + window.Laravel.user.id)
    .notification((notification) => {
        console.log(window.Laravel.user.id);
    });

window.Echo.join('online')
    .here((users) => {
        console.log(users);
    })
    .joining((user) => {
        console.log(user);
    })
    .leaving((user) => {
        // a user has left.
    });
    
    
