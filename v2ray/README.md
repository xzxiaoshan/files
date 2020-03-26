### [Docker搭建v2ray+websocket(nginx)+tls](https://github.com/xzxiaoshan/files/raw/master/v2ray/v2%2Bws%2Btls-docker.mp4)

本例环境：谷歌云CentOS 8  

#### 一、初始化命令(多行全部拷贝执行)
```
dnf config-manager --add-repo=http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo \
&& dnf install https://download.docker.com/linux/centos/7/x86_64/stable/Packages/containerd.io-1.2.6-3.3.el7.x86_64.rpm \
&& dnf install docker-ce wget -y \
&& systemctl enable docker \
&& systemctl start docker \
&& curl -L "https://github.com/docker/compose/releases/download/1.25.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose \
&& chmod +x /usr/local/bin/docker-compose \
&& mkdir -p /opt/soft \
&& cd $_ \
&& wget https://github.com/xzxiaoshan/files/raw/master/v2ray/v2ray-pkg.tar.gz \
&& tar -zxvf v2ray-pkg.tar.gz \
&& mv v2ray-pkg v2ray \
&& cd v2ray
```

#### 二、修改配置文件  
将域名解析到你的服务器IP地址，例如本例域名：v2ray.wegeyun.com  
修改 docker-compose.yaml 中的域名部分的信息(域名/email/token/key)  
修改 conf.d/v2ray.conf 中前几行的域名名称  

#### 三、启动  
```
docker-compose up -d
```

#### 四、其他  
客户端ID和信息，在config.json文件的clients中配置。   
BBR加速命令`wget --no-check-certificate https://github.com/teddysun/across/raw/master/bbr.sh && chmod +x bbr.sh && ./bbr.sh`  
安装完成后，脚本会提示需要重启，输入 y 并回车后重启。重启完成后，验证一下是否成功安装最新内核并开启`TCP BBR`，输入命令`lsmod | grep bbr`如果出现tcp_bbr字样表示bbr已安装并启动成功。  

**其他链接**  
[windows客户端](https://github.com/2dust/v2rayN)  
[Android客户端](https://github.com/2dust/v2rayNG/releases)  
[操作视频](https://github.com/xzxiaoshan/files/raw/master/v2ray/v2%2Bws%2Btls-docker.mp4)  
[客户端配置](https://www.shawnlin.cn/v2ray-client/)  
[UUID在线生成](https://www.uuidgenerator.net/)  
[官网](https://www.v2ray.com/)  

---

结束

