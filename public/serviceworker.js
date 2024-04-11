var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    'images/icons/icon.ico',
    'assets/assets/css/bootstrap.css',
    'assets/assets/css/gaia.css',
    'assets/css/material-dashboard.css'
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                console.log(filesToCache)
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request).catch(function() {
            return caches.match('/offline').then(function(response) {
                if (response) {
                    return response;
                } else {
                    // Si no se encuentra la vista offline en el caché, se puede devolver una respuesta predeterminada
                    return new Response("Estamos teniendo dificultades, pruebalo de nuevo!", {
                        headers: { 'Content-Type': 'text/plain' }
                    });
                }
            });
        })
    );
});
