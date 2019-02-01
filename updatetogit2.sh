#!/bin/bash
# Author: Fade Khalifah Rosyad
# Update Git Bash integration with Case

echo "1. Clone git"
echo "2. Push git"
read PILIHAN

case "$PILIHAN" in
	1) git clone https://github.com/faderosyad/Foox_HiveMQ-MQTT.git Foox-HiveMQ
	   git remote add origin https://github.com/faderosyad/Foox_HiveMQ-MQTT.git
		;;
	2) git add *
	   git commit -m "Update from bash"
	   git remote add origin https://github.com/faderosyad/Foox_HiveMQ-MQTT.git
	   git push -u origin master
	   ;;
esac
