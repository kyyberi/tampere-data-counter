Suorittamalla "php parse.php" scripti parsii Tampereen avoimen datan katalogin läpi ja laskee 
kaikkien datasettien yhteismäärän. 

Sen jälkeen se kirjoittaa lukumäärän ja aikaleiman (UNIX formaatti) 
"lkm.txt" tiedostoon samassa kansiossa. 

Sen jälkeen skripti lisää JSON tiedostoon (tampere.json) uuden objektin, jossa on 
* "lkm":lukumäärä,"timestamp":aikaleima
