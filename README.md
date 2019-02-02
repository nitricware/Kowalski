# Kowalski

Kowalski is a developer portfolio and dev-blog solution.

## Customize

There are two things to consider when customising the software.

1. Change variables in ```./src/system/siteVars.php``` - Those variables include your real name, your company name or alias, a password for restricting access to the upload functionality and more.
2. Create your own template set. This software comes with some bare bones templates showing some of [Tonic][2]'s features and how to achieve certain things but nothing more. There are no limits to your creativity.

## .gitignore files

The .gitignore files in the content folder are made for easy testing. Whatever you place in ```content\blog```, ```content\files```, ```content\frontpage``` or ```content\pages``` will not be tracked by git.

## Dependencies

This project uses a modified version of [Parsedown][1] (added syntax highlighting) and the vanilla version of [Tonic][2] and [GeSHi][3]. All three are included with the download.

## Changelog

1. 23.1.2019 - initial release
2. 2.2.2019 - added syntax highlighting to the blog feature

[1]: https://github.com/erusev/parsedown
[2]: https://github.com/rgamba/Tonic
[3]: http://qbnz.com/highlighter/