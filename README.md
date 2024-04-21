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

### Napomene i Beleske
* Ukoliko zelite korisnika sa administratorskim pravima, mozete kreirati nalog kroz `reigster` formu na sajtu. Nakon toga je potrebno koriscenjem bilo koje alatke za pregled SQL baza podataka dodati novi red u asocijativnoj many-to-many tabeli `users_roles` gde ce `user_id` biti `id` korisnika koga ste kreirali, a `role_id` id `admin` role.
* Aplikacija je implementirana parcijalno zbog vremenskih ogranicenja, ali posto se od same postavke pa na dalje kod odgovorno izolovao i delio na module, aplikacija je veoma odrziva i ekstenzibilna.
