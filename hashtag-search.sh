# requires alphabetical text (without hashtag) character as input, or it doesnt work

if [ "$#" -eq 0 ]; then
    grep -hor "#[a-zA-Z][a-zA-Z]*" /Users/Karina/Dropbox/Notes/Journal | sort -u
else
    HASHTAG=$1
    grep -r "#$HASHTAG" /Users/Karina/Dropbox/Notes/Journal | sort -u
fi