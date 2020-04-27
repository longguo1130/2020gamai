$(function () {
    let token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        alert('Token not found')
    }

    /**
     * Echo exposes an expressive API for subscribing to channels and listening
     * for events that are broadcast by Laravel. Echo and event broadcasting
     * allows your team to easily build robust real-time web applications.
     */

    import Echo from 'laravel-echo';

    window.Pusher = require('pusher-js');

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '97141b53f095c5c992ff',
        cluster: 'ap2',
        encrypted: false,
        transports: 'websocket'
    });
    let userId = document.head.querySelector("meta[name='user-id']").content;

    Echo.private('App.User.' + userId).notification((notifiable) => {
        $('.badge').text(notifiable.buyer_id);
        $('#notificationlist').prepend(`
	<a class="dropdown-item" href="#">`+notifiable.buyer_name+`</a>
`);
    });
});
