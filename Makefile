COMPOSER_BIN := composer
PHPUNIT_BIN := ./vendor/bin/phpunit
BUGFREE_BIN := ./vendor/bin/bugfree
PHPCS_BIN := ./vendor/bin/phpcs

depends: vendor

cleandepends: cleanvendor vendor

vendor: composer.json
	$(COMPOSER_BIN) --dev update
	touch vendor

cleanvendor:
	rm -rf composer.lock
	rm -rf vendor

lint: depends
	echo " --- Lint ---"
	$(BUGFREE_BIN) lint src/main src/test
	echo

typefix: depends
	echo " --- Autofixing uses ---"
	$(BUGFREE_BIN) lint -a src
	echo

style:
	echo " --- Style Checks ---"
	$(PHPCS_BIN) --standard=vendor/vektah/psr2 src/main src/test


test: lint depends
	echo " --- Unit tests ---"
	$(PHPUNIT_BIN)
	echo

.SILENT:
