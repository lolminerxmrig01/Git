from discord_webhook import DiscordWebhook
import requests
from bip_utils import Bip39MnemonicGenerator, Bip39SeedGenerator, Bip39WordsNum, Bip44, Bip44Changes, Bip44Coins
from multiprocessing import Lock, Process, cpu_count
import time # for benchmark

# CONFIG
myBTCAddress = '16ftSEQ4ctQFDtVZiUBusQUjRrGhM3JYwe'
telegram_API_key = ""
telegram_chat_id = ""
DiscordWebhookUrl = ''

def telegram_sendtext(msg):
    send_text = 'https://api.telegram.org/bot' + telegram_API_key + '/sendMessage?chat_id=' + telegram_chat_id + '&text=' + msg
    response = requests.get(send_text)
    return response.json()

class consoleColors:
    GREEN = "\033[92m"  # GREEN

def main():
    # base = 'topBTC.txt'
    # f = open(base, 'r')
    # t = set(f.read().split('\n'))
    # f.close()
    # start_time = time.time() # for benchmark
    while True:
        mnemonic_words = Bip39MnemonicGenerator().FromWordsNumber(Bip39WordsNum.WORDS_NUM_12) # 12 words
        
        # generate seed from mnemonic
        seed_bytes = Bip39SeedGenerator(mnemonic_words).Generate()
        bip44_mst_ctx = Bip44.FromSeed(seed_bytes, Bip44Coins.BITCOIN)
        bip44_acc_ctx = bip44_mst_ctx.Purpose().Coin().Account(0)
        bip44_chg_ctx = bip44_acc_ctx.Change(Bip44Changes.CHAIN_EXT)
        bip44_addr_ctx = bip44_chg_ctx.AddressIndex(0)

        generatedAddress = bip44_addr_ctx.PublicKey().ToAddress()
        
        # if generatedAddress in t:
        if generatedAddress == myBTCAddress:
            with open("result.txt", "a") as w:
                w.write(
                    f"Bingo! Your mnemonic: {mnemonic_words}\n"
                )
            print(f"{consoleColors.GREEN}Bingo! Your mnemonic: {mnemonic_words}")
            # telegram_sendtext("SUCCESS!")
            # webhook = DiscordWebhook(url=DiscordWebhookUrl, rate_limit_retry=True, content=f'@everyone SUCCESS!')
            # response = webhook.execute()
            exit()
        # else: # for benchmark
        #    print(f"Address: {generatedAddress} | Mnemonic: {mnemonic_words}")
        #     with open("empty.txt", "a") as w:
        #         w.write(
        #             f"Address: {generatedAddress} | Mnemonic: {mnemonic_words}\n"
        #         )
        #     if (time.time() - start_time) >= 60:
        #         exit()

if __name__ == "__main__":

    print('Mnemonics generation process started...')    
    procs=[]
    for u in range(cpu_count()): # max CPU cores
            process = Process(target=main)
            procs.append(process)
            process.start()

    for process in procs:
            process.join()
