#!/bin/bash
inputFile=$1
modelType=$2
emailRecipient=$3
stemsType=$4

set -a; source .env; set +a

adminEmail="elliot+demucs@ninjatune.net"
folderPath=$(echo $inputFile | cut -d'/' -f2)
fileName=$(basename -- "$inputFile")

# debug info
echo "demucs path=$demucsPath"
echo -e "\n"
echo "folderPath=$folderPath"
echo -e "\n"
echo "fileName=$fileName"
echo -e "\n"
echo "inputFile=$inputFile modelType=$modelType emailRecipient=$emailRecipient stemsType=$stemsType"
echo -e "\n"


# demucs command
$demucsPath -n $modelType $stemsType "$inputFile" -o processing/$folderPath

# zip
zip -rm output/$folderPath.zip processing/$folderPath

# send email
echo "Sending completion email"
email_body="Stem extraction complete: $webRoot/output/$folderPath.zip"
echo "$email_body" | mail -s "Stem extraction complete - $fileName" "$emailRecipient" "$adminEmail"

#tidy up uploads folder
rm -rf uploads/$folderPath