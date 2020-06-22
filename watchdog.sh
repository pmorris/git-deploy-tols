# This file watches for instructions

# make sure that the script is running in the directory where it resides
script_dir=$(dirname $0)
cd $script_dir


# do git pull
FILE='do_pull'
if test -f "$FILE"; then
  echo "$FILE exists....pulling branch"
  rm $FILE
  cd ..
  git pull
fi
