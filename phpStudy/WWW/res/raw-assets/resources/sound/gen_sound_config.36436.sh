exec 1>../../src/config/SoundConfig.lua
echo 'local SoundConfig = {'
for i in *.mp3 *.wav
do
	printf '\t["%s"] = "%s",\n' $i $(ffmpeg -i $i 2>&1|grep Duration | grep -o '[0-9]*:[0-9]*\.[0-9]*')
done
echo '}'

echo 'return SoundConfig'

echo 'OK' >&2
