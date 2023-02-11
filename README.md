# Kowalski

Kowalski is a developer portfolio and dev-blog solution.

## Customize

There are two things to consider when customising the software.

1. Change variables in ```./src/system/siteVars.php``` - Those variables include your real name, your company name or alias, a password for restricting access to the upload functionality and more.
2. Create your own template set. This software comes with some bare bones templates showing some of [Tonic][2]'s features and how to achieve certain things but nothing more. There are no limits to your creativity.
3. Add messages of the day.

Don't forget to rename `./src/system/siteVars.example.php` to `./src/system/siteVars.php` and `./src/system/frontpageMessages.example.php` to `./src/system/frontpageMessages.php`

## .gitignore files

The .gitignore files in the content folder are made for easy testing. Whatever you place in ```content\blog```, ```content\files```, ```content\frontpage``` or ```content\pages``` will not be tracked by git.

## Dependencies

This project uses a modified version of [Parsedown][1] (added syntax highlighting) and the vanilla version of [Tonic][2] and [GeSHi][3]. None are included with the download and must be downloaded with `composer`.

## Publish

There are two ways to publish projects, blog posts and pages. Either upload a .md file or use the built-in editor.

## Messages Of The Day

Kowalski can display 0, 1 ore multiple messages of the day whereever the theme supports it. Simply add messages to the array in `system/frontpageMessages.php`.

## Changelog

1. 23.1.2019 - initial release
2. 2.2.2019 - added syntax highlighting to the blog feature
3. 16.11.2021 - added editor to admin panel
4. 11.2.2023 - improved admin editor, added setting to hide link to frontpage and make the blog the default page, more flexible messages of the day system

[1]: https://github.com/erusev/parsedown
[2]: https://github.com/rgamba/Tonic
[3]: http://qbnz.com/highlighter/