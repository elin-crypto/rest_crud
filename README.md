# Moment 5.1

Skapa en REST-webbtjänst med CRUD

- Det finns en klass för databasanslutningen Database.php. Här används localhost för databasanslutning för att inte ge ut lösenord till riktiga databasen.
- Det finns även en klass Courses.php för hantering av kurser som använder metoderna: read, readOne, create, update, delete och setCourse
- i courses.php hanteras de olika anropen med hjälp av en switch-sats


Det publicerade API: 
http://studenter.miun.se/~elku1901/dt173g/Moment5/rest/courses.php

Webbsida som konsumerar webbtjänsten: 
http://studenter.miun.se/~elku1901/dt173g/Moment5/fetchAPI/pub/