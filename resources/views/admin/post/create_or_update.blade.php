{{-- @var $availableData['tags'] --}} 
{{-- @var $availableData['speakers'] --}} 
{{-- @var $availableData['locations'] --}} 
{{-- @var $availableData['surahs'] --}} 

{{-- @var $formSettings['button'] --}} 
{{-- @var $formSettings['action'] --}} 
{{-- @var $formSettings['method'] --}} 


@extends('admin.layouts.header_footer')

@section('head')
  {{-- Autocomplete With Tagging --}}
  <link href="{{ asset('admnistratorassetsonly/css/autocomplete/amsify.suggestags.css') }}" rel="stylesheet">

  {{-- Autocomplete --}}
  <link href="{{ asset('admnistratorassetsonly/css/autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet">

@endsection

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      
      <!-- Content Row -->
      <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($formSettings['button']) }} Post</h6>
            </div>

            <div class="card-body">
              <br>
              
                <div>
                  <form method="post" action="{{ $formSettings['action'] }}" id="post-creation-or-updation-form">
                    @csrf
                    <input type="hidden" name="_method" value="{{ $formSettings['method'] }}">
                    <h4>Title</h4>
                    <div class="text-center">
                      <input type="text" name="title" style="width: 100%;" placeholder="The Last Day" value="{{ isset($post) ? $post->title : old('title') }}">
                      @component('admin.components.error', ['field' => 'title'])
                      @endcomponent
                    </div>
                    <h4>Speaker</h4>
                    <div class="text-center">
                      <input type="text" name="speaker" style="width: 100%;" placeholder="Sheikh Salaah Budaair" value="{{ isset($post) ? $post->speaker->name : old('speaker') }}">
                      @component('admin.components.error', ['field' => 'speaker'])
                      @endcomponent
                    </div>
                    <h4>Location</h4>
                    <div class="text-center">
                      <input type="text" name="location" style="width: 100%;" placeholder="Masjid Al Haram" id="location-autocomplete" value="{{ isset($post) ? $post->location->name : old('location', 'Masjid Al Haram') }}">
                      @component('admin.components.error', ['field' => 'location'])
                      @endcomponent
                    </div>
                    <h4>Date</h4>
                    <div class="text-center">
                      <input type="date" name="date" style="width: 100%;" placeholder="Date" value="{{ isset($post) ? $post->date->format('Y-m-d') : old('date') }}">
                      @component('admin.components.error', ['field' => 'date'])
                      @endcomponent
                    </div>
                    <h4>Video</h4>
                    <div class="text-center">
                      <input type="text" name="video_src" style="width: 100%;" placeholder="https://www.youtube.com/embed/" value="{{ isset($post) ? $post->video_src : old('video_src', 'https://www.youtube.com/embed/?rel=0') }}">
                    *eg {{'...embed/KJq08q7qfr4?rel=0'}} <br>
                      @component('admin.components.error', ['field' => 'video_src'])
                      @endcomponent
                    </div>
                    <h4>Tags (type , after entering)</h4>
                    <div class="text-center">
                      <input type="text" name="tags" style="width: 100%;" placeholder="tags here..." id="tags-autocomplete-with-tagging" value="{{ isset($post) ? $post->combineTags() : old('tags')  }}">
                      @component('admin.components.error', ['field' => 'tags'])
                      @endcomponent
                    </div>
                    <div>
                        
                        *ayah in {{'<ayah ayah="Al-Baqara:155"ayah></ayah>'}} <br>
                        *hadith in {{'<hadith hadith="muslim"hadith></hadith>'}} <br>
                        *tyme in {{'<tyme min="4" sec="55"></tyme>'}} <br>
                        *speaker comments in {{'<p></p>'}} <br>
                        *to bold {{'<b></b>'}} <br>

                    </div>
                    <h4>Content</h4>
                    <button type="button" onclick="appendAyah()">ayah</button>
                    <button type="button" onclick="appendHadith()">hadith</button>
                    <button type="button" onclick="appendTyme()">tyme</button>
                    <button type="button" onclick="appendParagraph()">speaker's content</button>
                    <button type="button" onclick="appendProphetsName()">Prophet Muhammad (صَلَّىٰ ٱللهُ عَلَيْهِ وَآلِهِ وَسَلَّمَ) </button>
                    <button type="button" onclick="appendAllahName()">Allah</button>
                    <button type="button" onclick="appendHellip()">...</button>
                    <button type="button" onclick="appendQuran()">Quran</button>
                    <button type="button" onclick="appendApostrophe()">&#8217;</button>
                    <button type="button" onclick="appendDQuotesStart()">&#8220;</button>
                    <button type="button" onclick="appendDQuotesEnd()">&#8221;</button>
                    <div class="text-center">
                      <!-- <textarea id="txtarea" name="content" style="width: 100%;" rows="15" placeholder="Type here...">{{ isset($post) ? $post->content : old('content') }}</textarea> -->
                      <textarea id="txtarea" name="content" style="width: 100%;" rows="15" placeholder="Type here...">{{ old('content', isset($post) ? $post->content : '' ) }}</textarea>
                      @component('admin.components.error', ['field' => 'content'])
                      @endcomponent
                    </div>
                    <h4>Mins Read</h4>
                    <div class="text-center">
                      <input type="number" name="mins_read" min="1" style="width: 100%;" placeholder="1" value="{{ isset($post) ? $post->mins_read : old('mins_read') }}">
                      @component('admin.components.error', ['field' => 'mins_read'])
                      @endcomponent
                    </div>
                    <h4>Meta Description</h4>
                     {{-- dd($post->meta) --}}
                    <div class="text-center">
                      <input type="text" name="meta[description]" style="width: 100%;" placeholder="About this post..." value="{{ old('meta.description', isset($post) ? $post->meta['description'] : '') }}" required maxlength="160">
                      @component('admin.components.error', ['field' => 'meta.description'])
                      @endcomponent
                    </div>
                    <h4>Meta Keywords</h4>
                    <div class="text-center">
                      <input type="text" name="meta[keywords]" style="width: 100%;" placeholder="tags, for, this, post..." value="{{ old('meta[keywords]', isset($post) ? $post->meta['keywords'] : '') }}" required>
                      @component('admin.components.error', ['field' => 'meta.keywords'])
                      @endcomponent
                    </div>

                    <div class="text-center">
                      <button type="submit" name="redirects_to" class="btn btn-primary" style="margin-top: 2%;" form="post-creation-or-updation-form" value="admin_all_posts">Done</button>
                      <button type="submit" name="redirects_to" class="btn btn-primary" style="margin-top: 2%;" form="post-creation-or-updation-form" value="post_edit">Save</button>
                    </div>
                  </form> <br>

                  <hr>
                                    
                  <center>
                    <h2>Spelling Checker</h2>
                    <small>(for consistency & accurate search)</small>
                  </center>

                  <h4>Surah Names Checker</h4>
                  @forelse($availableData['surahs'] as $surah)
                    <span>{{ $surah->name }}, </span>
                  @empty
                  @endforelse
                  
                  <h4>Hadith Book Names Checker</h4>
                  <span>Bukhari, Muslim, Tirmidhi, Sanan Abi Dawood</span>

                  <h4>Speaker Name Checker</h4>
                  @forelse($availableData['speakers'] as $speaker)
                    <span>{{ $speaker->name }}, </span>
                  @empty
                  @endforelse

                  <h4>Words Checker</h4>
                  @forelse($availableData['words'] as $word)
                    <span>{{ $word->name }}, </span>
                  @empty
                  @endforelse

                  <h4>Add New Word(s)</h4> 
                  <div class="text-center">
                    <input type="text" name="words" style="width: 100%;" placeholder="for new eg. salaf, Yusuf, Waqoob"   form="post-creation-or-updation-form">
                  </div>

                  <hr>

                  <h4>Post Content Checklist</h4>
                  <ol>
                    <li>room for removal</li>
                    <li>headings if possible</li>
                    <li>gramatical spelling</li>
                    <li>name spelling</li>
                    <li>punctuation</li>
                    <li>what to bold for good reading exp</li>
                    <li>where places to add @time</li>
                    <li>minutes read is it</li>
                    <li>check translations... which to keep</li>
                    <li>finalize tags</li>
                    <li>meta description</li>
                    <li>final read</li>
                  </ol>
                </div>
            </div>
          </div>        
        </div>
      </div> 

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')
  {{-- Autocomplete With Tagging --}}
  <script src="{{ asset('admnistratorassetsonly/js/autocomplete/jquery.amsify.suggestags.js') }}"></script>

  {{-- Autocomplete --}}
  <script src="{{ asset('admnistratorassetsonly/js/autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
  @include('admin.scripts.create')
  <script>
    function appendAyah(){
      txt = '<ayah ayah=""ayah></ayah>';
      lengthFromEndingTag = 13;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendHadith(){
      txt = '<hadith hadith=""hadith></hadith>';
      lengthFromEndingTag = 17;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendTyme(){
      txt = '<tyme min="" sec=""></tyme> ';
      lengthFromEndingTag = 16;
      // appendContent(txt, lengthFromEndingTag);
      insertAtCaret('txtarea', txt);
    }

    function appendParagraph(){
      txt = '<p></p>';
      lengthFromEndingTag = 4;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendProphetsName(){
      txt = '<span title="Peace And Blessings Be Upon Him">Prophet Muhammad (peace be upon him)</span>';
      lengthFromEndingTag = 0;
      appendContent(txt, lengthFromEndingTag);
    }    

    function appendHellip(){
      txt = ' &hellip; ';
      lengthFromEndingTag = 0;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendAllahName(){
      txt = 'Allah';
      lengthFromEndingTag = 0;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendQuran(){
      txt = 'Quran';
      lengthFromEndingTag = 0;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendApostrophe(){
      txt = '&#8217;';
      lengthFromEndingTag = 0;
      appendContent(txt, lengthFromEndingTag);
    }

    function appendDQuotesStart(){
      txt = '&#8220;';
      lengthFromEndingTag = 0;
      // appendContent(txt, lengthFromEndingTag);
      insertAtCaret('txtarea', txt);
    }

    function appendDQuotesEnd(){
      txt = '&#8221;';
      lengthFromEndingTag = 0;
      // appendContent(txt, lengthFromEndingTag);
      insertAtCaret('txtarea', txt);
    }

    /**
     * Appends Content in textarea
     * 
     * @param  {string} content 
     * @param  {int} lengthOfTheEndingTag using to bring focus in the center of the tags 
     * @return {void}         
     */
    function appendContent(content, length){
      var textarea = $("textarea");
      textarea.val(textarea.val() + txt);
      $(textarea).focus();
      textarea[0].selectionStart = textarea.val().length - length;
      textarea[0].selectionEnd = textarea.val().length - length;
    }

    function insertAtCaret(areaId, text) {
      var txtarea = document.getElementById(areaId);
      if (!txtarea) {
        return;
      }

      var scrollPos = txtarea.scrollTop;
      var strPos = 0;
      var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
        "ff" : (document.selection ? "ie" : false));
      if (br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        strPos = range.text.length;
      } else if (br == "ff") {
        strPos = txtarea.selectionStart;
      }

      var front = (txtarea.value).substring(0, strPos);
      var back = (txtarea.value).substring(strPos, txtarea.value.length);
      txtarea.value = front + text + back;
      strPos = strPos + text.length;
      if (br == "ie") {
        txtarea.focus();
        var ieRange = document.selection.createRange();
        ieRange.moveStart('character', -txtarea.value.length);
        ieRange.moveStart('character', strPos);
        ieRange.moveEnd('character', 0);
        ieRange.select();
      } else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
      }

      txtarea.scrollTop = scrollPos;
    }
  </script>

@endsection
