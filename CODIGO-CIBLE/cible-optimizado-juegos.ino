/*V. 1.0 
 * Para la compilación se utilizan los siguientes parámetros
 *  - UPLOAD SPEED : 115200
 *  - CPU FREQUENCY: 160MHz
 *  - FLASH SIZE   : 4M
 * 
 * ESTA VERSIÓN INCLUYE MEJORAS DE OPTIMIZACIÓN EN RECEPCIÓN Y TRANSMICIÓN DE DATOS GET
 * PROYECTO DISPONIBLE EN:
 *  https://github.com/Jesman12/cible-escrime
 * DESARROLLADOR: JESUS MANUEL CUERVO ITURBIDE
 * ÚLTIMA REVISIÓN: 29/09/2019
 */
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

WiFiServer server(80);
HTTPClient http;
const char* ssid     = "CIBLES-AP";
const char* password = "";

const char* host = "10.3.141.1"; //IL FAUDRA CHANGER L'IP CI-CÔTé LORS DE L'UTILISATION D'UN NOUVEAU SERVEUR (BOÎTE SERVEUR; PEUT-ÊTRE LA RPI OU QUELQUE SOIT LE SERVEUR UTILISé)

const int httpPort = 80;

long previousMillis = 0;
long intervalOn = 2000;
long intervalOff = 3000;

#define BUZZER 3 // (3)(D6)
#define LED1 12 //LEDs Petite Cible     (12)(D0)
#define LED2 14 //LEDs Moyenne Cible    (14)(D1)
#define LED3 13 //LEDs Grande Cible     (13)(D2)
#define BTN1 16 //Bouton Petite Cible   (16)(D3)
#define BTN2 5  //Bouton Petite Cible   (5)(D7)
#define BTN3 4  //Bouton Petite Cible   (4)(D5)

byte state = 0;
byte prevState;

byte state2 = 0;
byte prevState2;

byte state3 = 0;
byte prevState3;

volatile bool bt1Press = false;
volatile bool bt2Press = false;
volatile bool bt3Press = false;

bool datos = false;
bool jeu = false;

String Jeu_Select = "0";
String id = "1"; //IL FAUDRA MODIFIER LA VALEUR LORSQU'ON VEUT CHANGER LE CIBLE. 
String IP;
String url = "/cible-escrime/form.php";

void setup()
{
  pinMode(LED1, OUTPUT);
  pinMode(LED2, OUTPUT);
  pinMode(LED3, OUTPUT);
  pinMode(BUZZER, OUTPUT);
  pinMode(BTN1, INPUT);
  pinMode(BTN2, INPUT);
  pinMode(BTN3, INPUT);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(LED1, HIGH);
    digitalWrite(LED2, HIGH);
    digitalWrite(LED3, HIGH);
    delay(500);
    digitalWrite(LED1, LOW);
    digitalWrite(LED2, LOW);
    digitalWrite(LED3, LOW);
  }
  IP = WiFi.localIP().toString();
  digitalWrite(BUZZER, HIGH);
  delay(500);
  digitalWrite(BUZZER, LOW);  
  delay(500);
  digitalWrite(BUZZER, HIGH);
  delay(500);
  digitalWrite(BUZZER, LOW); 
  server.begin();
}

void loop()
{
  state = digitalRead(BTN1);
  state2 = digitalRead(BTN2);
  state3 = digitalRead(BTN3);

  digitalWrite(BUZZER, LOW);
  unsigned long currentMillis = millis();
  WiFiClient client;
  if (!client.connect(host, httpPort)) {
    return;
  }
  while(!jeu){
    client = server.available();
    if (!client)
    {
      return;
    }
    client.println("HTTP/1.1 200 OK");
    client.println("Access-Control-Allow-Origin: *");
    client.println("Content-Type: text/html");
    client.println(""); 
    client.println("<!DOCTYPE HTML>");
    client.println("<html>");
    client.println("<br><br>");
    client.println("<a href=\"/?LED=100\"\"><button>PTS <b>5</b></button></a>");
    client.println("<a href=\"/?LED=010\"\"><button>PTS <b>2</b></button></a>");
    client.println("<a href=\"/?LED=001\"\"><button>PTS <b>1</b></button></a><br />");
    client.println("<a href=\"/?Start\"\"><button><b>JEU!</b></button></a><br />");
    client.println("id: "+id);
    client.println("IP: "+IP); 
    client.println("</html>");
    String line = client.readStringUntil('\r');
    client.flush();
    byte pos = line.indexOf("/?LED=");
    if(pos){
      String binario = line.substring(pos+6);
      String binario2 = binario.substring(0,3);
      String bL1 = binario2.substring(0,1);
      String bL2 = binario2.substring(1,2);
      String bL3 = binario2.substring(2,3);
      if(bL1 == "1"){
        digitalWrite(LED1, HIGH);
      }else{
        digitalWrite(LED1, LOW);
      }if(bL2 == "1"){
        digitalWrite(LED2, HIGH);
      }else{
        digitalWrite(LED2, LOW);
      }if(bL3 == "1"){
        digitalWrite(LED3, HIGH);
      }else{
        digitalWrite(LED3, LOW);
      }
      if(line.indexOf("&jeu=2") != -1){
        Jeu_Select = "2";
        previousMillis = currentMillis;
      }
      jeu = true;
    }
    if(line.indexOf("/?Start") != -1){
      for(int i = 0; i <= 3; i++){
        digitalWrite(LED1, HIGH);
        digitalWrite(LED2, HIGH);
        digitalWrite(LED3, HIGH);
        digitalWrite(BUZZER, HIGH);
        delay(500);
        digitalWrite(LED1, LOW);
        digitalWrite(LED2, LOW);
        digitalWrite(LED3, LOW);
        digitalWrite(BUZZER, LOW);
        delay(500);
      }
      jeu = true;
    }
  }
  if(Jeu_Select == "2"){
    if(currentMillis - previousMillis > intervalOn){
      previousMillis = currentMillis;
      digitalWrite(LED1, LOW);
      digitalWrite(LED2, LOW);
      digitalWrite(LED3, LOW);
      Jeu_Select = "0";
      jeu = false;
    }
  }
  state = digitalRead(BTN1);
  state2 = digitalRead(BTN2);
  state3 = digitalRead(BTN3);
  if((state != prevState) && digitalRead(BTN1)){
    client.stop();
    if(digitalRead(12) == HIGH){
      url = "/cible-escrime/form.php?id="+id+"&btn=1";
      digitalWrite(LED1, LOW);
    }else{
      url = "/cible-escrime/form.php?id="+id+"&btn=4";
      digitalWrite(LED1, LOW);
      digitalWrite(LED2, LOW);
      digitalWrite(LED3, LOW);
    }
    datos = true;
  }
  if((state2 != prevState2) && digitalRead(BTN2)){
    client.stop();
    if(digitalRead(14) == HIGH){
      url = "/cible-escrime/form.php?id="+id+"&btn=2";
      digitalWrite(LED2, LOW);
    }else{
      url = "/cible-escrime/form.php?id="+id+"&btn=4";
      digitalWrite(LED1, LOW);
      digitalWrite(LED2, LOW);
      digitalWrite(LED3, LOW);
    }
    datos = true;
  }
  if((state3 != prevState3) && digitalRead(BTN3)){
    client.stop();
    if(digitalRead(13) == HIGH){
      url = "/cible-escrime/form.php?id="+id+"&btn=3";
      digitalWrite(LED3, LOW);
    }else{
      url = "/cible-escrime/form.php?id="+id+"&btn=4";
      digitalWrite(LED1, LOW);
      digitalWrite(LED2, LOW);
      digitalWrite(LED3, LOW);
    }
    datos = true;
  }
      if(datos){
        url += "&jeu=";
        url += Jeu_Select;
        http.begin(host,httpPort,url);
        int httpCode = http.GET();
        http.end();
        datos = false;
      }
      if((digitalRead(12) == LOW) && (digitalRead(14) == LOW) && (digitalRead(13) == LOW)){
        jeu = false;
      }
      prevState = state;
      prevState2 = state2;
      prevState3 = state3;
}
