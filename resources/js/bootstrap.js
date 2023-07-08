import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
 
window.Pusher = Pusher;
 
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '471562929500248b03e0',
    cluster: 'ap1',
    forceTLS: true
});
