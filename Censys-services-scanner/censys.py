import requests, json, sys, os

class censys():
	url = 'https://search.censys.io/api/v2/hosts/'
	headers={}
	out=[]
	args = sys.argv[1:]
	def __init__(self):
		if os.getenv('CENSYS_API_KEY') != None:
			self.headers={"accept": "application/json","Authorization": "Basic "+str(os.getenv('CENSYS_API_KEY'))}
		else:
			print("\nPlease configure the CENSYS_API_KEY in ~/.bash_profile")
			sys.exit()

	def ips(self,file):
		try:
			f = open(file, "r")
			lines=f.readlines()
			f.close()
			return lines
		except Exception as e:
			raise

	def get_services(self,u):
		try:
			x = requests.get(u, headers = self.headers)
			j=json.loads(x.content)
			services=[]
			for service in j["result"]["services"]:
				l={"port":service["port"],"service name":service["service_name"]}
				services.append(l)
			self.out.append({"IP":j["result"]["ip"],"services":services})
		except Exception as e:
			raise
	
	def main(self):
		try:
			if(self.args):
				file=self.args[0]
				lines=self.ips(file)
			else:
				print("\nUsage: python3 censys.py <filename>\nSpecify the file which contains the IP's")
				sys.exit()
		except Exception as e:
			raise

		for line in lines:
			u=self.url+str(line.strip())
			self.get_services(u)

		f = open("output.json", "w")
		f.write(json.dumps(self.out))
		f.close()
		print(self.out)

obj=censys()
obj.main()
