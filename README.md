# Booktracker

### Postavka i pokretanje:
1. `PHP`, `Composer`, `Docker` i `docker-compose` moraju biti instalirani na lokalnoj masini.
2. Klonirajte repozitorijum.
3. Pokrenite `docker compose up` u glavnom folderu projekta. Ovo ce pokrenuti lokalnu MySQL instancu.
4. Pokrenite `php artisan migrate` kako biste kreirali neophodne tabele.
5. Pokrenite `php artisan db:seed` kako biste popunili tabele sa podacima.
6. Pokrenite `php artisan serve`.
7. Pokrenuta aplikacija ce se nalaziti na sledecem linku: `http://localhost:8000`.
