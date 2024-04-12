var staticCacheName = "pwa-v" + new Date().getDate();
var filesToCache = [
    '/offline',
    '/IniciarSesion',
    '/assets/img/logos/logoproecto.png',
    '/assets/assets/css/bootstrap.css',
    '/assets/assets/css/gaia.css',
    '/assets/css/material-dashboard.css',
     '/images/icons/icon.ico', // Icono de la aplicación
    // Recursos CSS
    '../assets/css/nucleo-icons.css',
    '../assets/css/nucleo-svg.css',
    '../assets/css/material-dashboard.css?v=3.1.0',
    '../assets/css/loader.css',
    '../assets/css/tabla.css',
    'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700', // Fuentes Roboto
    // Recursos JavaScript
    'https://kit.fontawesome.com/42d5adcbca.js',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
    '../assets/js/loader.js',
    '../assets/js/core/popper.min.js',
    '../assets/js/core/bootstrap.min.js',
    '../assets/js/plugins/perfect-scrollbar.min.js',
    '../assets/js/plugins/smooth-scrollbar.min.js',
    '../assets/js/plugins/chartjs.min.js',
    // Recursos de calendario
    'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js',
    'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js',
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

self.addEventListener('fetch', event => {

    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // If request is found in cache, return it
                if (response) {
                    return response;
                }
                
                // If the request is for the dashboard page, handle it separately
                if (event.request.referrer.includes('/dashboard')
                    || event.request.referrer.includes('/agendar-cita')|| event.request.referrer.includes('/Calendario')
                    || event.request.referrer.includes('/Alergias')|| event.request.referrer.includes('/EnfermedadesCronicas')
                    || event.request.referrer.includes('/Perfil')) {
                    return fetch(event.request)
                        .then(response => {
                            // Check if valid response
                            if (!response || response.status !== 200 || response.type !== 'basic') {
                                // console.log("RESPUESTA NO VÁLIDA O NO 200");
                                return response;
                            }
                            // Clone response and cache it
                            var responseToCache = response.clone();
                            caches.open(staticCacheName)
                                .then(cache => {
                                    cache.put(event.request, responseToCache);
                                });
                            return response;
                        })
                                    .catch(() => {
                                    // If fetch fails (e.g., when offline), return offline view
                            console.log("ERROR AL OBTENER RECURSO DE LA RED");
                            return caches.match('/offline').then(function(response) {
                                if (response) {
                                    return response;
                                } else {
                                    // If offline view is not found in cache, return a default response
                                    console.log("MOSTRANDO RESPUESTA POR DEFECTO");
                                    return new Response("Estamos teniendo dificultades, por favor inténtalo de nuevo más tarde!", {
                                        headers: { 'Content-Type': 'text/plain' }
                                    });
                                }
                            });
                        });
                }
                // If the request is not in cache and not for a dynamic route, fetch from network
                return fetch(event.request);
            })
            .catch(() => {
                // If fetch fails (e.g., when offline), return offline view
                console.log("ERROR AL OBTENER RECURSO DE LA RED");
                return caches.match('/offline').then(function(response) {
                    if (response) {
                        return response;
                    } else {
                        // If offline view is not found in cache, return a default response
                        console.log("MOSTRANDO RESPUESTA POR DEFECTO");
                        return new Response("Estamos teniendo dificultades, por favor inténtalo de nuevo más tarde!", {
                            headers: { 'Content-Type': 'text/plain' }
                        });
                    }
                });
            })
    );
});

