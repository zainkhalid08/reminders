<?php

use App\Speaker;
use App\Location;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Post::count()) {
            return;
        }

    	$speaker = Speaker::firstOrFail();
    	$location = Location::firstOrFail();
    	$user = User::firstOrFail();

            $content = '<p><small title="this piece of content starts at this time of the video shared on this page. eg. @01:35 means 1min 35s">@01:55</small> All sound minded individuals would
            agree that just as there are certain
            diseases that affect a person&#8217;s body
            there are also diseases that affect a
            person&#8217;s conduct.</p>
            <p>
            No disease affecting a
            person&#8217;s conduct damages his heart,
            detracts from his rank and incites him
            against others, as severely as the
            disease of envy.</p>
            <p>One of the most
            comprehensive definitions for envy the
            scholars have mentioned that, 
            it refers
            to an internal feeling which emanates
            from liking something that someone else
            has, but wanting them to be deprived of
            it; because of the jealousy one feels due
            to them having it for themselves or due
            to them sharing it with oneself.
            </p>
            <p><span title="Peace And Blessings Be Upon Him">Prophet Muhammad (peace be upon him)</span> said</p>
            <hadith hadith=""hadith>The diseases of prior people have come to you
            discreetly, those being envy and hatred.</hadith>
            <p>Allah prohibited us from harboring envy towards others. He said</p>
            <ayah ayah="An-Nisa:32"ayah>&hellip;Do not wish for what Allah has
            specifically favored some of you over others&hellip;</ayah>
            <p>
            Some of the salaf explain this as referring to envy, in other words
            one wishing for others to be stripped of
            their blessings so that he himself could
            have them. This feeling represents
            opposition to Allah&#8217;s will, wisdom and justice.
            </p>
            <p>
            Allah stated in that regard
            </p>
            <ayah ayah="An-Nisa:54"ayah>&hellip; Do people maliciously envy the Prophet Muhammad and his followers because of the bounty Allah has granted them &hellip;
            </ayah>
            <p>There is a resemblance between envy and fire. Envy
            devours off person&#8217;s own righteous deeds
            just as fire devours wood.
            </p>
            <p>Envy, is what made Iblis become too arrogant to obey Allah&#8217;s command,
             made a brother kill his own sibling and made a group of
            brothers throw their own sibling down a
            well. It was also what obstructed Abu
            Jahl from accepting the <span title="Peace And Blessings Be Upon Him">Prophet Muhammad (peace be upon him)</span>.
            </p>
            <p>Servants of Allah, you should also contemplate the contents of
            surah Yusuf, it is a remarkable chapter
            of the Quran &hellip;</p>
            <p>
            If we contemplate the surah as it rightfully
            deserves we would realize that envy
            renders a person who harbors it, blind
            and deaf.
            </p>
            <p> 
            We would note that an envious
            person is not only spiteful about what
            happens to others in their state of
            wakefulness rather he is even spiteful
            towards them if they see something
            pleasing in their dreams while asleep.
            Such a person&#8217;s envy has no bounds. How
            could it be otherwise in light of the
            fact that the Prophet Yaqoob had told his
            son Yusuf my dear young son do not
            inform your brothers about your dream
            lest, they scheme against you&hellip;
            </p>
            <p>An envious individual enters
            the battlegrounds of envy, not realizing
            that he is the one who will lose and the
            reason for his loss is because in
            reality his opposition is towards Allah
            who bestows his blessings upon whomever
            he wills.</p>
            <p>
             If we contemplate the
            aforementioned surah as it deserves, we
            would realize that the envy in a
            person&#8217;s heart, blinds him to the
            reprehensibility of the sins he commits
            in order to achieve his aims; EVEN if
            that involves wronging the nearest of
            people to him. Envy makes him think his
            wrongdoing is actually praiseworthy and
            free of all blame. When Yusuf&#8217;s brothers
            spitefully envied him they intended to
            murder or banish him in order to attain
            their father&#8217;s undivided love and
            affection. 
            Furthermore they felt that
            attaining their goal was what would make
            them righteous individuals. In the end
            they had said to each other you have to
            kill Yusuf or banish him to some far-off
            and desolate place;
            by doing so you will attain your father&#8217;s
            undivided love and attention. Then after
            that you can repent to Allah.
            </p>
            <p>
             If we contemplate that
            surah as it deserves, we would know that
            an envious person refrains from giving
            those whom he envies the true
            description that befits them, we find
            that Yusuf&#8217;s brothers refer to him with
            his name and did not describe him as a
            brother of their&#8217;s.</p>
            <p>They said &#8220;Kill <b>Yusuf</b>
            or banish him&#8221;
            they said &#8220;<b>Yusuf</b> and his full brother
            are truly dearer to our father than us&#8221; and they
            said &#8220;Our dear father, why do you not
            trust us with <b>Yusuf</b>.&#8221; In contrast when
            referring to their other brother whom
            they did not envy they did not refrain
            from describing him as their brother for
            instance they said &#8220;Our dear father we
            will not receive any further measure of
            grain unless we take our <b>BROTHER;</b> thus
            allow our <b>BROTHER</b> to come with us so
            that we can receive another measure.&#8221; 
            </p>
            <p>
            The aforementioned envy can kill without any weapon burn without any fuel and drown
            without any water I beseech Allah to
            protect all of us in the name of Allah
            the most merciful to bestow of mercy say
            I seek refuge with Allah &hellip;
            </p>
            <hr >
            <p>Servants of Allah, you must observe taqwa of Allah and
             realize that happiness and
            envy cannot ever coexist in a person&#8217;s
            heart. This is because <b>happiness comes
            from being pleased with Allah</b>, whereas
            envy stands in opposition to being
            pleased with Allah.
            </p>
            <p>Servants of Allah a person who is envied should prepare
            himself for the blows aimed at him by
            those who are envious, the enlightened
            mind he has will make certain people
            spiteful towards him, while the
            enlightened heart he has will earn
            him supporters. 
            </p>
            <p>
            An envious person brings
            five punishments upon himself before his
            envy reaches his target.
            <ul>
            <li>He incurs Allah&#8217;s wrath.</li>
            <li>He covers his heart with distress.</li>
            <li>He puts himself through adversity that he will not be rewarded for facing. 
            </li>
            <li>He does something that makes him blameworthy.
            </li>
            <li>And the gates of happiness will be closed in his face.
            </li>
             </ul> 
            </p>
            <p>However, although the foregoing
            blameworthy envy deprives one of life. We
            must take note of the fact that there is
            a <b>praiseworthy form of envy</b> that
            actually gives one life.
            </p>
            <p>High aspirations
            do not lead to blameworthy envy
            rather they produce a praiseworthy
            manifestation of envy which takes the
            form of liking the good others have
            and wanting the same or better for
            oneself, but without wanting others to be
            deprived of what they have been granted
            by Allah. 
            </p>
            <p>A person with this perspective
            desires to rise to the lofty level of
            those whose blessings he envies, not
            bring them down to the low level where
            he remains.</p>
            <p>This is what marks the
            distinction between blame worthy and
            praiseworthy forms of envy. The <span title="Peace And Blessings Be Upon Him">Prophet Muhammad (peace be upon him)</span> may Allah grant him commendation and protection said 
            </p>
            <hadith hadith="Bukhari"hadith>There is to be no envy except
            in two cases, one is the case of someone
            whom Allah grants wealth and he then
            uses it all to do what is correct and
            the other is the case of someone whom
            Allah grants wisdom and he then judges
            according to it and imparts it to others.</hadith>
            <p>In conclusion invoke Allah to grant
            commendation and protection to his
            messenger. Allah instructed us to do so
            in the Quran when he said</p>
            <ayah ayah="Al-Ahzab:56"ayah>... People of eman
            invoke Allah to grant the Prophet
            commendation and to grant him protection ...</ayah>
            <p>
            O Allah, grant your commendation and protection
            to your worshiping servant
            and messenger <span title="Peace And Blessings Be Upon Him">Muhammad (peace be upon him)</span>  ...
            </p>';

        $meta = [
            'description' => 'Topic: Friday Sermon On Envy, Location: '.$location->name.', Sermon Date: 2020-01-03, Delivered By: '.$speaker->name.' ',
            'keywords' => 'friday sermon, envy, surah yusuf',
        ];

    	$posts = [
    		[
    			'title' => 'Envy',
    			'content' => $content,
    			'speaker_id' => $speaker->id,
    			'location_id' => $location->id,
    			'date' => '2020-01-03',
    			'video_src' => 'https://www.youtube.com/embed/KJq08q7qfr4',
    			'mins_read' => 7,
    			'meta' => $meta,
                'user_id' => $user->id,
    			'published_at' => date('Y-m-d h:i:s'),
    		], 
    	];

    	foreach ($posts as $post) {

	        Post::create([
	        	'title' => $post['title'],
		        'content' => $post['content'],
		        'speaker_id' => $post['speaker_id'],
		        'location_id' => $post['location_id'],
		        'date' => $post['date'],
		        'video_src' => $post['video_src'],
		        'mins_read' => $post['mins_read'],
		        'meta' => $meta,
                'user_id' => $post['user_id'],
		        'published_at' => $post['published_at'],
	        ]);
    		
    	}


    }
}
