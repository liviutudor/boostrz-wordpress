=== Boostrz Tag Manager ===

Contributors: boostrz

Tags: referral marketing, user acquisition, marketing, boostrz

Requires at least: 4.3

Tested up to: 6.7.1

Stable tag: 1.1.5

License: GNU General Public License (GPL) version 3

License URI: https://www.gnu.org/licenses/gpl-3.0.html

Deploy Boostrz.io tags on your WordPress website.
== Description ==
Boostrz.io is a platform designed to help you track and optimize your marketing efforts by providing comprehensive insights into user behavior and conversions.
This WordPress plugin allows you to easily deploy the Boostrz tracking tag on any WordPress website without needing to manually edit code.

With just a few clicks, you can integrate Boostrz tracking into your site, enabling real-time tracking of user activity and campaign performance across all your pages.
This plugin simplifies the process, making it easy for anyone to start gathering actionable data from their website.

Key Features:

- Quick and easy deployment of the Boostrz.io tracking tag
- No coding required – simple installation via WordPress
- Seamless integration with your existing Boostrz.io account
- Track user interactions, conversions, and campaign success effortlessly
- Real-time data collection and analytics

Simplify tracking and make data-driven decisions with the Boostrz.io WordPress plugin

== Installation ==
If you want to install the plugin from the WordPress official repository follow these steps.

1. In your WordPress dashboard, go to **Plugins > Add New**.
2. Search for _"Boostrz.io Tag Manager"_ in the search bar.
3. Click **Install Now** and then **Activate**.
4. Configure the Plugin:
- Once activated, go to **Settings > Boostrz**.
- Enter your Boostrz.io username and password and click **Authenticate**.
- The plugin will list in the dropdown all the websites you have access to in Boostrz.
- Select the one you want to add the tags for to the current WordPress website and click **Use This Website**
- This will generate the tag and place it from there on on every page and post on your website.


This section describes how to install the plugin manually and get it working.

1. Download the Boostrz.io Tag Deployment plugin from the WordPress plugin repository.

2. Upload to WordPress:
- In your WordPress dashboard, go to **Plugins > Add New**.
- Click the **Upload Plugin** button at the top of the screen.
- Choose the `boostrz-tag-manager.zip` file you downloaded and click **Install Now**.

3. Activate the Plugin:
After the plugin is uploaded, click the **Activate** button to enable it.

4. Configure the Plugin:
- Once activated, go to **Settings > Boostrz**.
- Enter your Boostrz.io username and password and click **Authenticate**.
- The plugin will list in the dropdown all the websites you have access to in Boostrz.
- Select the one you want to add the tags for to the current WordPress website and click **Use This Website**
- This will generate the tag and place it from there on on every page and post on your website.

== External services ==
This plugin will connect to [the boostrz.io backend services](app.boostrz.com) to obtain a token needed to retrieve the Boostrz tag to embed into your pages. In the **Options** page of the plugin, when prompted for your Boostrz username and password, this plugin will connect to the boostrz.io backend to retrieve such a token. It then uses the token to retrieve and store the script tag which will be embedded in your website.
Note that apart from the username and password you supply, no other information is passed to the Boostrz backend. Also, the username and password is _NOT_ saved in the WordPress database to avoid security breaches.
This service is provided by Boostrz: [terms of use](https://boostrz.io/terms-of-use/), [privacy policy](https://boostrz.io/privacy-policy/).

== Frequently Asked Questions ==
= How do I get an account for the Boostrz platform? =
You can signup for free on https://boostrz.io and create your account there.

= Does the plugin rely on any 3rd party services? =
Yes, the plugin will connect to the boostrz.io backend services to obtain a token needed to retrieve the Boostrz tag to embed into your pages. In the **Options** page of the plugin, when prompted for your Boostrz username and password, this plugin will connect to the boostrz.io backend to retrieve such a token. It then uses the token to retrieve and store the script tag which will be embedded in your website.
Note that apart from the username and password you supply, no other information is passed to the Boostrz backend. Also, the username and password is _NOT_ saved in the WordPress database to avoid security breaches.

== Screenshots ==
1. Menu item of the Boostrz WordPress plugin. ![Screenshot](img/screenshot-1.png)
2. Main screen of the Boostrz WordPress plugin. ![Screenshot](img/screenshot-2.png)
3. Boostrz tag running on a website as a result of the plugin configuration. ![Screenshot](img/screenshot-3.png)

== Changelog ==
= v1.0.0 =
* Initial release

