# Booktracker

### Postavka i pokretanje:
1. `PHP`, `Composer`, `Docker` i `docker-compose` moraju biti instalirani na lokalnoj masini.
2. Klonirajte repozitorijum.
3. Pokrenite `composer install` i zatim `npm install` u glavnom folderu projekta.
4. Pokrenite `docker compose up` u glavnom folderu projekta. Ovo ce pokrenuti lokalnu MySQL instancu.
5. Pokrenite `php artisan migrate` kako biste kreirali neophodne tabele.
6. Pokrenite `php artisan db:seed` kako biste popunili tabele sa podacima.
7. Pokrenite `php artisan serve`.
8. Pokrenite `npm run dev` kako bi se bundle-ovali svi frontend fajlovi/asseti.
9. Pokrenuta aplikacija ce se nalaziti na sledecem linku: `http://localhost:8000`.
