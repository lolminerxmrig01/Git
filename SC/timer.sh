#!/usr/bin/env bash

let start_time="$(date +%s)";
 
function main(){
  tput bold
  echo "Oke Bro Kita Lanjut Lagi Ngebornya... !!!"
  start_timer
  exit 0
}
 
function start_timer(){
  while [ 1 ];
  do
    let current_time="$(date +%s)"
    let seconds=$current_time-$start_time;
 
    echo -en "\r                                        \r"
    printf "Durasi Ngebor: %02d:%02d:%02d:%02d" "$((seconds/86400))" "$((seconds/3600%24))" "$((seconds/60%60))" "$((seconds%60))" 
    sleep 1;
  done
}
 
main
