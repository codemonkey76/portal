import axios from 'axios'
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: process.env.MIX_PUSHER_HOST,
    wsPort: process.env.MIX_PUSHER_PORT,
    wssPort: process.env.MIX_PUSHER_PORT,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    disabledStats: true,
    enabledTransports: ['ws', 'wss']
});

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

import moment from 'moment'
window.moment = moment
