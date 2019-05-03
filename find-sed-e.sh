#!/bin/sh
################################################################
# 因为一些alpine系统不支持sed -i，所以这里采用sed -e的方式处理     
# @date 2019-05-02 @author shanhy                              
################################################################

#绝对路径
findPath=$1
#文件名
fileName=$2
#要替换的字符串
fromStr=$3
#替换成的字符串
toStr=$4

for file in `find $findPath -type f -name "$fileName"`
do
    if [ -f $file ] 
    then
        echo "replace file $file"
        sed -e "s#$fromStr#$toStr#g" < $file > /tmp/findsede.tmp && cp -p /tmp/findsede.tmp $file && rm -rf /tmp/findsede.tmp
    fi
done
