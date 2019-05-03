#!/bin/sh
################################################################
# 因为一些alpine系统不支持sed -i，所以这里采用sed -e的方式处理 
# @date 2019-05-02 @author shanhy              
# 示例：./find-sed-e.sh 'find /opt/test/rap2/rap2-delos/ -type f' 'http://test.shanhy.com:9999' 'http://test.shanhy.com:9999' 'https://www.example.com:5882'                
################################################################

#find脚本中使用绝对路径
findScript=$1
#对find的文件内容进行过滤，如果不需要过滤填''空即可
filterContent=$2
#要替换的字符串
fromStr=$3
#替换成的字符串
toStr=$4

files=`$findScript |xargs grep -l "$filterContent"`

for file in $files
do
    if [ -f $file ]
    then
        echo "replace file $file"
        sed -e "s#$fromStr#$toStr#g" < $file > /tmp/findsede.tmp && cp -p /tmp/findsede.tmp $file && rm -rf /tmp/findsede.tmp
    fi
done
