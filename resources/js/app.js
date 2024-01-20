import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var channel = Echo.channel(`App.Models.User.${userId}`);
channel.notification('.my-event', function(data) {
    console.log(data);
    alert(data.body);
//   alert(JSON.stringify(data));
});