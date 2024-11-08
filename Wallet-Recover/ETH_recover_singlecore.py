from discord_webhook import DiscordWebhook
import requests
from bip_utils import Bip39MnemonicGenerator, Bip39SeedGenerator, Bip39WordsNum, Bip44, Bip44Changes, Bip44Coins
import time # for benchmark

# CONFIG
myETHAddress = '0x554f4476825293d4ad20e02b54aca13956acc40a'
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
    # base = 'topETH.txt'
    # f = open(base, 'r')
    # t = set(f.read().split('\n'))
    # f.close()
    # start_time = time.time() # for benchmark
    while True:
        mnemonic_words = Bip39MnemonicGenerator().FromWordsNumber(Bip39WordsNum.WORDS_NUM_12) # 12 words
        
        # generate seed from mnemonic
        seed_bytes = Bip39SeedGenerator(mnemonic_words).Generate()
        bip44_mst_ctx = Bip44.FromSeed(seed_bytes, Bip44Coins.ETHEREUM)
        bip44_acc_ctx = bip44_mst_ctx.Purpose().Coin().Account(0)
        bip44_chg_ctx = bip44_acc_ctx.Change(Bip44Changes.CHAIN_EXT)
        bip44_addr_ctx = bip44_chg_ctx.AddressIndex(0)

        generatedAddress = bip44_addr_ctx.PublicKey().ToAddress()
        # generatedAddress = generatedAddress[2:] # for ETH base without 0x

        # if generatedAddress in t:
        if generatedAddress == myETHAddress:
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
    main()
