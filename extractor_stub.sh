#!/bin/sh
if [ "$#" -ne 6 ]; then
	echo "Incorrect number of arguments"	
	echo "Usage:\n./extractor_stub.sh INN KPP BIK korschet rs filename"
	echo "Example:\n./extractor_stub.sh 7702818199 770201001 044525201 30101810000000000201 40702810700120030086 ./file1.pdf"
else
	sleep 5	
	date +%d.%m.%Y		#1
	echo $1			#2
	echo $2			#3
	echo Предприятие $1	#4
	echo $1			#5
	echo $5			#6
	echo Банк $3		#7
	echo $3			#8
	echo $4			#9
	echo			#10
	echo $2			#11
	echo $5			#12
	echo $1			#13
	echo $2			#14
	echo Получатель $1	#15
	echo $5			#16
	echo Назначение $1	#17
	DEST="$(pwd)"/"outputFolder"/"$(basename "$6").txt"
	cp "$6" "$DEST"
	echo "outputFolder/"$(basename "$6".txt)	#18
	echo Hello world	#19
	echo $1			#19
	echo $2			#19
fi
