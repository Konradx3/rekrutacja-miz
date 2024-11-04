Zadanie: Proste API do wypożyczania książek
Celem tego zadania jest zaprojektowanie prostego API do wypożyczania książek. Nie ma konieczności implementowania funkcjonalności związanych z logowaniem czy rejestracją użytkowników.
W bazie danych znajduje się 60 książek, których dane można wygenerować za pomocą narzędzia Artisan. Dane te mogą być losowe (Lorem Ipsum).
Wykorzystaj wszystkie znane Ci protokoły HTTP.

Endpoints do oprogramowania:
1. Listowanie książek z paginacją (20 książek na stronę):
    * Dane zawierają nazwę książki, status wypożyczenia oraz informację o osobie, która wypożyczyła książkę (jeśli wypożyczona).
    * Wyszukiwarka książek po frazie: nazwa książki, autorze oraz imieniu i nazwisku klienta.
2. Szczegóły książki:
    * Zawiera informacje o nazwie, autorze, roku wydania, wydawnictwie, statusie wypożyczenia oraz osobie, która wypożyczyła książkę (jeśli wypożyczona).
3. Lista klientów:
    * Zawiera imię i nazwisko klientów.
4. Szczegóły klienta:
    * Zawiera imię i nazwisko klienta oraz listę wypożyczonych książek (bez paginacji).
5. Dodawanie i usuwanie klienta:
    * Pozwala na dodawanie i usuwanie klientów. Dane klienta zawierają imię i nazwisko.
6. Wypożyczanie i oddawanie książek.
Technologie:
* Framework: Laravel
* Implementacja jako REST API

W pliku readme.md opisać końcówki API.

Zadanie należy wykonać do 06.11.2024r. godz. 16:00.
