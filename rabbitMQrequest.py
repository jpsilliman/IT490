from configparser import SafeConfigParser


parse = SafeConfigParser()
parse.read('conf.ini')

#Grab info from conf.ini

api_ver = parse.get('main','api_ver')
api_username = parse.get('main','api_username')
api_password = parse.get('main','api_password')
interval = parse.get('main','interval')

