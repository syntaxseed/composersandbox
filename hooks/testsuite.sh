#!/bin/sh

printf "\033[01;104m\n%-50s \\033[0m" " ▶▶ Running Git Pre-Commit Checks..."
printf "\033[01;104m\n%-50s \\033[0m\n" " ▶▶ ($*)"

if [ `echo $* | grep phpcsfixer| wc -l` -eq 1 ]; then
    echo "\\033[01;104m\n ** PHP CS Fixer ** \\033[0m"
    php-cs-fixer fix . --rules=@PSR1,@PSR2,full_opening_tag --using-cache=no --verbose --dry-run
    if [ $? -ne 0 ]; then echo "\\033[01;41m\n ⯀ PHP CS Fixer Did Not Pass \\033[0m"; exit 1; fi
fi

if [ `echo $* | grep phpmd| wc -l` -eq 1 ]; then
    echo "\\033[01;104m\n ** PHP Mess Detector ** \\033[0m"
    phpmd . text cleancode,codesize,unusedcode,naming,design --exclude "*/vendor/*"
    if [ $? -ne 0 ]; then echo "\\033[01;41m\n ⯀ PHP Mess Detector Did Not Pass \\033[0m"; exit 1; fi
fi

if [ `echo $* | grep phpcpd| wc -l` -eq 1 ]; then
    echo "\\033[01;104m\n ** PHP Copy-Paste Detector ** \\033[0m"
    phpcpd --exclude=vendor/ tests/ .
    if [ $? -ne 0 ]; then echo "\\033[01;41m\n ⯀ PHP Copy Paste Detector Did Not Pass \\033[0m"; exit 1; fi
fi

if [ `echo $* | grep phpunit| wc -l` -eq 1 ]; then
    echo "\\033[01;104m\n ** PHPUNIT ** \\033[0m"
    phpunit --colors=always --bootstrap vendor/autoload.php
    if [ $? -ne 0 ]; then echo "\\033[01;41m\n ⯀ PHPUnit Did Not Pass \\033[0m"; exit 1; fi
fi

echo "\\033[01;104m\n ▶▶ Passed TestSuite! Committing as $(git config user.name) \\033[0m"
