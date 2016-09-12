![](https://cdn.pbrd.co/images/2kXUegn87.png)

Command-line tool to parse TODOs from files.

[![Software License][ico-license]][link-license] 

Parses files and finds TODOs. 
Provides an *Exporter* interface to hook an action to found TODOs, could be a Trello task exporter, a JIRA issue exporter, a Github Issue exporter, you get the idea.
Doesn't discriminate on file type / extension / size for the moment. Displays results on the CLI.

## Install

[Download the latest tada.phar release](https://github.com/bouiboui/tada/releases)

## Usage

``` bash
# Single file
$ ./tada.phar file.php

# Folder
$ ./tada.phar folder_name

# Folder - recursive
$ ./tada.phar --recursive folder_name
$ ./tada.phar -r folder_name

```

**Output**

![](https://cdn.pbrd.co/images/1syh3HAK.png)

## Credits

- [bouiboui][link-author]
- [All Contributors][link-contributors]

## License

Unlicense. Public domain, basically. Please treat it kindly. See [unlicense.org][link-license] for more information. 

[ico-license]: https://img.shields.io/badge/license-Unlicense-brightgreen.svg?style=flat-square

[link-author]: https://github.com/bouiboui
[link-license]: http://unlicense.org/
[link-contributors]: ../../contributors
