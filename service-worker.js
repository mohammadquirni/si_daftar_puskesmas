const cacheName = 'cache-urip';
const filesToCache = [
  '.',
  'index.php',
  'manifest.json',
  'assets/img/Puskesmas.png'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheName)
    .then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('fetch', function(event) {
  if (event.request.method === 'GET') {
    event.respondWith(
      caches.match(event.request).then(function(response) {
        if (response) {
          return response;
        }
        return fetch(event.request).then(function(response) {
          return caches.open(cacheName).then(function(cache) {
            cache.put(event.request.url, response.clone());
            return response;
          });
        });
      })
    );
  }
});
// TODO SW-5 - delete outdated caches in the activate event listener
self.addEventListener('activate', function(event) {
  console.log('Activating new service worker...');

  var cacheWhitelist = [cacheName];

  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
self.addEventListener('sync',function(event)
{
    console.log("masuk ke sync listener");

    if (event.tag==='sync-new-trx')
	{
        idb_intruksi.getAll().then (function(all_row)
        {
            for (var intruksi of all_row)
            {
                sendData(intruksi);
            }
        });
    }
});