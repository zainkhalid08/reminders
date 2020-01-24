# --- REMINDERS ---

<small>last updated on 30th Dec 2019, remindersforgood@gmail.com</small> 


<hr>

## DEPLOYMENTS

1. First make env file.
<table>
	<tr>
		<th>Enviornment</th>
		<th>APP_ENV</th>
	</tr>
	<tr>
		<td>staging</td>
		<td>APP_ENV=staging</td>
	</tr>
	<tr>
		<td>production</td>
		<td>APP_ENV=production</td>
	</tr>
</table>

<p>Add the following env vars</p>

<code>ADMIN_NAME='admin name here'</code> <br>
<code>ADMIN_EMAIL=remindersforgood@gmail.com</code> <br>
<code>ADMIN_PASSWORD='admin password here'</code> <br>
<code>APP_DEBUG=false</code> <br>

<pre>Tip: you can skip admin name, email and password and just go for php artisan fresh:install:once and it'll ask those...</pre>

2. After env settings are ready. Especially db certs etc <br>
<code>php artisan fresh:install:once</code>

## SYSTEM FEATURES v1 lts

* admin can create post,edit post...
* it'll be shown in the front end after the admin publishes it.

# Ayah Extractor
1. Referencce is not present will still save the content
2. If reference is present then it'll save the reference. 

# Limitations
1. we can't update location or speaker names, just yet.
2. don't upload masjid an nabawi sermons just yet as they are in urdu and is difficult to translate...
3. no password reset for admin
4. !when a post is updated/edited it is automatically unpublished. Will have to publish it again.

# Supports
1. HAVE TO BE TESTED there can be two speakers with same name but different locations 

# Note
<dl>
	<dt>Post</dt>
	<dd>When a tag is updated(attached and/or detached) for a post THEN THE POST ISN'T UNPUBLISHED. Otherwise it is</dd>
</dl>

## Tests

MANUAL TESTS

	Location
		Create Or Update Post
			p | New Location, should be created in db 
			p | Existing Location, should not be created in db

	Speaker
		Create Post
			p | New speaker, should be created in db 
			p | Existing speaker, should not be created in db
		Update Post
			p | New speaker, should be created in db 
			p | Existing speaker, should not be created in db

	Post
		Create
			Is created in db
				posts
					p |	title, content, date, video_src, user_id, published_at(null),  tags
				speakers
					p |	speaker name in speakers table
					p |	location_id in speakers table
				locations
					p |	location name in locations table
				tags
					p |	tag name in tags table
				the ayah from post content is extracted correctly and saved in db
				the hadith from post content is extracted correctly and saved in db
				the post content processing is done after 1 min of the post creation time.
		Update
			p | When speaker is changed it is also changed in post
			p | When location is changed it is also changed in post
			p | When date is changed it is also changed in post
			p | When tags for a post are updated(added, removed) they are is updated in post
					p | when added
					p | when removed
	Ayah
		POST UPDATED
			p | when a new ayah is added in the post content that isn't in db then it is created in db.
			p | when a more than 1 ayahs are added in the post content that aren't in db they are created in db.

			p | when an old ayah is added in the post content that is in db then it isn't created in db.
			p | when more than 1 old ayahs are added in the post content that are in db then they aren't created in db.

			p | when a new ayah is added THAT IS ABOUT 90% SIMILAR to any of the alreaady present in db then it isn't created in db
			p | when more than one new ayah is added THAT ARE ABOUT 90% SIMILAR to any of the alreaady present in db then they aren't created in db | if you change 2-3 words it'll consider as similar, ... haven't tested for more...
			p | if a similar/same ayah is created in another post, even then a new ayah shouldn't be created in db

			p | when there is an html tag especially bold or italics text within ayah then it is removed and then saved in db(ayahs table) without affecting original content

			p | when ayah hadith ayah hadith are as content then they all are created
			p | if two ayah references are same then new one isn't created in ayahs table

			if an ayah doesn't have a reference then its ref isn't saved in db. And every thing works normally.

		POST CREATED
		*all tests for when post is updated

	Hadith
		f | when a hadith tags are kept empty then its contents are still created...?

	Components
		ayah
			p | if rfr attribute is not present it still show QURAN without any errors
			p | if rfr attribute is present but is "" it still show QURAN without any errors
			p | if rfr attribute is present and has text it still show the text
			p | if the text shown is capitalized
			p | if the text shown is surrounded in parenthesis

		hadith
			p | if rfr attribute is not present it still show HADITH without any errors
			p | if rfr attribute is present but is "" it still show HADITH without any errors
			p | if rfr attribute is present and has text it still show the text
			p | if the text shown is capitalized
			p | if the text shown is surrounded in parenthesis

	Feedback
		validation
			name isn't required
			email isn't required
			message is required
			message cannot exceed 700 chars
			form is being repopulated if validation fails

			when a feedback arrives, following is created in db 
				name email message
				mail is sent 
				if any of the 3 quantity is presnet it is shown

AUTOMATED TESTS
	* only mail sending and redirect back of feedback is left.
	* adminpostcontroller tests are left
	* WELCOME PAGE TESTS vendor/bin/phpunit tests/Feature/Http/Controllers/WelcomeControllerTest.php
	* FEEDBACK PAGE TESTS To run feedback tests . It tests
		1. vendor/bin/phpunit tests/Feature/Http/Requests/FeedbackRequestTest.php
		2. vendor/bin/phpunit tests/Feature/Http/Controllers/FeedbackControllerTest.php
		3.  WORST CASE if mail sending fails or feedback creation fails then REDIRECTED BACK WITH PROPER MESSAGE... !TO BE TESTED MANUALLY NO AUTOMATION TEST FOR THIS
	* ALL POSTS PAGE TESTS
		1. vendor/bin/phpunit --filter test_all_seo_tags_for_all_posts_page_are_present tests/Feature/Http/Controllers/PostControllerTest.php
		2. vendor/bin/phpunit --filter test_ONLY_PUBLISHED_posts_are_shown tests/Feature/Http/Controllers/PostControllerTest.php
		3. vendor/bin/phpunit --filter test_UNPUBLISHED_posts_are_NOT_shown tests/Feature/Http/Controllers/PostControllerTest.php
		4. vendor/bin/phpunit --filter test_if_posts_are_more_than_pagination_limit_then_pagination_links_are_available tests/Feature/Http/Controllers/PostControllerTest.php
		5. vendor/bin/phpunit --filter test_latest_published_posts_are_shown_first tests/Feature/Http/Controllers/PostControllerTest.php
		6. vendor/bin/phpunit --filter test_more_than_PAGINATION_CONFIGUTED_LIMIT_number_of_posts_are_not_shown tests/Feature/Http/Controllers/PostControllerTest.php
	* SINGLE POST PAGE TEST
		1. vendor/bin/phpunit tests/Feature/Http/Requests/PostShowRequestTest.php
		2. vendor/bin/phpunit --filter test_if_post_is_published_then_should_see_post tests/Feature/Http/Controllers/PostControllerTest.php
		3. vendor/bin/phpunit --filter test_all_post_related_content_is_visible tests/Feature/Http/Controllers/PostControllerTest.php
	* SECURITY REALTED TESTS
		1. vendor/bin/phpunit tests/Feature/Http/Middleware/AdminMiddlewareTest.php
		2. vendor/bin/phpunit tests/Feature/Http/Requests/PostShowRequestTest.php


Front End Tests
1. p | apx. have title approximate at all 3 places where you see apx.
2. 

# CODE DOCUMENTATION
 app envornments are local, staging (staging not STAGING)
1. views/partials : where front end partials are kept
2. the way we want the text to be displayed for visitors, we'll store the text in that way in db.(insead of getting in that way-less loadtime.)
3. we are just using QUEUE_CONNECTION=sync for now as long as there is only one user who creates the post... (it might take some time in creation/updation but is worth perhaps)
4. all title aria-label etc will be in lower case
5. to set all seo related stuff title, description of static pages goto config/seo.php
6. for any new page you make, for seo use
	    use SeoHelper;

        $seo = [
            'title' => config('seo.welcome.title'),
            'meta' => config('seo.welcome.meta'),
        ];
        $seo = $this->mergeWithTemplate($seo); 
        and send it to the view
        for eg. see WelcomeController@welcome
7. use Model::create([]) to create the model not ->save(). As we do use model events to send mails... etc so just to get them triggered just as we want. 
8. if you want to make use of a view composer then use availableData as a key
9. use updateOrCreate not createOrUpdate for your own functions
10. we use Request classes for validation AS WELL AS FOR AUTHORIZATION 
11. input fileds corespond to
            'n3kIad3' => 'nullable|string', // name
            'eaWDsk2' => 'nullable|string|email', // email
            'mw2s8sJ' => 'required|string|max:700', // message
            'Vw82iwl' => 'required|in:2,two', // verification
12. resources/views/components will has dynamic html & scripts
12. resources/views/components will have scripts and html related blade files
14. resources/views/partials has static html

# TODOS

NOT YET/IDEAS
*if the video isn't loaded from youtube...is there a way to tell... or prevent that ugly message....
*pagination on olderfriday sermons
*show all tables in admin panel
*about post
	*adding a meaning of difficult words as a title eg. <span title="diminish the worth or value of (a quality or achievement). From Oxford">detracts</span>
	*to highlight the text blue... where imp for posts
	*play the video of on time click from that time on youtube vieo
*roles
*views count for a post.
*tags description on admin, to show description on hover
*have a component dua also perhaps.
*search feature
*useful links perhaps
*feedback from visitors
*to crop the images a little further to decrease size bits...
*admin,stats of visitors to store in db
*static pages, privacy policy, about us, terms of service... etc
* to delay the job after post is created to extract ayah and hadith
* also validate that ref is valid in content's ayah 
*design color some letters different in reminders for good *dot in the logo or color dot as dot of the i
*add rel and perhaps logo on welcome...
*write tests for post update and what other things that are left...
* the feedback image is a bit upper than others as the text written is only feedback
6. start/end in between hr... decide.P
*google audit (really a long work and an art)


# CHECKLIST BEFORE DEPLOYMENT

Make fonts locallll  (test by disabling the internet) (optional)
1. refactor backend (files & code) DONE.
2. refactor fronend (files & code) DONE.
3. finalize ayah extractor, 
4. hadith extractor
5. decide for search...
20. Final test for main features... 
extra
21. make feedback notifications just like callcout...to make system announments concistant.
22. finalize the titles and descriptions for 3 pages

# STAGING/LIVE CHECKLIST
17. make sure that public directories arne't accessable. FIRST WE'LL GO FOR staging.remindersforgood.com and then...

# DONE
*decide the header image
?*force a format of all the content shown to user especially the post heading and subheadings. 
*decide a design for ayah, hadith
*fix new location,speaker creation. DONE
*make template for hadith, ayah, fact or so. DONE

*system to add reference to ayah eg (quran - baqrah:1)
*system to add reference to hadith (hadith - muslim)
plan
	done. make seeder for surahs
	make component for ref... 2:4 (means surah 2 and ayah 4)
	2:5 
		while setting
			search for 2:5 and replace with baqrah:5.
		while getting
			search for 2:5 and replace with baqrah:5.

*finalize urls
	*friday-sermons
	*friday-sermon/the-last-day/masjid-al-haram/1
	*friday-sermon/1/the-last-day/masjid-al-haram This is good
*mins read is also to be done.
*don't reveal the id. WE WILL REVEAL FOR USERS TO SEE ALL POSTS
*minify css js and vue in production
*meta description for seo
CUSTOM TEXTAREA
*get a fixed text or a component for typing Prophet Muhammad Salallahu alihi wasalam
*get a textarea with custom tags making capabiliity or just make 3 buttons above textarea and add ayah, hadith and prophtet Muhammad S.A.W.W text
*store ayah and hadith in db.(i can show a trending or a reminder ayah/hadith and then show that post...)
*just in case mails doesn't gets sent... exception is handled in a better way.
*make a component for time to write the time in the blog content
