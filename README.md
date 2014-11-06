# Welcome to Portal #
The [SmarterApp](http://smarterapp.org) Portal has two basic functions. For non-logged-in users, it provides generic information regarding Smarter Balanced assessments, including links to download the Secure Browser. For logged-in users, the portal provides links to only the components for which the logged-in user has permissions, in the private pages. Some links may also be available on public-facing pages - but those are left to the discretion of the deploying entities. Portal's main features include:

* SSO Integration
* Private and Public pages
* Built on the popular Wordpress platform  

## License ##
This project is licensed under the [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html).

## Getting Involved ##
We would be happy to receive feedback on its capabilities, problems, or future enhancements:

* For general questions or discussions, please use the [Forum](http://forum.opentestsystem.org/viewforum.php?f=5).
* Use the **Issues** link to file bugs or enhancement requests.
* Feel free to **Fork** this project and develop your changes!

## Module Overview
The Portal consists of Wordpress installation plus the use of a customized SAML/SSO plugin (saml-20-single-sign-on).

## Dependencies
Portal logged-in user functionality is dependent on the following SmarterApp components:

* Permissions
* Program Management
* Single Sign On (OpenAM v.11.0.+)

## Setup

1. Install Wordpress on a Linux box (Ubuntu Linux 12.04+ recommended)
1. Configure Wordpress according to the instructions provided in the `Documentation` folder.
1. Log in to the WP admin interface as WP Admin and install the SAML 2.0 plugin code from this Portal repository, not the official [saml-20-single-sign-on](https://wordpress.org/plugins/saml-20-single-sign-on/) plugin.

### Configuring Permissions Component
1. Create an entry for every component under "Manage Components."
1. Create a Role called Portal Agent, with tenancy at every level of the hierarchy. 
1. There is no need to assign permissions to components or map roles to permissions.

### Configuring Program Management Component
1. Create an entry for each component being served by Portal. **The “component names” in Program Management must exactly match the component names in Permissions app.**  
1. Create a configuration for Portal containing a set of properties. Program Management properties need to be set for proper functioning of the logged-in portion of the Portal. Sample Portal properties may be found at [config/portal-progman-config.txt]. What follows is an explanation of each Program Management key/value pair.

* `iconRelativePath=wp-content/themes/smarterbalanced/images/component_icons/` - Local WP relative path of SmarterApp icon location for display on the logged-in Portal page.

For each component defined in the SmarterApp ecosystem, the following four key/value pairs must be defined:
```
COMPONENT NAME=component
COMPONENTNAME.displayname=COMPONENT NAME
COMPONENTNAME.url=https://COMPONENT.URL
COMPONENTNAME.icon=COMPONENT.png
```

As a working example, this is how Core Standards component would be set up. 

* `Core Standards=component` - Defines a component named "Core Standards." This component name, stripped of any spaces, becomes the identifier for the remaining three keys.
* `CoreStandards.displayname=Core Standards` - Defines the name to use in Portal when displaying the icon for this component. The display name does not have to exactly match the component name defined above.
* `CoreStandards.url=https://cs.url.org:8443/` - Defines the URL for the component itself; when logged-in users click here, they are redirected to this URL.
* `CoreStandards.icon=core_standards.png` - Defines the icon name for this component. The icon must be located on the local filen system, at the location defined in `iconRelativePath`.

Repeat the above for each component that needs to be accessible from Portal.

### Configuring SSO/SAML
1. Go to /var/www/wordpress/wp-content/plugins and rename saml-20-single-sign-on to, say, saml-20-single-sign-on-
1. Log into the portal as WP Admin
1. Go to /var/www/wordpress/wp-content/plugins and rename saml-20-single-sign-on- back to saml-20-single-sign-on
1. In the WP admin console, go to Settings -> Single Sign-On, and navigate to the Identity Provider tab. 
1. In the first URL box (IdP URL) enter the IdP config URL (e.g. https://your.openam.domain/auth/saml2/jsp/exportmetadata.jsp?realm=/sbac) and click "Fetch Metadata," then Update Options if all looks correct.
1. Log in to the associated OpenAM instance, go to Federation tab, and add Entity. Enter the WP SP URL (e.g. http://portal.your.portal.domain/wp-content/plugins/saml-20-single-sign-on/saml/www/module.php/saml/sp/metadata.php/1), save.
1. Click on the realm (e.g., sbac) and add the newly added SP to the Circle of Trust.
1. Provision a new user in your SSO system using the Administration and Registration Tools (ART) component named portal.agent@example.com, with a Role of *Portal Agent* at the *Client* level.

### Portal Backend Service Configuration
Several services need to run on Portal in order to integrate with SSO, Program Management, and Permissions.

1. Copy dump_component_mapping.pl to /usr/local/bin/dump_component_mapping.pl (be sure to update the URLs within this script to match your environment)
1. Copy dump_component_mapping.sh to /usr/local/bin/dump_component_mapping.sh
1. Install a crontab for root to execute /usr/local/bin/dump_component_mapping.sh periodically - for example, once or twice daily.