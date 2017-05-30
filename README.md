GoGifYourself
=============
GoGifYourself is a project born with the idea of life situations illustrated by Gifs. If possible funny gifs, which makes the project fun.
I decided to write it in PHP which is my main web development language, with the Symfony 3 framework because, well, it's so handy, so trendy, and it's a way for me to practice the framework outside my job and to have a different project and different implementation of things from work. 

It will be only available in french to begin with. Inspired by similar projects like "Les Joies du Code" (the joys of code), and all the "Vie ma vie de.. métier" (life my life of...profession), here are the main possibilities :
(some features are still in development, but I'm talking at present tense to show how will the final project will be)
+ There are categories, so everybody can find gifs to relate to, depending on their profession.
    + Possible categories can be for example :
        + "Ma vie de développeur" (my life as developper)
        + "Ma vie de graphiste" (my life as a graphist)
        + "Ma vie de réceptionniste" (my life as a front desk receptionist)
        + "La vie au bureau" (life at the office)
        + etc ...
    + There can be as many categories as users think of, no limit.
    + Users can choose their favorite categories and have a wall that displays only gifs related to their favs.
+ There also are tags, just like HashTags on social networks, and users can find gifs by tags.
+ Users can upload their own gifs and create tags and categories if they don't already exist (but the user creations are submitted to moderation).
+ Users can log in with their social network accounts.

For now there is not really a way to see the project live as I work on it on free time, usually the evening after work (not every day though) and weekends. The main reason I put it on this GitHub is that Git is kinda the basic stuff a developer needs to manage project code, and to show you my source code, how I decided to conceive the application and the reason behind my choices of modules division.
As you can see in the source code, I divided the project in three main bundles (+ the UserBundle which inherits from FOSUserBundle) : 
+ ApiBundle:
    + I'm planning to do a cross platform mobile app for the project, and I plan on coding the front-end in JavaScript, but I'm still a beginner with JS and still have to choose the right JS FrameWork to work with.
    + In the meantime, I write the API along with the APP, so when I get fully on the JS part, the API will be ready to use.
    + Why haven't I written the APP in JS right at the begining ? Good question. I wanted to increase my level in Symfony3 and focus on it first, and didn't want to learn a JS framework at the same time, because learning a framework needs a lot of focus, I wanted to commit myself fully to Symfony3, since I can manage TWIG, jQUERY and other simple front-end stuff.
+ AppBundle:
    + This is where the app is developped : controllers and views, and engine related entities.
+ DataBundle:
    + This is where all the data is being managed : entities, repositories, services, forms etc. 
    + Why ? Since I'm developping an app and an API, I wanted the data to be centralized, which makes more sense.
+ In the end, I kinda divided my project into a higher layer of MVC. And MVC above the MVC. How cool is that ?

There is still a lot todo, and if one wishes to join the project, I'm open to discussion :) !


    