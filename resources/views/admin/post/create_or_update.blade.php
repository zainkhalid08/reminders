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
              <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($createOrUpdate) }} Post</h6>
            </div>

            <div class="card-body">
              <br>
              
                <div>
                  <form method="post" action="{{ $formAction }}" id="post-creation-or-updation-form">
                    @csrf
                    <input type="hidden" name="_method" value="{{ $formMethod }}">
                    <h4>Title</h4>
                    <div class="text-center">
                      <input type="text" name="title" style="width: 100%;" placeholder="The Last Day" value="{{ isset($post) ? $post->title : old('title') }}">
                      @component('components.error', ['field' => 'title'])
                      @endcomponent
                    </div>
                    <h4>Speaker</h4>
                    <div class="text-center">
                      <input type="text" name="speaker" style="width: 100%;" placeholder="Sheikh Salaah Budaair"  id="speaker-autocomplete" value="{{ isset($post) ? $post->speaker->name : old('speaker') }}">
                      @component('components.error', ['field' => 'speaker'])
                      @endcomponent
                    </div>
                    <h4>Location</h4>
                    <div class="text-center">
                      <input type="text" name="location" style="width: 100%;" placeholder="Masjid Al Haram" id="location-autocomplete" value="{{ isset($post) ? $post->location->name : old('location') }}">
                      @component('components.error', ['field' => 'location'])
                      @endcomponent
                    </div>
                    <h4>Date</h4>
                    <div class="text-center">
                      <input type="date" name="date" style="width: 100%;" placeholder="Date" value="{{ isset($post) ? $post->date->format('Y-m-d') : old('date') }}">
                      @component('components.error', ['field' => 'date'])
                      @endcomponent
                    </div>
                    <h4>Video</h4>
                    <div class="text-center">
                      <input type="text" name="video_src" style="width: 100%;" placeholder="https://www.youtube.com/embed/" value="{{ isset($post) ? $post->video_src : old('video_src', 'https://www.youtube.com/embed/') }}">
                      @component('components.error', ['field' => 'video_src'])
                      @endcomponent
                    </div>
                    <h4>Tags</h4>
                    <div class="text-center">
                      <input type="text" name="tags" style="width: 100%;" placeholder="tags here..." id="tags-autocomplete-with-tagging" value="{{ isset($post) ? $post->tagsCombined() : old('tags')  }}">
                      @component('components.error', ['field' => 'tags'])
                      @endcomponent
                    </div>
                    <div>
                        
                        *ayah in {{'<ayah ayah="Al-Baqara:155"ayah></ayah>'}} <br>
                        *hadith in {{'<hadith hadith="muslim"hadith></hadith>'}} <br>
                        *speaker comments in {{'<p></p>'}} <br>
                        *to bold {{'<b></b>'}} <br>

                        NOTE: NO spaces between "> of hadith
                              ref="" use double quotes
                              starting be as is without any space ref="
                              the surah name should be from that seeder class
                      
                    </div>
                    <h4>Content</h4>
                    <button type="button" onclick="appendAyah()">ayah</button>
                    <button type="button" onclick="appendHadith()">hadith</button>
                    <button type="button" onclick="appendParagraph()">speaker's content</button>
                    <button type="button" onclick="appendProphetsName()">Prophet Muhammad (صَلَّىٰ ٱللهُ عَلَيْهِ وَآلِهِ وَسَلَّمَ) </button>
                    <div class="text-center">
                      <textarea name="content" style="width: 100%;" rows="15" placeholder="Type here...">{{ isset($post) ? $post->content : old('content') }}</textarea>
                      @component('components.error', ['field' => 'content'])
                      @endcomponent
                    </div>
                    <h4>Mins Read</h4>
                    <div class="text-center">
                      <input type="number" name="mins_read" min="1" style="width: 100%;" placeholder="1" value="{{ isset($post) ? $post->mins_read : old('mins_read') }}">
                      @component('components.error', ['field' => 'mins_read'])
                      @endcomponent
                    </div>
                    <h4>Meta Description</h4>
                     {{-- dd($post->meta) --}}
                    <div class="text-center">
                      <input type="text" name="meta[description]" style="width: 100%;" placeholder="About this post..." value="{{ isset($post) ? $post->meta['description'] : old('meta[description]') }}">
                      @component('components.error', ['field' => 'meta[description]'])
                      @endcomponent
                    </div>
                    <h4>Meta Keywords</h4>
                    <div class="text-center">
                      <input type="text" name="meta[keywords]" style="width: 100%;" placeholder="tags, for, this, post..." value="{{ isset($post) ? $post->meta['keywords'] : old('meta[keywords]') }}">
                      @component('components.error', ['field' => 'meta[keywords]'])
                      @endcomponent
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" style="margin-top: 2%;" onclick="event.preventDefault();
                                                                                                    document.getElementById('post-creation-or-updation-form').submit();">{{ $createOrUpdate }}</button>
                    </div>
                  </form> <br>

                  <h4>Surah Names</h4>
                  @forelse($surahs as $surah)
                    <span>{{ $surah->name }}, </span>
                  @empty
                  @endforelse

                  <div class="text-center">
                   <i>Say, "Whether you conceal what is in your breasts or reveal it, Allah knows it. And He knows that which is in the heavens and that which is on the earth. And Allah is over all things competent.</i><br>
                    <small>(Al-Imaran : 29)</small>
                  </div> 
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
      endingTagLength = 13;
      appendContent(txt, endingTagLength);
    }

    function appendHadith(){
      txt = '<hadith hadith=""hadith></hadith>';
      endingTagLength = 17;
      appendContent(txt, endingTagLength);
    }

    function appendParagraph(){
      txt = '<p></p>';
      endingTagLength = 4;
      appendContent(txt, endingTagLength);
    }

    function appendProphetsName(){
      txt = '<span title="Peace And Blessings Be Upon Him">Prophet Muhammad (peace be upon him)</span>';
      endingTagLength = 0;
      appendContent(txt, endingTagLength);
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
  </script>

@endsection
