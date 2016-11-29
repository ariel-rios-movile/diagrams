import hashlib
import requests

API_URL = "http://test.eclubstore.com/reseller/merchant-panel/request_xml.php"

SKU = {
    "USD5": "ESW05_P",
    "USD10": "ESW10_P",
    "USD15": "ESW15_P",
    "USD20": "ESW20_P",
    "USD30": "ESW30_P",
    "USD50": "ESW50_P",
    "USD60": "ESW60_P"
}


EMAIL = "gustavo.ortiz@movile.com"
MERCHANT_KEY = "q7h96juAOq37BMHq2eZgFP1JRo8i7329"
MERCHANT_PASSWORD = hashlib.md5().update("test@telefonica923")
TRANSACTION_CODE = "GS0000012"

signature = hashlib.sha1(
    "%s%s%s" % (MERCHANT_KEY, MERCHANT_PASSWORD, TRANSACTION_CODE)
).digest().encode('base64').strip()

xml = """
<?xml version="1.0" encoding="UTF8" ?>
<request>
  <Type>order_submission</Type>
  <MerchantEmail>%(email)s</MerchantEmail>
  <Signature>%(signature)s</Signature>
  <TransactionCode>%(transaction_code)s</TransactionCode>
  <Items>
    <Item>
      <SKU>%(sku)s</SKU>
      <Qty>%(count)d</Qty>
    </Item>
  </Items>
</request>
""" % {
    "email": EMAIL,
    "signature": signature,
    "transaction_code": TRANSACTION_CODE,
    "sku": SKU["USD5"],
    "count": 1
}

print(">>> Requesting to %s with data: %s" % (API_URL, xml))

response = requests.post(API_URL, data=xml.strip())
print("<<< Response status code: %d, body: %s" % (response.status_code, response.text))
