// This is the service worker with the combined offline experience (Offline page + Offline copy of pages)
const CACHE = "offline-mode";
const offlineFallbackPage = "Offline.html";
self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting().then(r => {});
    }
})
self.addEventListener('install', async (event) => {
    console.log("service worker installed")
    event.waitUntil(
        (async () => {
            const cache = await caches.open(CACHE);
            console.log("[Service Worker] Caching all: app shell and content");
            await cache.addAll(offlineFallbackPage);
        })(),
    );
});
self.addEventListener('fetch', (event) => {
    event.respondWith(
        (async () => {
            const r = await caches.match(e.request);
            console.log(`[Service Worker] Fetching resource: ${e.request.url}`);
            if (r) {
                return r;
            }
            const response = await fetch(e.request);
            const cache = await caches.open(CACHE);
            console.log(`[Service Worker] Caching new resource: ${e.request.url}`);
            await cache.put(e.request, response.clone());
            return response;
        })(),
    );
});
self.addEventListener("activate", (e) => {
    e.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(
                keyList.map((key) => {
                    if (key === CACHE) {
                        return;
                    }
                    return caches.delete(key);
                }),
            );
        }),
    );
});
