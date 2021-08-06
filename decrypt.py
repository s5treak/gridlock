from Crypto.PublicKey import RSA
from Crypto.Cipher import AES, PKCS1_OAEP
import sys
import requests


def decrypt():

	
	try:

		getId = sys.argv[1]

		url = 'http://localhost/api/ragnrok/{}'.format(getId)


		response = requests.get(url)

		private_key = response.json()['private_key']

		
		private_key = bytes(private_key, 'utf-8')

		# private_key = private_key.replace(b'\\n', b'\n')

		private_key = private_key.decode('unicode-escape').encode('ISO-8859-1')

		enc_fernet_key = response.json()['enc_fernet_key']
		
		enc_fernet_key = bytes(enc_fernet_key, 'utf-8')

		enc_fernet_key = enc_fernet_key.decode('unicode-escape').encode('ISO-8859-1')
	   
		
		#Private RSA key
		rsa_import = RSA.importKey(private_key)
		# Private decrypter
		private_crypter = PKCS1_OAEP.new(rsa_import)
		# Decrypted session key
		dec_fernet_key = private_crypter.decrypt(enc_fernet_key)



		print(dec_fernet_key.decode('utf-8'))

	except Exception as e:
		print(e)
		


decrypt()
