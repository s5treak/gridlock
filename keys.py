from Crypto.PublicKey import RSA
from Crypto.Random import get_random_bytes
from Crypto.Cipher import AES, PKCS1_OAEP



def generateRSA():    
    # Generates RSA Encryption + Decryption keys / Public + Private keys
  

    key = RSA.generate(2048)

    private_key = key.exportKey()
    
    public_key = key.publickey().exportKey()

   

    print(public_key)

    print(private_key)   


generateRSA()