#include "HX711.h"
#include "DHT.h"
#include <Wire.h>

#define DHTPIN 6
#define DHTTYPE DHT22

DHT dht(DHTPIN, DHTTYPE);
HX711 scale(7, 8);

char msg[50];
float calibration_factor = 346547;
char str_gram[10];
int lastMsg;
char str_cels[5];
float weight;
char str_hum[5];
String valueString;
float h,t;

void setup() {
  Serial.begin(9600);
  Wire.begin(8);                /* join i2c bus with address 8 */
  Wire.onRequest(requestEvent); /* register request event */
  scale.set_scale();
  scale.tare(); //Reset the scale to 0
}

void loop() {
  scale.set_scale(calibration_factor);
  weight = scale.get_units(3);
  h = dht.readHumidity();
  t = dht.readTemperature();
  // Check if any reads failed and exit early (to try again).
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  if (weight < 0) weight = 0;
  Serial.println("Publish message: ");
  dtostrf(h, 3, 1, str_hum);
  dtostrf(t, 3, 1, str_cels);
  dtostrf(weight, 4, 3, str_gram);
  snprintf(msg, 75, "{\"hum\":%s,\"temp\":%s,\"gram\":%s}", str_hum, str_cels, str_gram);
  Serial.println(str_hum);
  Serial.println(str_cels);
  Serial.println(str_gram);
  Serial.println(msg);
  delay(100);
}

// function that executes whenever data is requested from master
void requestEvent() {
  Serial.print("requested");
}
