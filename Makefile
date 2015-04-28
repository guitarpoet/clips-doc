DB := web_dev

cache:
	@mkdir -p application/cache
	@sudo chown -R _www:_www application/cache

test:
	@phpunit
migrate:
	@mysql -u root -e "drop database if exists ${DB}"
	@mysql -u root -e "create database ${DB}"
	@./vendor/bin/clips phinx migrate
c:
	@mysql -u root "${DB}"
