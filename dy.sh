#!/bin/bash

# 请将本文件放在项目根目录！！！
# BasePath=$(cd `dirname $0`; pwd)
RootPath=$(cd `dirname $0`; pwd)
Environment=
EnvConf=.envconfig

if [ -n "$1" ]
then
    Branch=$1
else
    Branch='gh-pages'
fi

while getopts "b:e:" arg
do
    case $arg in
        b)
            Branch=$OPTARG
            ;;
        e)
            Environment=$OPTARG
            ;;
        ?)
            #当有不认识的选项的时候arg为?
            echo "含有非法选项！"
            exit 1
            ;;
     esac
done


Environment='gh-pages'


if [ "$Environment" = "prod" ]
then
    read -p "确定要部署分支：${Branch} 到${Environment}环境吗？
输入【yes】继续，其他任意字符取消！
" confirm
    if [ "$confirm" != "yes" ]
    then
        echo "取消部署任务"
        exit 1
    fi
    else
    echo "开始部署分支：${Branch} 到${Environment}环境"
fi

cd ${RootPath}

git clean -f -d > /dev/null
git fetch origin
git reset --hard origin/${Branch}

#git reset --hard HEAD
#git checkout ${Branch}
#git pull origin ${Branch}

chmod -R 755 ${RootPath}


#echo ${RootPath}"/environment/"$Environment"/*"
#echo ${RootPath}"/code/"


chown -R www:www ${RootPath}

echo "部署完成！请完成后续操作后运行"