The project is a partial clone of the Instagram Application.

On Registering a new user, the application first creates a default profile for the user with no Image available Profile Picture
It then sends a welcome Email. In this case using mailtrap emails application.

On login, the Application lands on the Posts Page. Showing the last five posts in Descending order i.e using the latest() function

It also provides for creation of new posts, upload of new images with the image validation functionality.

Included is the Profile edit functionality which only allows editing for the authenticated user's profile. Any other user viewing or following the user will not have the authorization to update the profile.

It also includes the follow and unfollow functionalities using laravels toggle functionality.

Also included is the Number of posts, followers and following per user in this case bringing into picture the use of cache and the expiry set to 30 seconds.

The database used is sqlite which can be installed using VI.
