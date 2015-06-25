test:
	vendor/bin/phpcs -n --colors  --standard=code_standard.xml --extensions=php  voyage/controllers voyage/models

sniffer:
	vendor/bin/phpcs --report=diff --standard=code_standard.xml --extensions=php  voyage/controllers voyage/models

fixer:
	vendor/bin/phpcbf  --standard=code_standard.xml --extensions=php  voyage/controllers voyage/models
