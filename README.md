# Twig CLI

## Installation:

    $ wget https://github.com/xrash/twig-cli/raw/master/bin/twig.phar -O /tmp/twig.phar
	$ chmod +x /tmp/twig.phar
	$ sudo mv /tmp/twig.phar /usr/local/bin/twig

One liner:

    $ wget https://github.com/xrash/twig-cli/raw/master/bin/twig.phar -O /tmp/twig.phar && chmod +x /tmp/twig.phar && sudo mv /tmp/twig.phar /usr/local/bin/twig

## Usage:

Passing files as arguments:

    $ twig file1.html.twig file2.html.twig > result.html

Processing the input through STDIN:

    $ cat file.html.twig | twig > result.html

Using inline parameters:

    $ cat file.html.twig | twig -p title="My Title" -p env=dev > result.html

## TODO

 - Accept parameters from JSON and/or YAML files.
 - Option to process every .twig file (recursively) inside a directory and outputting in another one.
 - Option to load an internal Twig Environment (from a given directory), then processing the input as a template name instead of a filename.
