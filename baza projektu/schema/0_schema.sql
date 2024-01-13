-- W niniejszym pliku umieść schemat bazy danych (tworzenie tabel, relacji itd.)
 lekarze: id_lekarza, imie, nazwisko, numer_telefonu, email, specjalizacja, id_użytkownika
 pacjenci: id_pacjenta,imie,nazwisko,numer_telefonu,pesel,id_użytkownika
 użytkownicy: id_użytkownika, login, hasło,rola
 wizyty: id_wizyty,data,id_lekarza,id_pacjetna,godzina
 pacjeci id_użytkownika = użytkownicy id_użytkownika relacja jeden do jednego
 lekarze id_użytkownika = użytkownicy id_użytkownika relacja jeden do jednego
 wizyty id_pacjenta = pacjenci id pacjenta relacja wiele do wielu
 wizyty id_pacjenta = lekarze id lekarza relacja wiele do wielu