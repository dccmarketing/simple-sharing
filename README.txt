=== Simple Sharing ===
Contributors: slushman
Donate link: http://slushman.com/
Tags: social, facebook, twitter, email, pinterest, linkedin, google plus, tumblr, reddit, sharing
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Sharing creates buttons for social networks using Share URLs.



== Description ==

Some social sites have Sharing URLs where users are able to post things without needing to access an API. Simple Sharing
creates a set of buttons for those sites and allows site visitors to share one of your posts without heavy
Javascript or API calls.

= Feedback =
I'm happy to take feature requests. Here's my current todo list:
* Make buttons sortable (drag and drop to reorder).
* Make a modal instead of a pop-up window for sharing.
* Add additional networks as I find them.
* Add additional post types for auto-display.
* Maybe a widget?

If you want to add anything else, let me know:
* Email: chris at slushman dot com
* Twitter [@slushman] (https://twitter.com/slushman)
* Follow me on [Facebook] (https://www.facebook.com/slushmandesign)



== Installation ==

1. Upload `simple-sharing.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set the plugin settings
4. Use on your site:
	1. Check the plugin setting for automatically placing the sharing buttons at the bottom of posts or pages
	2. Put the [simplesharing] shortcode on a page or post
	3. Place `<?php do_action('simplesharing'); ?>` in your templates



== Frequently Asked Questions ==

= Can the buttons appear automatically at the bottom of my posts? =
Yes! Check which post type you want them to appear on in the plugin settings. As of version 1.0.0, it can add them automatically to post and/or pages. Other post types will be added in the future.

= Can I add them in my page template? Is there a template tag? =
Yes and no. I'm using Andrew Nacin's suggestion of using a WordPress action instead of a template tag. Put `do_action( 'simplesharing' );` in the place you want them to appear.

= Is there a shortcode? =
Yes! There are no shortcodes options/attributes, so its super-simple. Put `[simplesharing]` into any post, page, or content editor and the buttons will appear there.

= Is there a widget? =
No. If there is demand for a widget, I'll add it in a future version though.

= What are the fields in the "Your Social Accounts" for?
When Twitter and tumblr share something, they can attribute them back to the source. For example, on Twitter, it would look something like:

Article Title http://article-link.com via @your-twitter-name

That last bit attributes the tweet back to you and you're notified someone tweeted a link to your article. To get that attribution for Twitter, just enter your Twitter username in the "Twitter Account" field and save the options.

Same goes for tumblr.

= Why isn't a button for "___"? =
These are simple sharing buttons using URLs provided by the network. Only these services provide that kind of thing; the other don't. I'd love to include Instagram, Flickr, YouTube, and others, but they all require you signing into their APIs in order to post. There are plenty of other plugins if you need those options. This one is meant to be simple.

= Can I reorder the buttons? =
Not currently, but I'm working on it. I wanted to get a 1.0 version out ASAP, so here it is. Soon.

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