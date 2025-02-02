# Projekt Zarządzania Hotelem

## Logowanie

Są dwa typy konta użytkowników: admin i user  
Jeżeli chcemy się korzystać z edytora, trzeba się zalogować na konto admina  
admin@domain.com  
admin  

Jeśli na jakieś inne: to Sign Up lub Continue dla istniejącego:  
user@domain.com  
user

## 1. Zbudowanie Kontenerów Docker

Na początku, uruchom poniższe polecenie, aby zbudować kontenery Docker:

docker-compose build

## 2. Uruchom kontenery w tle za pomocą:

docker-compose up -d

## 3. Następnie uruchom poniższe polecenie, aby wyświetlić uruchomione kontenery:

docker ps

CONTAINER ID   IMAGE                       
18820bf46545   wdpai-pk-hotel-project-web

## 4. Aby uzyskać szczegóły dotyczące kontenera, użyj polecenia:

docker inspect <Container_ID>

docker inspect 18820bf46545

## 5. Przewiń na dół wyników inspekcji i znajdź sekcję Networks. Powinno to wyglądać na przykład tak:

"Networks": {
    ...
        "IPAddress": "172.18.0.3"
    ...
}

## 6. Edytuj plik config.php i wprowadź poniższe dane:

const USERNAME = 'admin';

const PASSWORD = 'root';

const HOST = '172.18.0.3';  // Zastąp tym adresem IP, który znalazłeś

const DATABASE = 'wdpai-hotel-project';

## Uwaga: Jeśli baza danych działa już na domyślnym adresie IP, ten krok może nie być konieczny.

