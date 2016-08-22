'use strict';

self.addEventListener('install', event => {
    self.skipWaiting();
    console.log('sw.js::install', event);
});

self.addEventListener('activate', event => {
    console.log('sw.js::activate', event);
});

self.addEventListener('push', event => {
    console.log('sw.js::push', event);
});
