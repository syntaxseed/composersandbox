#!/bin/sh

# Path to this exact file:
#DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
DIR="."

# Parse the arguments passed to this script:
for i in "$@"
do
case $i in
    --precommit=*)
    PRECOMMIT="${i#*=}"
    shift # past argument=value
    ;;
    --anotheroption=*)
    ANOTHEROPTION="${i#*=}"
    shift # past argument=value
    ;;
    *)
          # unknown option
    ;;
esac
done

echo "\\033[01;34mSetting Git Hooks...\\033[0m"

# Check if Git Hooks dir exists.
if ! [ -d "$DIR/.git/hooks/" ]; then
    echo "No .git/hooks/ directory. $DIR/.git/hooks/"
    exit 1;
fi

# Set up pre-commit:
if [ -f "$DIR/hooks/git/precommit.sh" ]; then
    printf "#!/bin/sh\n\nset -- ${PRECOMMIT}\n. \"$DIR/hooks/git/precommit.sh\"" > $DIR/.git/hooks/pre-commit
    echo "\\033[01;34mSetup Pre-Commit hook (${PRECOMMIT}).\\033[0m"
fi
