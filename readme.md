<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Reminders
<i>last updated on 30th Dec 2019</i>

! After ensureing settings of env especially db certs etc

<code>php artisan fresh:install:once</code>

# Admin

templates for 

ayah
<blockquote class="blockquote">The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote>
hadith
fact

ayah will come in <ayah rfr="">
hadith will come in <hadith rfr="">
contetn will come in <p> NOTE THIS ONE


# Warnings
1. we can't update location or speaker names, just yet.
2. don't upload masjid an nabawi sermons just yet as they are in urdu and is difficult to translate...

# Supports
1. HAVE TO BE TESTED there can be two speakers with same name but different locations 

# NOTE
1. we'll just mention quran, hadith ref will be given from sermon itself...
2. constants <ayah>


# Tests
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
	p | when a new ayah is added in the post content that isn't in db then it is created in db.
	p | when a more than 1 ayahs are added in the post content that aren't in db they are created in db.

	p | when an old ayah is added in the post content that is in db then it isn't created in db.
	p | when more than 1 old ayahs are added in the post content that are in db then they aren't created in db.

	p | when a new ayah is added THAT IS ABOUT 90% SIMILAR to any of the alreaady present in db then it isn't created in db
	when more than one new ayah is added THAT ARE ABOUT 90% SIMILAR to any of the alreaady present in db then they aren't created in db

	when there is an html tag especially bold or italics text within ayah then it is removed and then saved in db without affecting original content

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

# Bugs

# Just Writing

1. should have node installed
2. npm init // creates package.json perhaps
3. npm install 

# NPM
npm run production

# CODE
1. views/partials : where front end partials are kept
2. the way we want the text to be displayed for visitors, we'll store the text in that way in db.(insead of getting in that way-less loadtime.)

# EXTRA
            // also validate that ref is valid in content's ayah 
# Options

BEFORE DEPLOYMENT
*makesure to rename assets as unique as it caused that access forbidden error. The link is accessable anyways so the point is that make sure that those directories arne't accessable. FIRST WE'LL GO FOR staging.remindersforgood.com and then...
*store ayah and hadith in db.(i can show a trending or a reminder ayah/hadith and then show that post...)
*meta description for seo

-
CUSTOM TEXTAREA
*get a fixed text or a component for typing Prophet Muhammad Salallahu alihi wasalam
*get a textarea with custom tags making capabiliity or just make 3 buttons above textarea and add ayah, hadith and prophtet Muhammad S.A.W.W text
-
DESIGN MATTERS
*decide a design for ayah, hadith
*force a format of all the content shown to user especially the post heading and subheadings. 
*design color some letters different in reminders for good *dot in the logo or color dot as dot of the i
*decide the header image


*add rel and perhaps logo on welcome...
*bring all cdns locally
*finalize the optimization of assets to minify css and js
*views count for a post.

*roles

NOT YET/IDEAS
*tags description on admin, to show description on hover
*have a component dua also perhaps.
*search feature
*useful links perhaps
*feedback from visitors
*admin,stats of visitors to store in db
*static pages, privacy policy, about us, terms of service... etc

CANCELED
*search how to add custom domain on heroku, and just do it.

DONE
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