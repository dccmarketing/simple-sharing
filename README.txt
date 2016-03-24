=== Simple Sharing ===
Contributors: slushman
Donate link: http://slushman.com/
Tags: social, sharing, buttons, baidu, buffer, delicious, digg, douban, email, evernote, facebook, google plus, linkedin, pinterest, qzone, reddit, renren, stumbleupon, tumblr, twitter, vk, weibo, xing
Requires at least: 3.0.1
Tested up to: 4.3.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Sharing creates buttons for sharing your content on social networks using Share URLs.



== Description ==

Simple Sharing creates a set of buttons for sites that offer sharing URLs, allowing site visitors to share your content without heavy Javascript or API calls.

= Features =
These are the current sharing options:
* Baidu
* Buffer
* Delicious
* Digg
* Douban
* Email
* Evernote
* Facebook
* Google+
* LinkedIn
* Pinterest
* QZone
* Reddit
* Renren
* Stumbleupon
* tumblr
* Twitter
* VK
* Weibo
* Xing

Each button can be selected or unselected and reordered. The buttons can appear either with the name or icon with the respective site. Each appears on a solid-color background, using the brand color of the respective site. Any of the colors and styling can be overridden in your theme's CSS.

The sharing buttons can be auto-displayed at the bottom of posts and/or pages. The sharing URL can behave as a typical link or appear in a pop-up window.

Shared content on Delicious, tumblr, and Twitter can be attributed back to your account.


h
= Feedback =
I'm happy to take feature requests. Here's my current todo list:
* Save on/off selections via AJAX
* Give the option to use a modal instead of a pop-up window for sharing.
* Add additional post types for auto-display options.

If you want to add anything else, let me know:
* Email: chris at slushman dot com
* Twitter [@slushman] (https://twitter.com/slushman)
* Follow me on [Facebook] (https://www.facebook.com/slushmandesign)
* File bug reports and/or suggestions on [Github] (https://github.com/slushman/simple-sharing)



== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set the plugin settings
4. Display the buttons on your site by doing one or more of the following:
	* Checking the plugin setting for automatically placing the sharing buttons at the bottom of posts and/or pages
	* Putting the [simplesharingbuttons] shortcode on a page or post
	* Placing `<?php echo apply_filters( 'simplesharing', '' ); ?>` in your templates



== Frequently Asked Questions ==

= Can I chose which buttons are dusplayed on my site? =
Go to the plugin settings and click on the buttons you'd like to display. Save the settings.

= Can the buttons appear automatically at the bottom of my posts? =
Yes! Check which post type you want them to appear on in the plugin settings. As of version 1.0.0, it can add them automatically to post and/or pages. Other post types will be added in the future.

= Can I add them in my page template? Is there a template tag? =
Yes, you can add them to your template. I'm using Andrew Nacin's suggestion of using a WordPress action instead of a template tag. Put `echo apply_filters( 'simplesharing', '' );` in the place you want them to appear.

= Is there a shortcode? =
Yes! There are no shortcodes options/attributes, so its super-simple. Put `[simplesharingbuttons]` into any post, page, or content editor and the buttons will appear there.

= Do I need to use the fields in the "Your Social Accounts" section?
When someone shares something on Delicious, tumblr, and/or Twitter, it can attributed back to the source (that would be you). For example, on Twitter, it would look something like:

Article Title http://article-link.com via @your-twitter-name

That last bit attributes the tweet back to you and you're notified someone tweeted a link to your article. To get that attribution for Twitter, just enter your Twitter username in the "Twitter Account" field and save the options.

Same goes for tumblr and Delicious.

= Why isn't there a button for "___"? =
These buttons use URLs provided by the network. I have included as many of these options as possible, but not all networks provide a sharing URL. I'd love to include Instagram, Flickr, YouTube, and others, but they all require you signing into their APIs in order to post. There are plenty of other plugins if you need those options.

= Can I reorder the buttons? =
Yes! Just drag any button into the order you prefer and it saves its position automatically.

= What about a modal window instead of a pop-up? =
Yeah, I'd like that also. Soon.

= What about adding "___"? =
I'm happy to take feature requests. Here's my current todo list:
* Make buttons sortable (drag and drop to reorder)
* Make a modal instead of a pop-up window for sharing
* Maybe a widget?

If you want to add anything else, let me know:
* Email: chris at slushman dot com
* Twitter: [@slushman] (https://twitter.com/slushman)
* Follow me [Facebook] (https://www.facebook.com/slushmandesign)



== Screenshots ==

1. All the buttons, at the bottom of a post.
2. The plugin settings page.



== Changelog ==

= 1.0.0 =
* First version.



== Upgrade Notice ==

= 1.0.0 =
First version.



== Credits ==

Thanks to [Chris Ferdinandi](https://github.com/cferdinandi) for the original idea.
Thanks to [Jon Suh](https://jonsuh.com/) for the great [tutorial](https://jonsuh.com/blog/social-share-links/) on the pop-up and sharing buttons.