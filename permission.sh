#!/bin/bash
SAVEIFS=$IFS
IFS=$(echo -en "\n\b")

basefolder="/var/www/html/compress/ORIGINAL/files/"

for i in $(find * -iname '*.JPG' -o -iname "*.CR2" -o -iname "*.CRW");
do
        if [ `dirname $i` != "." ]
        then
                dirpath="${i%/*}"
		echo $dirpath
                dir_arr=`echo $dirpath | tr "/" "\n"`
                path=""
                for x in "${dir_arr[@]}"
                do
                        if [ -z "$path" ]
                        then
                                path=$x
                                mkdir -p $basefolder$path
                        else
                                path=$path"/"$x
                                mkdir -p $basefolder$path
                        fi
                done
                ext="."${i##*.}
                output=${i/$ext/".jpg"}
                if [ ! -f $basefolder$output ] || [ $i -nt $basefolder$output ]
                then
                        echo $i
                        convert $i -auto-orient -resize 640x480 -quality 60 $basefolder$output
                fi
        else
                ext="."${i##*.}
                output=${i/$ext/".jpg"}
                if [ ! -f $basefolder$output ] || [ $i -nt $basefolder$output ]
                then
                        echo $i
                        convert $i -auto-orient -resize 640x480 -quality 60 $basefolder$output
                fi
        fi
done
