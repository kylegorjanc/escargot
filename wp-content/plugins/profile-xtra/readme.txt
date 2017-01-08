=== Profile Xtra ===

Contributors: ernestortiz
Plugin URI: https://github.com/ernestortiz/profile-xtra
Donate link: http://paypal.me/ernestortiz
Tags: author, author image, profile, avatar, bio, user, alternative author, social links, twitter, linkedin, google plus, facebook, author link
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds some xtras to authoring profile: profile image, social media contacts & alternative author.


== Description ==

With this plugin an author can nicely add an image to its profile (an use it on their posts instead of the avatar). Some different social addresses can be added also by the author. The image, bio and social contact can be placed anywhere in the post (using shortcode or its widget form).

Sometimes you want to add an article from certain person, but not neccesarly register that person as an author to your blog. With this plugin, you simply add that (<em>alter</em> or alternative) author directly when you create or edit the post. In the backend, to wordpress, you are the author (you have such capability), but in all other aspects, in the frontend, the alter author appears as the author of that post.


== Installation ==

1. Upload unzipped plugin directory to the /wp-content/plugins/ directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.


== Frequently Asked Questions ==

= So, this is like a three-in-one cabinet plugin? =

Right. Althought imbricated in programming you can distinct three modules or parts: profile image, social contacts, and alter author ("alter" means "other", in Latin). Please, visit the Options page of the plugin to enable or disable any of this parts (alter author is disabled by default)...

= Can I change font awesome icon used for link to the twitter author's account? =

You can change it directly on the style sheet of your theme (the usual way yo do it with Font Awesome). And can change its properties (font-size, color, etc.) as well.

= How can use this plugin in a widget? =

Well, shortcodes can be used as widgets using the text widget. Just write the shortcode on the text widget content; for example <em>[profilextra]</em>

= So, back to the shortcode... =

Our shortcode is simple:

    To show user name, image, description & link to webpage (in that order):
        [profilextra]

but it has many arguments, and arguments has several values, in order to be widely adapted to the users needs or desires. If an argument is not presented, its default values will be considered; the particular shortcodes values have a preference over the general options of the plugin.

Lets see the arguments and its values, and some samples to clarify it:

The argument SHOW determines what to show. Its values are: <em>n</em>, <em>i</em>, <em>d</em>, <em>s</em>
(for <em>name</em>, <em>image</em>, <em>description</em>, and <em>social contacts</em>), or a combination of them, separated by commas. When more than one value is used, it appears in the literal order.

    To show only the social contacts of the author:
        [profilextra show="s"]
    To show the image and then the name of the author:
        [profilextra show="i,n"]

You can pass a class to the image using the argument ICLASS:

    To show the author image with certain style (defined by the class "roundimg"):
        [profilextra iclass="roundimg"]

In the Options page of this plugin, you can choose to show the link to the social accounts of the author with the proper name (literally "twitter", for example), or with the regular icon, or with the squared icon. The argument SOCIAL_SHOW is used to overwrite the option of the plugin related to Font Awesome icons. Its values are: <em>name</em> (show only the name), <em>icon</em> (show only the icon), <em>iconr</em> (show only the rounded icon), <em>both</em> (show both, name and icon), or <em>bothr</em> (show both, name and rounded icon).

The argument SOCIAL decides which social account to show. Its values are: <em>w</em> (for website, which is the default value), <em>t</em> (for twitter), <em>f</em> (for facebook), <em>l</em> (for linkedin), <em>g</em> (for google plus), <em>e</em> (for email), or a combination of them, separated by commas. Let's see some examples:

    Do not show any social account at all:
        [profilextra social=""]
    Show rounded icons for website and twitter (in that order):
        [profilextra social="w,t" social_show="iconr"]

This plugins shows tha data of the current author, but you can show the data of a given author passing its id with the argument USER_ID.

And, finally, there is an argument to pass a class to the whole: WRAP_CLASS (its default value is 'profilextras').


== Screenshots ==

1. The "Social contact" part in the Options page of this plugin. (Please, note that we checked to include a "Twitter" field in the profile page)...
2. ...So, in the profile page a new field ("Twitter") appears under Contact Info; thanks to the "Social contact" part of this plugin.
3. Also, if desired, thanks to the "Profile image" part of this plugin, you can choose to set or upload a profile image and use it instead of your avatar.
4. Uploading Profile image.
5. Profile image ready in Profile page (don´t forget to save).
6. Your profile image appears on Users page too.
7. Using text widget, you can also widgetize the shortcode...
8. ...And see the widgetized shortcode in action.
9. If the "alter author" part of this plugin is enabled, the Alternative Author metabox appears.
10. Once filled (at least the name) and saved, the data of alter author is considered instead of the Author's.
11. Name, profile image and description of alter author...


== Donations ==

If you want to help me in writing more code or better poetry, please invite me to a beer (or coffee, maybe) by sending your thanks to http://paypal.me/ernestortiz. Thanks in advance.


== Changelog ==

= 1.0.0 =
* Stable Release

