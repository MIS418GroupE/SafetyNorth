function FindProxyForURL(url, host){
if (shExpMatch(host, "*localhost")) return "PROXY 127.0.0.1:8080";
return "DIRECT";}
