echo "\\033[01;104m ▶▶ Running Pre-Commit Checks... \\033[0m"

echo "\\033[01;104m ** PHPCS ** \\033[0m"
phpcs --standard=PSR1 --extensions=php,phtml --ignore=*/vendor/* .
if [ $? -ne 0 ]; then echo "\\033[01;104m\n ⯀ PHCS Did Not Pass \\033[0m"; exit 1; fi

echo "\\033[01;104m ** PHPUNIT ** \\033[0m"
phpunit --colors=always --bootstrap vendor/autoload.php
if [ $? -ne 0 ]; then echo "\\033[01;104m\n ⯀ PHPUnit Did Not Pass \\033[0m"; exit 1; fi

echo "\\033[01;104m\n ▶▶ Passed! Committing as $(git config user.name) \\033[0m"
